# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

**MOTORKEEP** — a Laravel 13 web app. Users add their cars to a personal "garage" and log service history, repairs, purchases, fuel-ups, and notes. The app tracks mileage stats and service reminders.

## Commands

```bash
# First-time setup (install deps, copy .env, generate key, migrate, build assets)
composer run setup

# Run dev environment (PHP server + queue worker + pail logs + Vite, all concurrently)
composer run dev

# Run all tests
composer run test

# Run a single test file or filter
php artisan test --filter=ExampleTest

# Build frontend assets for production
npm run build

# Lint PHP with Pint
./vendor/bin/pint

# Interactive REPL
php artisan tinker
```

## Architecture

### Backend (Laravel 13 / PHP 8.3+)

Standard Laravel structure. Routes in `routes/web.php` + `routes/auth.php`. Auth scaffolded via Laravel Breeze (Blade stack), plus a custom Yandex OAuth flow (`AuthenticatedController` → `Auth/YandexAuthController`, `users.yandex_id`).

**Database**: MySQL — the app's `.env` is configured with `DB_CONNECTION=mysql` (no SQLite file is used in dev/production). `.env.example` still ships with Laravel's default SQLite skeleton (`DB_CONNECTION=sqlite`); update it to `mysql` when provisioning a new environment. Tests are the one exception: `phpunit.xml` hard-codes `DB_CONNECTION=sqlite` / `DB_DATABASE=:memory:` regardless of `.env`, so the test suite still runs against in-memory SQLite. Queue and cache are database-backed in `.env` (`QUEUE_CONNECTION=database`, `CACHE_STORE=database`).

**Web root**: The entry point is `public_html/index.php`, not `public/` — this is intentional for shared-hosting deployment. The `public_html/index.php` bootstraps from `../vendor/autoload.php` and `../bootstrap/app.php`.

**Vite build**: Configured to output `assets/app.js` and `assets/app.css` **without content hashes** so Blade templates can reference fixed paths. Other assets (fonts, images) keep hashes.

#### Domain model

- `Cars` (table `cars`) — a user's vehicle. Belongs to `User`, `Brand`, `CarModel` (as `model`), `Color` (as `colorInfo`), `BodyTypes` (as `bodyInfo`); has many `CarHistory`. Carries computed `Attribute` accessors for spend stats (`totalSpend`, `yearSpend`, `monthsSpend`, `diffPercentSpend`, `mileageFormatted`) derived from its loaded `history` relation — always eager-load `history` before reading these.
- `Brand` / `CarModel` — reference data (make/model), looked up via the public `GET /api/getBrands` and `GET /api/getModels` typeahead endpoints (`ApiController`). `Color` and `BodyTypes` are similar reference tables managed via the Filament admin panel.
- `CarHistory` — a single service/repair/purchase/fuel/note record on a car (`type` ∈ service/repair/buy/fuel). On `created`/`updated`/`deleted` it dispatches `App\Events\HistoryAdded`, which `App\Listeners\FillTotalHistory` turns into a human-readable `TotalHistory` row (used to render the dashboard activity feed). Business logic for creating/listing/deleting records lives in `App\Services\CarHistory`, not the controller.
- `TotalHistory` — append-only activity log, populated only via the `HistoryAdded` event above; never written to directly by controllers.
- `Reminders` — upcoming service reminders per car; `statusClass` accessor drives `overdue`/`urgent` styling based on `date_of_exec`.
- `UserNotes`, `CarDocs` — free-form notes and document metadata attached to a car.
- `CarDocs` and `TotalHistory` use PHP attributes (`#[Fillable]`, `#[Table]`) instead of the `$fillable`/`$table` properties used elsewhere in the codebase — match the style already present in the file you're editing rather than mixing conventions.

#### Routes (`routes/web.php`)

