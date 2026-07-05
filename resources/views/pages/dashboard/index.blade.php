@include('layouts.public.landing-head')
<body>

<div class="mk-scrim" aria-hidden="true"></div>

@include('layouts.private.sidebar')
<!-- ======== ОСНОВНАЯ ОБОЛОЧКА ======== -->
<div class="mk-shell">
    <!-- ======== ХЕДЕР ======== -->
    <header class="mk-header" role="banner">
        <div class="mk-header__inner">
            <button class="mk-burger" aria-label="Открыть меню">
                <span></span><span></span><span></span>
            </button>
            <div class="mk-header__title">
                Мой гараж
                <span class="mk-header__crumb">/ список авто</span>
            </div>
            <div class="mk-header__right">
                <!-- КОЛОКОЛЬЧИК с popover -->
                <div class="mk-popover-wrapper">
                    <button class="mk-iconbtn js-notifications" aria-label="Уведомления" id="notif-btn">
                        <svg viewBox="0 0 24 24">
                            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                            <path d="M13.73 21a2 2 0 01-3.46 0"/>
                        </svg>
                        <span class="dot" aria-hidden="true"></span>
                    </button>
                    <div class="mk-popover mk-popover--notifications" id="notif-popover">
                        <div class="mk-popover__header">
                            <span>Уведомления</span>
                            <span class="mk-popover__badge">3 новых</span>
                        </div>
                        <ul class="mk-popover__list">
                            <li class="mk-notif-item mk-notif-item--new">
                                <span class="mk-notif-item__icon">🔧</span>
                                <div class="mk-notif-item__content">
                                    <span class="mk-notif-item__title">Замена масла</span>
                                    <span class="mk-notif-item__desc">BMW 320i · через 3 дня</span>
                                </div>
                                <span class="mk-notif-item__time">5 мин</span>
                            </li>
                            <li class="mk-notif-item mk-notif-item--new">
                                <span class="mk-notif-item__icon">📄</span>
                                <div class="mk-notif-item__content">
                                    <span class="mk-notif-item__title">ОСАГО истекает</span>
                                    <span class="mk-notif-item__desc">Toyota Camry · до 15.08.2026</span>
                                </div>
                                <span class="mk-notif-item__time">2 часа</span>
                            </li>
                            <li class="mk-notif-item">
                                <span class="mk-notif-item__icon">⛽</span>
                                <div class="mk-notif-item__content">
                                    <span class="mk-notif-item__title">Добавлена заправка</span>
                                    <span class="mk-notif-item__desc">Lada Vesta · +40 л</span>
                                </div>
                                <span class="mk-notif-item__time">вчера</span>
                            </li>
                            <li class="mk-notif-item">
                                <span class="mk-notif-item__icon">📝</span>
                                <div class="mk-notif-item__content">
                                    <span class="mk-notif-item__title">Новая заметка</span>
                                    <span class="mk-notif-item__desc">BMW 320i · «Проверить свечи»</span>
                                </div>
                                <span class="mk-notif-item__time">2 дня</span>
                            </li>
                        </ul>
                        <div class="mk-popover__footer">
                            <a href="#all-notifications">Все уведомления →</a>
                        </div>
                    </div>
                </div>

                <!-- АВАТАР с popover -->
                <div class="mk-popover-wrapper">
                    <button class="mk-userchip" aria-label="Профиль пользователя" id="profile-btn">
                        <span class="mk-userchip__avatar">{{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}</span>
                        <span class="mk-userchip__name">{{ Auth::user()->name }}</span>
                    </button>
                    <div class="mk-popover mk-popover--profile" id="profile-popover">
                        <div class="mk-popover__profile-header">
                            <div class="mk-popover__avatar">{{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}</div>
                            <div>
                                <div class="mk-popover__profile-name">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</div>
                                <div class="mk-popover__profile-email">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <ul class="mk-popover__list">
                            <li><a href="#profile">Мой профиль</a></li>
                            <li><a href="#settings">Настройки</a></li>
                            <li><a href="#billing">Платежи</a></li>
                            <li class="mk-popover__divider"></li>
                            <li><a href="#logout" style="color: var(--mk-danger);">Выйти</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ======== ОСНОВНОЙ КОНТЕНТ ======== -->
    <main class="mk-main" role="main">
        <div class="mk-container">

            <!-- Заголовок и кнопка -->
            <div class="mk-garage-head">
                <div>
                    <h1 class="mk-garage-head__title">Мой гараж</h1>
                    <p class="mk-garage-head__sub">3 автомобиля · 42 000 ₽ расходов за месяц</p>
                </div>
                <a href="#" class="mk-btn mk-btn--primary" id="add-car-btn">
                    <svg viewBox="0 0 24 24" width="18" height="18">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Добавить авто
                </a>
            </div>

            <!-- Блок общей информации (сводка) -->
            <section class="mk-garage-summary">
                <div class="mk-garage-summary__grid">
                    <div class="mk-garage-summary__card js-summary-card" data-summary="to"
                         style="--card-color: var(--mk-c-service); --card-bg: var(--mk-c-service-soft);">
                        <div class="mk-garage-summary__icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                        </div>
                        <div class="mk-garage-summary__content">
                            <span class="mk-garage-summary__label">Предстоящие ТО</span>
                            <span class="mk-garage-summary__value">2</span>
                            <span class="mk-garage-summary__meta">BMW 320i — через 1 200 км</span>
                        </div>
                    </div>
                    <div class="mk-garage-summary__card js-summary-card" data-summary="tax"
                         style="--card-color: var(--mk-warning); --card-bg: #FEF2E0;">
                        <div class="mk-garage-summary__icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="2" y="7" width="20" height="14" rx="2"/>
                                <path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/>
                            </svg>
                        </div>
                        <div class="mk-garage-summary__content">
                            <span class="mk-garage-summary__label">Налоги и страховка</span>
                            <span class="mk-garage-summary__value">2</span>
                            <span class="mk-garage-summary__meta">ОСАГО — до 15.08.2026</span>
                        </div>
                    </div>
                    <div class="mk-garage-summary__card js-summary-card" data-summary="notes"
                         style="--card-color: var(--mk-c-note); --card-bg: var(--mk-c-note-soft);">
                        <div class="mk-garage-summary__icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <polyline points="12 8 12 12 14 14"/>
                            </svg>
                        </div>
                        <div class="mk-garage-summary__content">
                            <span class="mk-garage-summary__label">Напоминания</span>
                            <span class="mk-garage-summary__value">3</span>
                            <span class="mk-garage-summary__meta">Замена свечей, шин, масла</span>
                        </div>
                    </div>
                    <div class="mk-garage-summary__card js-summary-card" data-summary="costs"
                         style="--card-color: var(--mk-c-fuel); --card-bg: var(--mk-c-fuel-soft);">
                        <div class="mk-garage-summary__icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M8 12h8"/>
                                <path d="M12 8v8"/>
                            </svg>
                        </div>
                        <div class="mk-garage-summary__content">
                            <span class="mk-garage-summary__label">Расходы за месяц</span>
                            <span class="mk-garage-summary__value">42 000 ₽</span>
                            <span class="mk-garage-summary__meta">+8% к прошлому месяцу</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Быстрые действия -->
            <section class="mk-quick-actions">
                <h2 class="mk-quick-actions__title">Быстрые действия</h2>
                <div class="mk-quick-actions__grid">
                    <button class="mk-quick-action" data-type="service"
                            style="--action-color: var(--mk-c-service); --action-bg: var(--mk-c-service-soft);">
                        <svg viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="12" y1="18" x2="12" y2="12"/>
                            <line x1="9" y1="15" x2="15" y2="15"/>
                        </svg>
                        <span>ТО</span>
                    </button>
                    <button class="mk-quick-action" data-type="fuel"
                            style="--action-color: var(--mk-c-fuel); --action-bg: var(--mk-c-fuel-soft);">
                        <svg viewBox="0 0 24 24">
                            <rect x="2" y="6" width="16" height="14" rx="2"/>
                            <path d="M18 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2"/>
                            <path d="M8 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                            <path d="M10 12l2 2 4-4"/>
                        </svg>
                        <span>Заправка</span>
                    </button>
                    <button class="mk-quick-action" data-type="repair"
                            style="--action-color: var(--mk-c-repair); --action-bg: var(--mk-c-repair-soft);">
                        <svg viewBox="0 0 24 24">
                            <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                        <span>Ремонт</span>
                    </button>
                    <button class="mk-quick-action" data-type="note"
                            style="--action-color: var(--mk-c-note); --action-bg: var(--mk-c-note-soft);">
                        <svg viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                        </svg>
                        <span>Заметка</span>
                    </button>
                </div>
            </section>

            <!-- Сетка карточек авто (обведены цветом) -->
            <div class="mk-garage-grid" id="garage-grid">
                <a href="car.html?id=1" class="mk-garage-card">
                    <div class="mk-garage-card__media">
                        <svg viewBox="0 0 120 72" fill="none" aria-hidden="true">
                            <rect x="10" y="24" width="100" height="32" rx="6" fill="#D4DCE8" opacity=".35"/>
                            <rect x="16" y="28" width="88" height="24" rx="4" fill="#E5EAF2" opacity=".5"/>
                            <path d="M28 44h64M32 36h56M36 52h48" stroke="#D4DCE8" stroke-width="2"
                                  stroke-linecap="round" opacity=".4"/>
                            <circle cx="44" cy="44" r="8" fill="#D4DCE8" opacity=".25"/>
                            <circle cx="76" cy="44" r="8" fill="#D4DCE8" opacity=".25"/>
                        </svg>
                        <span class="mk-garage-card__plate">А 777 ММ <span class="mk-garage-card__region">116 RUS</span></span>
                    </div>
                    <div class="mk-garage-card__body">
                        <h3 class="mk-garage-card__name">BMW 320i</h3>
                        <div class="mk-odo mk-odo--sm">
                            <span class="mk-odo__label">Пробег</span>
                            <span class="mk-odo__value">86 420 <span class="mk-odo__unit">км</span></span>
                            <span class="mk-odo__track" aria-hidden="true"></span>
                        </div>
                        <div class="mk-garage-card__stats">
                            <div><span class="mk-garage-card__stat-label">Расходы за год</span><span
                                    class="mk-garage-card__stat-value">214 600 ₽</span></div>
                            <div><span class="mk-garage-card__stat-label">Записей</span><span
                                    class="mk-garage-card__stat-value">12</span></div>
                            <div><span class="mk-garage-card__stat-label">До ТО</span><span
                                    class="mk-garage-card__stat-value">1 200 км</span></div>
                        </div>
                    </div>
                </a>

                <a href="car.html?id=2" class="mk-garage-card">
                    <div class="mk-garage-card__media">
                        <svg viewBox="0 0 120 72" fill="none" aria-hidden="true">
                            <rect x="10" y="24" width="100" height="32" rx="6" fill="#D4DCE8" opacity=".35"/>
                            <rect x="16" y="28" width="88" height="24" rx="4" fill="#E5EAF2" opacity=".5"/>
                            <path d="M28 44h64M32 36h56M36 52h48" stroke="#D4DCE8" stroke-width="2"
                                  stroke-linecap="round" opacity=".4"/>
                            <circle cx="44" cy="44" r="8" fill="#D4DCE8" opacity=".25"/>
                            <circle cx="76" cy="44" r="8" fill="#D4DCE8" opacity=".25"/>
                        </svg>
                        <span class="mk-garage-card__plate">В 123 КН <span class="mk-garage-card__region">50 RUS</span></span>
                    </div>
                    <div class="mk-garage-card__body">
                        <h3 class="mk-garage-card__name">Toyota Camry</h3>
                        <div class="mk-odo mk-odo--sm">
                            <span class="mk-odo__label">Пробег</span>
                            <span class="mk-odo__value">42 150 <span class="mk-odo__unit">км</span></span>
                            <span class="mk-odo__track" aria-hidden="true"></span>
                        </div>
                        <div class="mk-garage-card__stats">
                            <div><span class="mk-garage-card__stat-label">Расходы за год</span><span
                                    class="mk-garage-card__stat-value">98 300 ₽</span></div>
                            <div><span class="mk-garage-card__stat-label">Записей</span><span
                                    class="mk-garage-card__stat-value">8</span></div>
                            <div><span class="mk-garage-card__stat-label">До ТО</span><span
                                    class="mk-garage-card__stat-value">3 800 км</span></div>
                        </div>
                    </div>
                </a>

                <a href="car.html?id=3" class="mk-garage-card">
                    <div class="mk-garage-card__media">
                        <svg viewBox="0 0 120 72" fill="none" aria-hidden="true">
                            <rect x="10" y="24" width="100" height="32" rx="6" fill="#D4DCE8" opacity=".35"/>
                            <rect x="16" y="28" width="88" height="24" rx="4" fill="#E5EAF2" opacity=".5"/>
                            <path d="M28 44h64M32 36h56M36 52h48" stroke="#D4DCE8" stroke-width="2"
                                  stroke-linecap="round" opacity=".4"/>
                            <circle cx="44" cy="44" r="8" fill="#D4DCE8" opacity=".25"/>
                            <circle cx="76" cy="44" r="8" fill="#D4DCE8" opacity=".25"/>
                        </svg>
                        <span class="mk-garage-card__plate">С 999 РР <span class="mk-garage-card__region">102 RUS</span></span>
                    </div>
                    <div class="mk-garage-card__body">
                        <h3 class="mk-garage-card__name">Lada Vesta</h3>
                        <div class="mk-odo mk-odo--sm">
                            <span class="mk-odo__label">Пробег</span>
                            <span class="mk-odo__value">12 800 <span class="mk-odo__unit">км</span></span>
                            <span class="mk-odo__track" aria-hidden="true"></span>
                        </div>
                        <div class="mk-garage-card__stats">
                            <div><span class="mk-garage-card__stat-label">Расходы за год</span><span
                                    class="mk-garage-card__stat-value">32 400 ₽</span></div>
                            <div><span class="mk-garage-card__stat-label">Записей</span><span
                                    class="mk-garage-card__stat-value">5</span></div>
                            <div><span class="mk-garage-card__stat-label">До ТО</span><span
                                    class="mk-garage-card__stat-value">2 200 км</span></div>
                        </div>
                    </div>
                </a>

                <a href="#" class="mk-garage-card mk-garage-card--add" id="add-car-card">
                    <div class="mk-garage-card__add-icon">
                        <svg viewBox="0 0 24 24" width="48" height="48">
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                    </div>
                    <span class="mk-garage-card__add-text">Добавить автомобиль</span>
                </a>
            </div>

            <!-- Блок "История и напоминания" -->
            <section class="mk-garage-extra">
                <div class="mk-garage-extra__grid">
                    <!-- Колонка: История -->
                    <div class="mk-garage-extra__col">
                        <div class="mk-section-head">
                            <h2>Последние действия</h2>
                            <span class="count">6</span>
                            <div class="spacer"></div>
                            <a href="#" class="mk-btn mk-btn--ghost mk-btn--sm js-show-all"
                               data-target="activity">Все</a>
                        </div>
                        <div class="mk-activity-list" id="activity-list">
                            <div class="mk-activity-item mk-activity-item--add">
                                <span class="mk-activity-item__time">Сегодня, 14:23</span>
                                <span class="mk-activity-item__badge">Добавление</span>
                                <span class="mk-activity-item__text">Запись «ТО» для <strong>BMW 320i</strong></span>
                            </div>
                            <div class="mk-activity-item mk-activity-item--edit">
                                <span class="mk-activity-item__time">Сегодня, 11:05</span>
                                <span class="mk-activity-item__badge">Изменение</span>
                                <span class="mk-activity-item__text">Пробег у <strong>Toyota Camry</strong> → 42 150 км</span>
                            </div>
                            <div class="mk-activity-item mk-activity-item--delete">
                                <span class="mk-activity-item__time">Вчера, 18:40</span>
                                <span class="mk-activity-item__badge">Удаление</span>
                                <span
                                    class="mk-activity-item__text">Запись о заправке для <strong>Lada Vesta</strong></span>
                            </div>
                            <div class="mk-activity-item mk-activity-item--add">
                                <span class="mk-activity-item__time">Вчера, 09:12</span>
                                <span class="mk-activity-item__badge">Добавление</span>
                                <span
                                    class="mk-activity-item__text">Запись «Ремонт» для <strong>BMW 320i</strong></span>
                            </div>
                            <div class="mk-activity-item mk-activity-item--add">
                                <span class="mk-activity-item__time">20.06.2026, 16:03</span>
                                <span class="mk-activity-item__badge">Добавление</span>
                                <span class="mk-activity-item__text">Запись «Заправка» для <strong>Toyota Camry</strong></span>
                            </div>
                            <div class="mk-activity-item mk-activity-item--edit">
                                <span class="mk-activity-item__time">19.06.2026, 10:30</span>
                                <span class="mk-activity-item__badge">Изменение</span>
                                <span class="mk-activity-item__text">Дата ТО для <strong>Lada Vesta</strong></span>
                            </div>
                        </div>
                    </div>

                    <!-- Колонка: Напоминания -->
                    <div class="mk-garage-extra__col">
                        <div class="mk-section-head">
                            <h2>Напоминания</h2>
                            <span class="count" id="reminder-count">3</span>
                            <div class="spacer"></div>
                            <a href="#" class="mk-btn mk-btn--ghost mk-btn--sm js-show-all"
                               data-target="reminders">Все</a>
                        </div>
                        <div class="mk-reminder-list" id="reminder-list">
                            <div class="mk-reminder-item mk-reminder-item--urgent" data-id="1">
                                <div class="mk-reminder-item__info">
                                    <span class="mk-reminder-item__title">Замена масла</span>
                                    <span class="mk-reminder-item__meta">BMW 320i · до 15.07.2026</span>
                                </div>
                                <div class="mk-reminder-item__actions">
                                    <button class="mk-reminder-item__done" title="Отметить выполненным">✅</button>
                                    <button class="mk-reminder-item__postpone" title="Перенести на +1 день">⏩</button>
                                </div>
                            </div>
                            <div class="mk-reminder-item" data-id="2">
                                <div class="mk-reminder-item__info">
                                    <span class="mk-reminder-item__title">Проверить свечи</span>
                                    <span class="mk-reminder-item__meta">Toyota Camry · до 01.08.2026</span>
                                </div>
                                <div class="mk-reminder-item__actions">
                                    <button class="mk-reminder-item__done" title="Отметить выполненным">✅</button>
                                    <button class="mk-reminder-item__postpone" title="Перенести на +1 день">⏩</button>
                                </div>
                            </div>
                            <div class="mk-reminder-item mk-reminder-item--overdue" data-id="3">
                                <div class="mk-reminder-item__info">
                                    <span class="mk-reminder-item__title">Замена шин</span>
                                    <span class="mk-reminder-item__meta">Lada Vesta · до 20.08.2026</span>
                                </div>
                                <div class="mk-reminder-item__actions">
                                    <button class="mk-reminder-item__done" title="Отметить выполненным">✅</button>
                                    <button class="mk-reminder-item__postpone" title="Перенести на +1 день">⏩</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main>

    @include('layouts.private.footer')
</div> <!-- /.mk-shell -->

<!-- ======== МОДАЛКА ======== -->
<div class="mk-overlay" id="popup-overlay">
    <div class="mk-modal">
        <div class="mk-modal__head">
            <h3 class="mk-modal__title" id="popup-title">Заголовок</h3>
            <button class="mk-modal__close" id="popup-close">&times;</button>
        </div>
        <div class="mk-modal__body" id="popup-body">
            <!-- Контент "Все действия" -->
            <div id="popup-content-activity" style="display:none;">
                <div class="mk-timeline">
                    <div class="mk-timeline-item mk-timeline-item--add">
                        <div class="mk-timeline-item__dot"></div>
                        <div class="mk-timeline-item__content">
                            <div class="mk-timeline-item__header">
                                <span class="mk-timeline-item__badge">Добавление</span>
                                <span class="mk-timeline-item__time">Сегодня, 14:23</span>
                            </div>
                            <div class="mk-timeline-item__body">
                                <span class="mk-timeline-item__icon">✅</span>
                                <span>Добавлена запись «ТО» для <strong>BMW 320i</strong></span>
                            </div>
                            <div class="mk-timeline-item__meta">
                                <span>Пробег: 86 420 км</span>
                                <span>Сумма: 12 500 ₽</span>
                            </div>
                        </div>
                    </div>
                    <div class="mk-timeline-item mk-timeline-item--edit">
                        <div class="mk-timeline-item__dot"></div>
                        <div class="mk-timeline-item__content">
                            <div class="mk-timeline-item__header">
                                <span class="mk-timeline-item__badge">Изменение</span>
                                <span class="mk-timeline-item__time">Сегодня, 11:05</span>
                            </div>
                            <div class="mk-timeline-item__body">
                                <span class="mk-timeline-item__icon">✏️</span>
                                <span>Изменён пробег у <strong>Toyota Camry</strong> → 42 150 км</span>
                            </div>
                        </div>
                    </div>
                    <div class="mk-timeline-item mk-timeline-item--delete">
                        <div class="mk-timeline-item__dot"></div>
                        <div class="mk-timeline-item__content">
                            <div class="mk-timeline-item__header">
                                <span class="mk-timeline-item__badge">Удаление</span>
                                <span class="mk-timeline-item__time">Вчера, 18:40</span>
                            </div>
                            <div class="mk-timeline-item__body">
                                <span class="mk-timeline-item__icon">🗑️</span>
                                <span>Удалена запись о заправке для <strong>Lada Vesta</strong></span>
                            </div>
                            <div class="mk-timeline-item__meta">
                                <span>Было: 40 л, 2 800 ₽</span>
                            </div>
                        </div>
                    </div>
                    <div class="mk-timeline-item mk-timeline-item--add">
                        <div class="mk-timeline-item__dot"></div>
                        <div class="mk-timeline-item__content">
                            <div class="mk-timeline-item__header">
                                <span class="mk-timeline-item__badge">Добавление</span>
                                <span class="mk-timeline-item__time">Вчера, 09:12</span>
                            </div>
                            <div class="mk-timeline-item__body">
                                <span class="mk-timeline-item__icon">🔧</span>
                                <span>Добавлена запись «Ремонт» для <strong>BMW 320i</strong></span>
                            </div>
                            <div class="mk-timeline-item__meta">
                                <span>Замена тормозных колодок</span>
                            </div>
                        </div>
                    </div>
                    <div class="mk-timeline-item mk-timeline-item--add">
                        <div class="mk-timeline-item__dot"></div>
                        <div class="mk-timeline-item__content">
                            <div class="mk-timeline-item__header">
                                <span class="mk-timeline-item__badge">Добавление</span>
                                <span class="mk-timeline-item__time">20.06.2026, 16:03</span>
                            </div>
                            <div class="mk-timeline-item__body">
                                <span class="mk-timeline-item__icon">⛽</span>
                                <span>Добавлена запись «Заправка» для <strong>Toyota Camry</strong></span>
                            </div>
                            <div class="mk-timeline-item__meta">
                                <span>45 л, 3 150 ₽</span>
                            </div>
                        </div>
                    </div>
                    <div class="mk-timeline-item mk-timeline-item--edit">
                        <div class="mk-timeline-item__dot"></div>
                        <div class="mk-timeline-item__content">
                            <div class="mk-timeline-item__header">
                                <span class="mk-timeline-item__badge">Изменение</span>
                                <span class="mk-timeline-item__time">19.06.2026, 10:30</span>
                            </div>
                            <div class="mk-timeline-item__body">
                                <span class="mk-timeline-item__icon">📅</span>
                                <span>Изменена дата ТО для <strong>Lada Vesta</strong></span>
                            </div>
                            <div class="mk-timeline-item__meta">
                                <span>Было: 15.07.2026 → Стало: 22.07.2026</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Контент "Все напоминания" -->
            <div id="popup-content-reminders" style="display:none;">
                <div class="mk-reminders-grid">
                    <div class="mk-reminder-card mk-reminder-card--urgent">
                        <div class="mk-reminder-card__header">
                            <span class="mk-reminder-card__priority">🔴 Срочно</span>
                            <span class="mk-reminder-card__date">до 15.07.2026</span>
                        </div>
                        <div class="mk-reminder-card__body">
                            <h4 class="mk-reminder-card__title">Замена масла</h4>
                            <p class="mk-reminder-card__desc">BMW 320i · Пробег 86 420 км</p>
                            <div class="mk-reminder-card__meta">
                                <span>⏳ Осталось 3 дня</span>
                                <span>📌 Рекомендуется</span>
                            </div>
                        </div>
                        <div class="mk-reminder-card__actions">
                            <button class="mk-btn mk-btn--success mk-btn--sm">✅ Выполнено</button>
                            <button class="mk-btn mk-btn--ghost mk-btn--sm">⏩ Перенести</button>
                        </div>
                    </div>
                    <div class="mk-reminder-card">
                        <div class="mk-reminder-card__header">
                            <span class="mk-reminder-card__priority">🟡 Средний</span>
                            <span class="mk-reminder-card__date">до 01.08.2026</span>
                        </div>
                        <div class="mk-reminder-card__body">
                            <h4 class="mk-reminder-card__title">Проверить свечи</h4>
                            <p class="mk-reminder-card__desc">Toyota Camry · Пробег 42 150 км</p>
                            <div class="mk-reminder-card__meta">
                                <span>⏳ Осталось 20 дней</span>
                            </div>
                        </div>
                        <div class="mk-reminder-card__actions">
                            <button class="mk-btn mk-btn--success mk-btn--sm">✅ Выполнено</button>
                            <button class="mk-btn mk-btn--ghost mk-btn--sm">⏩ Перенести</button>
                        </div>
                    </div>
                    <div class="mk-reminder-card mk-reminder-card--overdue">
                        <div class="mk-reminder-card__header">
                            <span class="mk-reminder-card__priority">🟠 Просрочено</span>
                            <span class="mk-reminder-card__date">до 20.08.2026</span>
                        </div>
                        <div class="mk-reminder-card__body">
                            <h4 class="mk-reminder-card__title">Замена шин</h4>
                            <p class="mk-reminder-card__desc">Lada Vesta · Пробег 12 800 км</p>
                            <div class="mk-reminder-card__meta">
                                <span>⚠️ Просрочено на 12 дней</span>
                            </div>
                        </div>
                        <div class="mk-reminder-card__actions">
                            <button class="mk-btn mk-btn--success mk-btn--sm">✅ Выполнено</button>
                            <button class="mk-btn mk-btn--ghost mk-btn--sm">⏩ Перенести</button>
                        </div>
                    </div>
                    <div class="mk-reminder-card">
                        <div class="mk-reminder-card__header">
                            <span class="mk-reminder-card__priority">🟢 Низкий</span>
                            <span class="mk-reminder-card__date">до 10.09.2026</span>
                        </div>
                        <div class="mk-reminder-card__body">
                            <h4 class="mk-reminder-card__title">Замена антифриза</h4>
                            <p class="mk-reminder-card__desc">BMW 320i · Пробег 86 420 км</p>
                            <div class="mk-reminder-card__meta">
                                <span>⏳ Осталось 2 месяца</span>
                            </div>
                        </div>
                        <div class="mk-reminder-card__actions">
                            <button class="mk-btn mk-btn--success mk-btn--sm">✅ Выполнено</button>
                            <button class="mk-btn mk-btn--ghost mk-btn--sm">⏩ Перенести</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Дефолтный контент -->
            <div id="popup-content-default" style="display:block;">
                <p>Информация</p>
            </div>
        </div>
    </div>
</div>

<!-- ======== ТОСТЫ ======== -->
<div class="mk-toast-container" aria-live="polite"></div>

</body>
</html>
