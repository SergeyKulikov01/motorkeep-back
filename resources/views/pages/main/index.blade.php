@include('layouts.public.landing-head')
<body>
@include('layouts.public.landing-header')

<!-- ============================================================ -->
<!--  ОСНОВНОЙ КОНТЕНТ                                             -->
<!-- ============================================================ -->
<main>

    <!-- ========================================================== -->
    <!--  HERO                                                       -->
    <!-- ========================================================== -->
    <section class="mk-hero-landing">
        <div class="mk-container">
            <div class="mk-hero-landing__grid">

                <!-- Левая колонка: текст -->
                <div class="mk-hero-landing__content">
                    <p class="mk-eyebrow">Дневник автомобиля</p>
                    <h1 class="mk-hero-landing__title">
                        Вся история машины<br/>
                        <span class="mk-hero-landing__title-highlight">в одном месте</span>
                    </h1>
                    <p class="mk-hero-landing__sub">
                        Записывайте ТО, поломки, заправки и покупки. Контролируйте
                        расходы и получайте напоминания о следующем обслуживании.
                    </p>
                    <div class="mk-hero-landing__actions">
                        <a href="#register" class="mk-btn mk-btn--primary mk-btn--lg">
                            Завести гараж →
                        </a>
                        <a href="#demo" class="mk-btn mk-btn--ghost mk-btn--lg">
                            Посмотреть демо
                        </a>
                    </div>
                </div>

                <!-- Правая колонка: мокап карточки авто с одометром -->
                <div class="mk-hero-landing__mockup">
                    <div class="mk-mockup-card">
                        <div class="mk-mockup-card__media">
                            <svg viewBox="0 0 120 72" fill="none" aria-hidden="true">
                                <rect x="10" y="24" width="100" height="32" rx="6" fill="#D4DCE8" opacity=".35"/>
                                <rect x="16" y="28" width="88" height="24" rx="4" fill="#E5EAF2" opacity=".5"/>
                                <path d="M28 44h64M32 36h56M36 52h48" stroke="#D4DCE8" stroke-width="2"
                                      stroke-linecap="round" opacity=".4"/>
                                <circle cx="44" cy="44" r="8" fill="#D4DCE8" opacity=".25"/>
                                <circle cx="76" cy="44" r="8" fill="#D4DCE8" opacity=".25"/>
                            </svg>
                            <span class="mk-mockup-card__plate">А 777 ММ</span>
                        </div>
                        <div class="mk-mockup-card__body">
                            <h3 class="mk-mockup-card__name">BMW 320i</h3>
                            <!-- ОДОМЕТР — фирменный элемент -->
                            <div class="mk-odo mk-odo--sm">
                                <span class="mk-odo__label">Пробег</span>
                                <span class="mk-odo__value">
                                        86 420 <span class="mk-odo__unit">км</span>
                                    </span>
                                <span class="mk-odo__track" aria-hidden="true"></span>
                            </div>
                            <div class="mk-mockup-card__stats">
                                <span>12 записей</span>
                                <span>·</span>
                                <span>8.4 л/100 км</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================== -->
    <!--  3 КАРТОЧКИ-ЦЕННОСТИ                                        -->
    <!-- ========================================================== -->
    <section class="mk-section" id="features">
        <div class="mk-container">
            <div class="mk-section__head">
                <p class="mk-eyebrow mk-eyebrow--centered">Почему MOTORKEEP</p>
                <h2 class="mk-section__title mk-section__title--centered">
                    Всё, что нужно для порядка
                </h2>
            </div>
            <div class="mk-value-grid">
                <article class="mk-value-card">
                    <div class="mk-value-card__icon"
                         style="--icon-bg: var(--mk-c-service-soft); --icon-color: var(--mk-c-service);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                            <path d="M2 17l10 5 10-5"/>
                            <path d="M2 12l10 5 10-5"/>
                            <path d="M12 22v-10"/>
                        </svg>
                    </div>
                    <h3 class="mk-value-card__title">Записи ТО</h3>
                    <p class="mk-value-card__desc">
                        Фиксируйте каждое обслуживание: замена масла, фильтров,
                        тормозных колодок — всё в одном месте.
                    </p>
                </article>

                <article class="mk-value-card">
                    <div class="mk-value-card__icon"
                         style="--icon-bg: var(--mk-c-fuel-soft); --icon-color: var(--mk-c-fuel);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                             stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="6" width="16" height="14" rx="2"/>
                            <path d="M18 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2"/>
                            <path d="M8 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                            <path d="M10 12l2 2 4-4"/>
                        </svg>
                    </div>
                    <h3 class="mk-value-card__title">Контроль расходов</h3>
                    <p class="mk-value-card__desc">
                        Суммы на топливо, ремонт и аксессуары — в удобной статистике.
                        Знайте, сколько уходит на авто каждый месяц.
                    </p>
                </article>

                <article class="mk-value-card">
                    <div class="mk-value-card__icon"
                         style="--icon-bg: var(--mk-primary-soft); --icon-color: var(--mk-primary);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                             stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                            <path d="M12 2v2"/>
                            <path d="M12 20v2"/>
                            <path d="M4 12H2"/>
                            <path d="M22 12h-2"/>
                            <path d="M19.07 4.93l-1.41 1.41"/>
                            <path d="M6.34 17.66l-1.41 1.41"/>
                            <path d="M17.66 6.34l1.41-1.41"/>
                            <path d="M6.34 6.34L4.93 4.93"/>
                        </svg>
                    </div>
                    <h3 class="mk-value-card__title">Напоминания</h3>
                    <p class="mk-value-card__desc">
                        Система сама подскажет, когда пора на ТО, заменить ремень
                        или проверить свечи. Больше ничего не забывайте.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <!-- ========================================================== -->
    <!--  КАК ЭТО РАБОТАЕТ — 3 ШАГА                                 -->
    <!-- ========================================================== -->
    <section class="mk-section mk-section--alt">
        <div class="mk-container">
            <div class="mk-section__head">
                <p class="mk-eyebrow mk-eyebrow--centered">Как это работает</p>
                <h2 class="mk-section__title mk-section__title--centered">
                    Три шага к порядку в авто
                </h2>
            </div>
            <div class="mk-steps-grid">
                <div class="mk-step">
                    <span class="mk-step__number">1</span>
                    <div class="mk-step__body">
                        <h3 class="mk-step__title">Добавьте автомобиль</h3>
                        <p class="mk-step__desc">
                            Укажите марку, модель, год, VIN и текущий пробег —
                            всё как в техпаспорте.
                        </p>
                    </div>
                </div>
                <div class="mk-step">
                    <span class="mk-step__number">2</span>
                    <div class="mk-step__body">
                        <h3 class="mk-step__title">Вносите записи</h3>
                        <p class="mk-step__desc">
                            Заправки, ТО, поломки, покупки — добавляйте события
                            в ленту с датой и суммой.
                        </p>
                    </div>
                </div>
                <div class="mk-step">
                    <span class="mk-step__number">3</span>
                    <div class="mk-step__body">
                        <h3 class="mk-step__title">Следите за статистикой</h3>
                        <p class="mk-step__desc">
                            Расходы, пробег, напоминания — все данные наглядно
                            в карточке автомобиля.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================== -->
    <!--  ФИНАЛЬНЫЙ CTA-БЛОК (обновлённый)                          -->
    <!-- ========================================================== -->
    <section class="mk-cta-banner">
        <div class="mk-container">
            <div class="mk-cta-banner__inner">
                <div class="mk-cta-banner__content">
                    <p class="mk-eyebrow mk-eyebrow--light">Начните прямо сейчас</p>
                    <h2 class="mk-cta-banner__title">
                        Управляйте историей автомобиля<br/>с лёгкостью
                    </h2>
                    <p class="mk-cta-banner__sub">
                        MOTORKEEP — ваш личный дневник для всех машин.
                        Бесплатно, без ограничений.
                    </p>
                    <a href="#register" class="mk-btn mk-btn--white mk-btn--lg">
                        Начать бесплатно →
                    </a>
                </div>
                <div class="mk-cta-banner__visual" aria-hidden="true">
                    <svg viewBox="0 0 120 80" fill="none">
                        <rect x="8" y="18" width="104" height="44" rx="8" fill="rgba(255,255,255,.12)"/>
                        <rect x="16" y="24" width="88" height="32" rx="6" fill="rgba(255,255,255,.08)"/>
                        <path d="M28 40h64M34 32h52M38 48h44" stroke="rgba(255,255,255,.15)" stroke-width="2"
                              stroke-linecap="round"/>
                        <circle cx="46" cy="40" r="8" stroke="rgba(255,255,255,.2)" stroke-width="1.5"/>
                        <circle cx="74" cy="40" r="8" stroke="rgba(255,255,255,.2)" stroke-width="1.5"/>
                        <text x="40" y="72" font-family="Space Grotesk" font-size="18" font-weight="700"
                              fill="rgba(255,255,255,.5)">86 420 км
                        </text>
                    </svg>
                </div>
            </div>
        </div>
    </section>

</main>

@include('layouts.public.landing-footer')

</body>
</html>
