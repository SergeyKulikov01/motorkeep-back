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

Standard Laravel structure. Routes in `routes/web.php` + `routes/auth.php`. Auth scaffolded via Laravel Breeze (Blade stack). No custom domain models exist yet beyond `app/Models/User.php` — the app is in early build-out.

**Database**: SQLite by default (file at `database/database.sqlite`). Tests use `:memory:` SQLite. Queue and cache are database-backed in the default `.env`.

**Web root**: The entry point is `public_html/index.php`, not `public/` — this is intentional for shared-hosting deployment. The `public_html/index.php` bootstraps from `../vendor/autoload.php` and `../bootstrap/app.php`.

**Vite build**: Configured to output `assets/app.js` and `assets/app.css` **without content hashes** so Blade templates can reference fixed paths. Other assets (fonts, images) keep hashes.

### Frontend

Blade templates with **Tailwind CSS v3**, **Alpine.js**, and **Vite**. Entry points: `resources/css/app.css` and `resources/js/app.js`.

The detailed frontend specification lives in `MOTORKEEP_FRONTEND_TZ.md` — this is the authoritative design system document. Key rules from it:

**Design tokens**: All colors, radii, shadows, and fonts are CSS custom properties on `:root` with the `--mk-` prefix. Never use raw hex values outside `:root`. Tokens are defined in the spec and must be declared in the shared `app.css`.

**Typography**:
- `Space Grotesk` — all headings, ALL numbers/amounts/odometer (always with `font-variant-numeric: tabular-nums`)
- `Inter` — body text and UI labels
- `JetBrains Mono` — VIN codes, license plates

**Layout shell**: Inner pages use a fixed left sidebar (`.mk-sidebar`) + sticky header (`.mk-header`) + minimal footer (`.mk-footer`). Landing and auth pages are standalone (no sidebar). The sidebar collapses to icon-only mode on desktop (`body.is-collapsed`, state saved in `localStorage`). On screens ≤ 900px it becomes an off-canvas drawer triggered by a hamburger button.

**Record types** (the core domain concept) with their semantic colors:
- Service / ТО → `--mk-c-service: #2F6BFF`
- Repair / Поломка → `--mk-c-repair: #F0463B`
- Purchase / Покупка → `--mk-c-buy: #F59412`
- Fuel / Заправка → `--mk-c-fuel: #16B364`
- Note / Заметка → `--mk-c-note: #8B5CF6`

Each type has a `-soft` background variant. These are the **only** non-brand colors permitted.

**CSS class naming**: `mk-` prefix, BEM-like (`.mk-record__title`, `.mk-record__desc`).

**Signature UI elements**:
- Odometer (`.mk-odo`): large tabular number in Space Grotesk + segmented track bar beneath it
- Record feed (`.mk-record`): each record has a colored left "rail" (`::before`, color from `--rail` CSS variable set inline) identifying its type

**Breakpoints**: 1000px (hero/stats reflow), 900px (sidebar → drawer), 680px (narrow mobile), 380px (stats single column).

**Icons**: Inline SVG, outline style, 24×24 viewBox, stroke 1.8–2.0, `fill:none`, `currentColor`. Do not mix with filled icons.

**Motion**: `150ms ease` for interactions, `200–300ms ease-out` for block appearance. Always include `@media (prefers-reduced-motion: reduce) { * { transition: none !important } }`.