- `GET /api/getBrands`, `GET /api/getModels` — public, unauthenticated typeahead lookups.
- `/api/notes`, `/api/reminders`, `/api/car-history`, `/api/car-docs`, `/api/stats` — JSON endpoints behind `auth`+`verified`, one controller per resource (`UserNotesController`, `RemindersController`, `CarHistoryController`, `CarDocsController`, `StatController`).
- `/dashboard`, `/dashboard/cars`, `/dashboard/stats`, `/dashboard/add`, `/dashboard/detail/{id}` — the authenticated Blade-rendered app shell, each backed by its own controller (`DashboardController`, `NewCarController`, `DetailCarController`).
- All authenticated (non-API) users are scoped by `auth()->id()` inside controllers — there is no global authorization layer, so new car-scoped endpoints must filter by the current user explicitly.

#### Admin panel

Filament v5 admin panel is mounted at `/admin` (`app/Providers/Filament/AdminPanelProvider.php`), auto-discovering resources under `app/Filament/Resources` (currently `Brand`, `CarModel`) and widgets under `app/Filament/Widgets`. Access is gated by `User::canAccessPanel()`, which checks `users.is_admin`.

### Frontend

Blade templates with **Tailwind CSS v3**, **Alpine.js**, and **Vite**. There is a single build entry pair (`resources/css/app.css`, `resources/js/app.js`); every page-specific script/stylesheet (`login.js`, `dashboard.js`, `add.js`, `detail.js`, `stats.js`, …) is imported from `app.js`/`app.css` and shipped in one bundle rather than split per page — there is no per-route `@vite` entry. `app.js` also exports shared helpers (`getCsrfToken`, `fetchJson`, `formatRub`) that page scripts import instead of redefining fetch/CSRF boilerplate.

The detailed frontend specification lives in `MOTORKEEP_FRONTEND_TZ.md` — this is the authoritative design system document. Key rules from it:

**Design tokens**: All colors, radii, shadows, and fonts are CSS custom properties on `:root` with the `--mk-` prefix. Never use raw hex values outside `:root`. Tokens are defined in the spec and must be declared in the shared `app.css`.

**Typography**:
- `Space Grotesk` — all headings, ALL numbers/amounts/odometer (always with `font-variant-numeric: tabular-nums`)
- `Inter` — body text and UI labels
- `JetBrains Mono` — VIN codes, license plates

**Layout shell**: Inner pages use a fixed left sidebar (`.mk-sidebar`) + sticky header (`.mk-header`) + minimal footer (`.mk-footer`). Landing and auth pages are standalone (no sidebar). The sidebar collapses to icon-only mode on desktop (`body.is-collapsed`, state saved in `localStorage`). On screens ≤ 900px it becomes an off-canvas drawer triggered by a hamburger button. The sidebar's car list is injected globally via a view composer on `layouts.private.sidebar` in `AppServiceProvider` (not passed per-controller).

**Record types** (the core domain concept, backed by `CarHistory.type`) with their semantic colors:
- Service / ТО → `--mk-c-service: #2F6BFF`
- Repair / Поломка → `--mk-c-repair: #F0463B`
- Purchase / Покупка → `--mk-c-buy: #F59412`
- Fuel / Заправка → `--mk-c-fuel: #16B364`
- Note / Заметка → `--mk-c-note: #8B5CF6`

Each type has a `-soft` background variant. These are the **only** non-brand colors permitted. `CarHistory::readableType`/`labelColor` accessors map `type` to its Russian label and CSS variable name — reuse them instead of re-implementing the switch in Blade/JS.

**CSS class naming**: `mk-` prefix, BEM-like (`.mk-record__title`, `.mk-record__desc`).

**Signature UI elements**:
- Odometer (`.mk-odo`): large tabular number in Space Grotesk + segmented track bar beneath it
- Record feed (`.mk-record`): each record has a colored left "rail" (`::before`, color from `--rail` CSS variable set inline) identifying its type

**Breakpoints**: 1000px (hero/stats reflow), 900px (sidebar → drawer), 680px (narrow mobile), 380px (stats single column).

**Icons**: Inline SVG, outline style, 24×24 viewBox, stroke 1.8–2.0, `fill:none`, `currentColor`. Do not mix with filled icons.

**Motion**: `150ms ease` for interactions, `200–300ms ease-out` for block appearance. Always include `@media (prefers-reduced-motion: reduce) { * { transition: none !important } }`.
