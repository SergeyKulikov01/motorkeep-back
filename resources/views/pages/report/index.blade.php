@include('layouts.public.landing-head')
<body class="mk-report-body">

<!-- ====== ШАПКА ====== -->
<header class="mk-report-header">
    <div class="mk-report-header__inner">
        <a href="#" class="mk-logo" aria-label="MOTORKEEP">
            <span class="mk-logo__mark"><i class="bi bi-car-front-fill"></i></span>
            <span class="mk-logo__text">MOTOR<span>KEEP</span></span>
        </a>
        <nav class="mk-report-header__crumb" aria-label="Навигация">
            <a href="#">Гараж</a>
            <svg class="mk-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
            <a href="#">BMW 320i</a>
            <svg class="mk-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
            <span>Отчёт</span>
        </nav>
        <div class="mk-report-header__actions">
            <button class="mk-btn mk-btn--ghost mk-btn--sm mk-no-print" id="shareBtn" aria-label="Поделиться">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                <span>Поделиться</span>
            </button>
            <button class="mk-btn mk-btn--primary mk-btn--sm mk-no-print" id="printBtn" aria-label="Скачать PDF">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                <span>Скачать PDF</span>
            </button>
        </div>
    </div>
</header>

<main class="mk-report-main">
    <div class="mk-report-container">

        <!-- ЗАГОЛОВОК -->
        <div class="mk-report-title">
            <div class="mk-eyebrow">Отчёт об автомобиле</div>
            <h1 class="mk-report-title__h1">BMW 320i, 2019</h1>
            <div class="mk-report-title__sub">
                Сформирован 16 сентября 2026 · Период: 12 марта 2022 — настоящее время
            </div>
        </div>

        <!-- HERO -->
        <section class="mk-report-hero" aria-label="Сводка по автомобилю">
            <div class="mk-report-hero__media">
                <div class="mk-report-hero__silhouette" role="img" aria-label="Силуэт BMW 320i">
                    <svg viewBox="0 0 400 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="60" y="40" width="280" height="100" rx="8" fill="#EAF1FF" stroke="#2F6BFF" stroke-width="2"/>
                        <rect x="100" y="100" width="200" height="30" rx="4" fill="#2F6BFF" opacity="0.2"/>
                        <circle cx="140" cy="140" r="24" stroke="#2F6BFF" stroke-width="2" fill="#fff"/>
                        <circle cx="260" cy="140" r="24" stroke="#2F6BFF" stroke-width="2" fill="#fff"/>
                        <line x1="80" y1="70" x2="320" y2="70" stroke="#2F6BFF" stroke-width="2" stroke-dasharray="4 4"/>
                        <rect x="180" y="80" width="40" height="16" rx="4" fill="#2F6BFF" opacity="0.3"/>
                    </svg>
                </div>
                <div class="mk-report-hero__plate">А 777 МР 123</div>
            </div>
            <div class="mk-report-hero__body">
                <div class="mk-odo">
                    <span class="mk-odo__label">Текущий пробег</span>
                    <span class="mk-odo__value">86 420 <span>км</span></span>
                    <div class="mk-odo__track" style="--pct: 65%;"></div>
                </div>
                <div class="mk-report-hero__meta">
                    <div class="mk-report-hero__meta-item">
                        <span class="mk-report-hero__meta-label">Марка и модель</span>
                        <span class="mk-report-hero__meta-value">BMW 320i</span>
                    </div>
                    <div class="mk-report-hero__meta-item">
                        <span class="mk-report-hero__meta-label">Год выпуска</span>
                        <span class="mk-report-hero__meta-value">2019</span>
                    </div>
                    <div class="mk-report-hero__meta-item">
                        <span class="mk-report-hero__meta-label">Двигатель</span>
                        <span class="mk-report-hero__meta-value">2.0 л, 184 л.с., бензин</span>
                    </div>
                    <div class="mk-report-hero__meta-item">
                        <span class="mk-report-hero__meta-label">КПП</span>
                        <span class="mk-report-hero__meta-value">Автомат, 8 ст.</span>
                    </div>
                    <div class="mk-report-hero__meta-item">
                        <span class="mk-report-hero__meta-label">Кузов</span>
                        <span class="mk-report-hero__meta-value">Седан, 4 двери</span>
                    </div>
                    <div class="mk-report-hero__meta-item">
                        <span class="mk-report-hero__meta-label">Цвет</span>
                        <span class="mk-report-hero__meta-value">Чёрный металлик</span>
                    </div>
                    <div class="mk-report-hero__meta-item mk-report-hero__meta-item--wide">
                        <span class="mk-report-hero__meta-label">VIN</span>
                        <span class="mk-report-hero__meta-value mk-mono">WBA8A9C50KX123456</span>
                    </div>
                    <div class="mk-report-hero__meta-item mk-report-hero__meta-item--wide">
                        <span class="mk-report-hero__meta-label">Госномер</span>
                        <span class="mk-report-hero__meta-value mk-mono">А 777 МР 123</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- KPI (4) -->
        <section class="mk-report-kpis" aria-label="Ключевые показатели">
            <div class="mk-kpi">
                <div class="mk-kpi__label">Период владения</div>
                <div class="mk-kpi__value">4 <span>года</span> 6 <span>мес.</span></div>
                <div class="mk-kpi__hint">с 12 марта 2022</div>
            </div>
            <div class="mk-kpi">
                <div class="mk-kpi__label">Пробег за период</div>
                <div class="mk-kpi__value">42 180 <span>км</span></div>
                <div class="mk-kpi__hint">≈ 780 км / мес</div>
            </div>
            <div class="mk-kpi">
                <div class="mk-kpi__label">Всего расходов</div>
                <div class="mk-kpi__value">274 900 <span>₽</span></div>
                <div class="mk-kpi__hint">все категории</div>
            </div>
            <div class="mk-kpi">
                <div class="mk-kpi__label">Стоимость 1 км</div>
                <div class="mk-kpi__value">6.52 <span>₽</span></div>
                <div class="mk-kpi__hint">за весь период владения</div>
            </div>
        </section>

        <!-- ТАБЛИЦА КАТЕГОРИЙ -->
        <section class="mk-report-section" aria-label="Сводка по категориям">
            <div class="mk-section-head">
                <h2 class="mk-section-head__title">Расходы по категориям</h2>
                <div class="mk-section-head__spacer"></div>
                <button class="mk-btn mk-btn--ghost mk-btn--sm mk-no-print" id="exportBtn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Экспорт CSV
                </button>
            </div>

            <div class="mk-report-table-wrap">
                <table class="mk-report-table">
                    <thead>
                    <tr>
                        <th>Категория</th>
                        <th class="num">Сумма</th>
                        <th class="num">Доля</th>
                        <th class="num">Записей</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><span class="mk-report-table__dot" style="background:var(--mk-c-service);"></span> ТО и обслуживание</td>
                        <td class="num">128 400 ₽</td>
                        <td class="num">46.7%</td>
                        <td class="num">14</td>
                    </tr>
                    <tr>
                        <td><span class="mk-report-table__dot" style="background:var(--mk-c-repair);"></span> Ремонт и поломки</td>
                        <td class="num">96 200 ₽</td>
                        <td class="num">35.0%</td>
                        <td class="num">9</td>
                    </tr>
                    <tr>
                        <td><span class="mk-report-table__dot" style="background:var(--mk-c-buy);"></span> Покупки</td>
                        <td class="num">35 900 ₽</td>
                        <td class="num">13.1%</td>
                        <td class="num">7</td>
                    </tr>
                    <tr>
                        <td><span class="mk-report-table__dot" style="background:#94A3B8;"></span> Прочее</td>
                        <td class="num">14 400 ₽</td>
                        <td class="num">5.2%</td>
                        <td class="num">4</td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td><strong>Итого</strong></td>
                        <td class="num"><strong>274 900 ₽</strong></td>
                        <td class="num"><strong>100%</strong></td>
                        <td class="num"><strong>34</strong></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </section>

        <!-- ДИАГРАММА -->
        <section class="mk-report-section" aria-label="Динамика расходов">
            <div class="mk-section-head">
                <h2 class="mk-section-head__title">Динамика расходов</h2>
                <div class="mk-section-head__spacer"></div>
                <div class="mk-report-chart__legend">
                    <span><span class="mk-report-chart__dot" style="background:var(--mk-c-service);"></span> ТО</span>
                    <span><span class="mk-report-chart__dot" style="background:var(--mk-c-repair);"></span> Ремонт</span>
                    <span><span class="mk-report-chart__dot" style="background:var(--mk-c-buy);"></span> Покупки</span>
                    <span><span class="mk-report-chart__dot" style="background:#94A3B8;"></span> Прочее</span>
                </div>
            </div>
            <div class="mk-report-chart">
                <div class="mk-report-chart__col">
                    <div class="mk-report-chart__bar-stack">
                        <div class="mk-report-chart__bar" style="--h: 28%; background: var(--mk-c-service);"></div>
                        <div class="mk-report-chart__bar" style="--h: 12%; background: var(--mk-c-repair);"></div>
                        <div class="mk-report-chart__bar" style="--h: 4%; background: var(--mk-c-buy);"></div>
                        <div class="mk-report-chart__bar" style="--h: 2%; background: #94A3B8;"></div>
                    </div>
                    <span class="mk-report-chart__label">окт</span>
                </div>
                <div class="mk-report-chart__col">
                    <div class="mk-report-chart__bar-stack">
                        <div class="mk-report-chart__bar" style="--h: 16%; background: var(--mk-c-service);"></div>
                        <div class="mk-report-chart__bar" style="--h: 30%; background: var(--mk-c-repair);"></div>
                        <div class="mk-report-chart__bar" style="--h: 3%; background: var(--mk-c-buy);"></div>
                        <div class="mk-report-chart__bar" style="--h: 2%; background: #94A3B8;"></div>
                    </div>
                    <span class="mk-report-chart__label">ноя</span>
                </div>
                <div class="mk-report-chart__col">
                    <div class="mk-report-chart__bar-stack">
                        <div class="mk-report-chart__bar" style="--h: 8%; background: var(--mk-c-service);"></div>
                        <div class="mk-report-chart__bar" style="--h: 6%; background: var(--mk-c-repair);"></div>
                        <div class="mk-report-chart__bar" style="--h: 18%; background: var(--mk-c-buy);"></div>
                        <div class="mk-report-chart__bar" style="--h: 3%; background: #94A3B8;"></div>
                    </div>
                    <span class="mk-report-chart__label">дек</span>
                </div>
                <div class="mk-report-chart__col">
                    <div class="mk-report-chart__bar-stack">
                        <div class="mk-report-chart__bar" style="--h: 12%; background: var(--mk-c-service);"></div>
                        <div class="mk-report-chart__bar" style="--h: 10%; background: var(--mk-c-repair);"></div>
                        <div class="mk-report-chart__bar" style="--h: 2%; background: var(--mk-c-buy);"></div>
                        <div class="mk-report-chart__bar" style="--h: 2%; background: #94A3B8;"></div>
                    </div>
                    <span class="mk-report-chart__label">янв</span>
                </div>
                <div class="mk-report-chart__col">
                    <div class="mk-report-chart__bar-stack">
                        <div class="mk-report-chart__bar" style="--h: 10%; background: var(--mk-c-service);"></div>
                        <div class="mk-report-chart__bar" style="--h: 8%; background: var(--mk-c-repair);"></div>
                        <div class="mk-report-chart__bar" style="--h: 3%; background: var(--mk-c-buy);"></div>
                        <div class="mk-report-chart__bar" style="--h: 2%; background: #94A3B8;"></div>
                    </div>
                    <span class="mk-report-chart__label">фев</span>
                </div>
                <div class="mk-report-chart__col">
                    <div class="mk-report-chart__bar-stack">
                        <div class="mk-report-chart__bar" style="--h: 18%; background: var(--mk-c-service);"></div>
                        <div class="mk-report-chart__bar" style="--h: 14%; background: var(--mk-c-repair);"></div>
                        <div class="mk-report-chart__bar" style="--h: 4%; background: var(--mk-c-buy);"></div>
                        <div class="mk-report-chart__bar" style="--h: 3%; background: #94A3B8;"></div>
                    </div>
                    <span class="mk-report-chart__label">мар</span>
                </div>
                <div class="mk-report-chart__col">
                    <div class="mk-report-chart__bar-stack">
                        <div class="mk-report-chart__bar" style="--h: 22%; background: var(--mk-c-service);"></div>
                        <div class="mk-report-chart__bar" style="--h: 16%; background: var(--mk-c-repair);"></div>
                        <div class="mk-report-chart__bar" style="--h: 8%; background: var(--mk-c-buy);"></div>
                        <div class="mk-report-chart__bar" style="--h: 3%; background: #94A3B8;"></div>
                    </div>
                    <span class="mk-report-chart__label">апр</span>
                </div>
                <div class="mk-report-chart__col">
                    <div class="mk-report-chart__bar-stack">
                        <div class="mk-report-chart__bar" style="--h: 8%; background: var(--mk-c-service);"></div>
                        <div class="mk-report-chart__bar" style="--h: 10%; background: var(--mk-c-repair);"></div>
                        <div class="mk-report-chart__bar" style="--h: 2%; background: var(--mk-c-buy);"></div>
                        <div class="mk-report-chart__bar" style="--h: 2%; background: #94A3B8;"></div>
                    </div>
                    <span class="mk-report-chart__label">май</span>
                </div>
                <div class="mk-report-chart__col">
                    <div class="mk-report-chart__bar-stack">
                        <div class="mk-report-chart__bar" style="--h: 12%; background: var(--mk-c-service);"></div>
                        <div class="mk-report-chart__bar" style="--h: 8%; background: var(--mk-c-repair);"></div>
                        <div class="mk-report-chart__bar" style="--h: 20%; background: var(--mk-c-buy);"></div>
                        <div class="mk-report-chart__bar" style="--h: 3%; background: #94A3B8;"></div>
                    </div>
                    <span class="mk-report-chart__label">июн</span>
                </div>
                <div class="mk-report-chart__col">
                    <div class="mk-report-chart__bar-stack">
                        <div class="mk-report-chart__bar" style="--h: 14%; background: var(--mk-c-service);"></div>
                        <div class="mk-report-chart__bar" style="--h: 6%; background: var(--mk-c-repair);"></div>
                        <div class="mk-report-chart__bar" style="--h: 2%; background: var(--mk-c-buy);"></div>
                        <div class="mk-report-chart__bar" style="--h: 2%; background: #94A3B8;"></div>
                    </div>
                    <span class="mk-report-chart__label">июл</span>
                </div>
                <div class="mk-report-chart__col">
                    <div class="mk-report-chart__bar-stack">
                        <div class="mk-report-chart__bar" style="--h: 10%; background: var(--mk-c-service);"></div>
                        <div class="mk-report-chart__bar" style="--h: 8%; background: var(--mk-c-repair);"></div>
                        <div class="mk-report-chart__bar" style="--h: 3%; background: var(--mk-c-buy);"></div>
                        <div class="mk-report-chart__bar" style="--h: 2%; background: #94A3B8;"></div>
                    </div>
                    <span class="mk-report-chart__label">авг</span>
                </div>
                <div class="mk-report-chart__col">
                    <div class="mk-report-chart__bar-stack">
                        <div class="mk-report-chart__bar" style="--h: 18%; background: var(--mk-c-service);"></div>
                        <div class="mk-report-chart__bar" style="--h: 12%; background: var(--mk-c-repair);"></div>
                        <div class="mk-report-chart__bar" style="--h: 5%; background: var(--mk-c-buy);"></div>
                        <div class="mk-report-chart__bar" style="--h: 3%; background: #94A3B8;"></div>
                    </div>
                    <span class="mk-report-chart__label">сен</span>
                </div>
            </div>
            <div class="mk-report-chart__axis">
                <span>0 ₽</span>
                <span>15 000 ₽</span>
                <span>30 000 ₽</span>
            </div>
        </section>

        <!-- НОВАЯ СЕКЦИЯ: ПОСЕЩЕНИЕ СЕРВИСОВ -->
        <section class="mk-report-section" aria-label="Посещение сервисов">
            <div class="mk-section-head">
                <h2 class="mk-section-head__title">Посещение сервисов <span class="count">14</span></h2>
                <div class="mk-section-head__spacer"></div>
                <span class="mk-report-badge-info">Последний визит — 12.06.2026</span>
            </div>

            <div class="mk-timeline">
                <div class="mk-timeline__item">
                    <div class="mk-timeline__marker" style="background: var(--mk-c-service);"></div>
                    <div class="mk-timeline__date">12.06.2026 · 82 400 км</div>
                    <div class="mk-timeline__title">Автосервис «Техно»</div>
                    <div class="mk-timeline__desc">Замена моторного масла 5W-30, масляного, воздушного и салонного фильтров</div>
                    <div class="mk-timeline__meta">
                        <span>8 200 ₽</span>
                        <span class="mk-timeline__tag" style="background: var(--mk-c-service-soft); color: var(--mk-c-service);">ТО</span>
                    </div>
                </div>

                <div class="mk-timeline__item">
                    <div class="mk-timeline__marker" style="background: var(--mk-c-repair);"></div>
                    <div class="mk-timeline__date">02.06.2026 · 80 100 км</div>
                    <div class="mk-timeline__title">СТО «АвтоСпас»</div>
                    <div class="mk-timeline__desc">Замена передних и задних тормозных колодок, датчиков износа</div>
                    <div class="mk-timeline__meta">
                        <span>5 600 ₽</span>
                        <span class="mk-timeline__tag" style="background: var(--mk-c-repair-soft); color: var(--mk-c-repair);">Ремонт</span>
                    </div>
                </div>

                <div class="mk-timeline__item">
                    <div class="mk-timeline__marker" style="background: var(--mk-c-service);"></div>
                    <div class="mk-timeline__date">18.03.2026 · 76 200 км</div>
                    <div class="mk-timeline__title">Автосервис «Техно»</div>
                    <div class="mk-timeline__desc">Замена свечей зажигания NGK, проверка катушек зажигания</div>
                    <div class="mk-timeline__meta">
                        <span>6 800 ₽</span>
                        <span class="mk-timeline__tag" style="background: var(--mk-c-service-soft); color: var(--mk-c-service);">ТО</span>
                    </div>
                </div>

                <div class="mk-timeline__item">
                    <div class="mk-timeline__marker" style="background: var(--mk-c-repair);"></div>
                    <div class="mk-timeline__date">05.02.2026 · 71 500 км</div>
                    <div class="mk-timeline__title">СТО «АвтоСпас»</div>
                    <div class="mk-timeline__desc">Замена передних стоек стабилизатора, втулок стабилизатора</div>
                    <div class="mk-timeline__meta">
                        <span>9 400 ₽</span>
                        <span class="mk-timeline__tag" style="background: var(--mk-c-repair-soft); color: var(--mk-c-repair);">Ремонт</span>
                    </div>
                </div>

                <div class="mk-timeline__item">
                    <div class="mk-timeline__marker" style="background: var(--mk-c-buy);"></div>
                    <div class="mk-timeline__date">14.10.2025 · 66 200 км</div>
                    <div class="mk-timeline__title">Шинный центр «Колесо»</div>
                    <div class="mk-timeline__desc">Сезонная замена резины, балансировка колёс</div>
                    <div class="mk-timeline__meta">
                        <span>3 200 ₽</span>
                        <span class="mk-timeline__tag" style="background: var(--mk-c-buy-soft); color: var(--mk-c-buy);">Шины</span>
                    </div>
                </div>

                <div class="mk-timeline__item">
                    <div class="mk-timeline__marker" style="background: var(--mk-c-service);"></div>
                    <div class="mk-timeline__date">05.08.2025 · 62 400 км</div>
                    <div class="mk-timeline__title">Официальный дилер «BMW Автодом»</div>
                    <div class="mk-timeline__desc">Плановое ТО-3: масло, все фильтры, проверка жидкостей, диагностика подвески</div>
                    <div class="mk-timeline__meta">
                        <span>18 400 ₽</span>
                        <span class="mk-timeline__tag" style="background: var(--mk-c-service-soft); color: var(--mk-c-service);">ТО</span>
                    </div>
                </div>

                <div class="mk-timeline__item">
                    <div class="mk-timeline__marker" style="background: var(--mk-c-repair);"></div>
                    <div class="mk-timeline__date">22.06.2025 · 58 900 км</div>
                    <div class="mk-timeline__title">Гараж «У Алексея»</div>
                    <div class="mk-timeline__desc">Ремонт кондиционера, заправка фреоном, замена салонного фильтра</div>
                    <div class="mk-timeline__meta">
                        <span>4 800 ₽</span>
                        <span class="mk-timeline__tag" style="background: var(--mk-c-repair-soft); color: var(--mk-c-repair);">Ремонт</span>
                    </div>
                </div>

                <div class="mk-timeline__item">
                    <div class="mk-timeline__marker" style="background: var(--mk-c-buy);"></div>
                    <div class="mk-timeline__date">15.04.2025 · 55 800 км</div>
                    <div class="mk-timeline__title">Шинный центр «Колесо»</div>
                    <div class="mk-timeline__desc">Сезонная замена резины, балансировка</div>
                    <div class="mk-timeline__meta">
                        <span>3 200 ₽</span>
                        <span class="mk-timeline__tag" style="background: var(--mk-c-buy-soft); color: var(--mk-c-buy);">Шины</span>
                    </div>
                </div>

                <div class="mk-timeline__item">
                    <div class="mk-timeline__marker" style="background: var(--mk-c-service);"></div>
                    <div class="mk-timeline__date">20.01.2025 · 51 300 км</div>
                    <div class="mk-timeline__title">Автосервис «Техно»</div>
                    <div class="mk-timeline__desc">Замена моторного масла и масляного фильтра, диагностика</div>
                    <div class="mk-timeline__meta">
                        <span>7 800 ₽</span>
                        <span class="mk-timeline__tag" style="background: var(--mk-c-service-soft); color: var(--mk-c-service);">ТО</span>
                    </div>
                </div>

                <div class="mk-timeline__item">
                    <div class="mk-timeline__marker" style="background: var(--mk-c-repair);"></div>
                    <div class="mk-timeline__date">12.09.2024 · 44 900 км</div>
                    <div class="mk-timeline__title">СТО «АвтоСпас»</div>
                    <div class="mk-timeline__desc">Замена передних тормозных дисков, проверка суппортов</div>
                    <div class="mk-timeline__meta">
                        <span>22 000 ₽</span>
                        <span class="mk-timeline__tag" style="background: var(--mk-c-repair-soft); color: var(--mk-c-repair);">Ремонт</span>
                    </div>
                </div>

                <div class="mk-timeline__item">
                    <div class="mk-timeline__marker" style="background: var(--mk-c-repair);"></div>
                    <div class="mk-timeline__date">08.06.2024 · 39 200 км</div>
                    <div class="mk-timeline__title">Гараж «У Алексея»</div>
                    <div class="mk-timeline__desc">Замена ремня ГРМ, роликов и натяжителя</div>
                    <div class="mk-timeline__meta">
                        <span>14 500 ₽</span>
                        <span class="mk-timeline__tag" style="background: var(--mk-c-repair-soft); color: var(--mk-c-repair);">Ремонт</span>
                    </div>
                </div>

                <div class="mk-timeline__item">
                    <div class="mk-timeline__marker" style="background: var(--mk-c-service);"></div>
                    <div class="mk-timeline__date">25.02.2024 · 33 800 км</div>
                    <div class="mk-timeline__title">Автосервис «Техно»</div>
                    <div class="mk-timeline__desc">Плановое ТО-2: масло, фильтры, диагностика</div>
                    <div class="mk-timeline__meta">
                        <span>12 900 ₽</span>
                        <span class="mk-timeline__tag" style="background: var(--mk-c-service-soft); color: var(--mk-c-service);">ТО</span>
                    </div>
                </div>

                <div class="mk-timeline__item">
                    <div class="mk-timeline__marker" style="background: var(--mk-c-repair);"></div>
                    <div class="mk-timeline__date">10.09.2023 · 22 400 км</div>
                    <div class="mk-timeline__title">СТО «АвтоСпас»</div>
                    <div class="mk-timeline__desc">Замена рулевых тяг и наконечников</div>
                    <div class="mk-timeline__meta">
                        <span>8 700 ₽</span>
                        <span class="mk-timeline__tag" style="background: var(--mk-c-repair-soft); color: var(--mk-c-repair);">Ремонт</span>
                    </div>
                </div>

                <div class="mk-timeline__item">
                    <div class="mk-timeline__marker" style="background: var(--mk-c-buy);"></div>
                    <div class="mk-timeline__date">20.05.2023 · 18 100 км</div>
                    <div class="mk-timeline__title">Шинный центр «Колесо»</div>
                    <div class="mk-timeline__desc">Сезонная замена резины, балансировка</div>
                    <div class="mk-timeline__meta">
                        <span>3 200 ₽</span>
                        <span class="mk-timeline__tag" style="background: var(--mk-c-buy-soft); color: var(--mk-c-buy);">Шины</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ПРОБЕГ ПО ГОДАМ -->
        <section class="mk-report-section" aria-label="Пробег по годам">
            <div class="mk-section-head">
                <h2 class="mk-section-head__title">Пробег по годам</h2>
                <div class="mk-section-head__spacer"></div>
                <span class="mk-report-badge-info">Среднегодовой — 9 370 км</span>
            </div>
            <div class="mk-report-table-wrap">
                <table class="mk-report-table">
                    <thead>
                    <tr>
                        <th>Год</th>
                        <th class="num">Пробег за год</th>
                        <th class="num">Накопительно</th>
                        <th class="num">Записей</th>
                        <th class="num">Расходы</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>2022 (с марта)</td>
                        <td class="num">7 200 км</td>
                        <td class="num">44 240 км</td>
                        <td class="num">8</td>
                        <td class="num">44 400 ₽</td>
                    </tr>
                    <tr>
                        <td>2023</td>
                        <td class="num">11 800 км</td>
                        <td class="num">56 040 км</td>
                        <td class="num">14</td>
                        <td class="num">72 300 ₽</td>
                    </tr>
                    <tr>
                        <td>2024</td>
                        <td class="num">10 200 км</td>
                        <td class="num">66 240 км</td>
                        <td class="num">12</td>
                        <td class="num">58 100 ₽</td>
                    </tr>
                    <tr>
                        <td>2025</td>
                        <td class="num">9 400 км</td>
                        <td class="num">75 640 км</td>
                        <td class="num">11</td>
                        <td class="num">54 600 ₽</td>
                    </tr>
                    <tr>
                        <td>2026 (по сентябрь)</td>
                        <td class="num">10 780 км</td>
                        <td class="num">86 420 км</td>
                        <td class="num">12</td>
                        <td class="num">45 500 ₽</td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td><strong>Итого</strong></td>
                        <td class="num"><strong>49 380 км</strong></td>
                        <td class="num"><strong>86 420 км</strong></td>
                        <td class="num"><strong>57</strong></td>
                        <td class="num"><strong>274 900 ₽</strong></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </section>

        <!-- ДОКУМЕНТЫ -->
        <section class="mk-report-section" aria-label="Документы">
            <div class="mk-section-head">
                <h2 class="mk-section-head__title">Документы</h2>
                <div class="mk-section-head__spacer"></div>
                <span class="mk-report-badge-info">6 документов</span>
            </div>
            <div class="mk-report-docs">
                <div class="mk-doc-card">
                    <div class="mk-doc-card__icon"><svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-success)" stroke-width="2"><rect x="2" y="3" width="20" height="18" rx="2"/><line x1="8" y1="9" x2="16" y2="9"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="12" y2="17"/></svg></div>
                    <div class="mk-doc-card__body">
                        <div class="mk-doc-card__title">ОСАГО</div>
                        <div class="mk-doc-card__meta">Страховка · до 01.10.2026</div>
                        <span class="mk-doc-card__status ok">Действует</span>
                    </div>
                </div>
                <div class="mk-doc-card">
                    <div class="mk-doc-card__icon"><svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-success)" stroke-width="2"><rect x="2" y="3" width="20" height="18" rx="2"/><line x1="8" y1="9" x2="16" y2="9"/><line x1="8" y1="13" x2="16" y2="13"/></svg></div>
                    <div class="mk-doc-card__body">
                        <div class="mk-doc-card__title">КАСКО</div>
                        <div class="mk-doc-card__meta">Страховка · до 01.10.2026</div>
                        <span class="mk-doc-card__status ok">Действует</span>
                    </div>
                </div>
                <div class="mk-doc-card">
                    <div class="mk-doc-card__icon"><svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-warning)" stroke-width="2"><rect x="2" y="3" width="20" height="18" rx="2"/><path d="M8 7h8M8 11h6M8 15h4"/></svg></div>
                    <div class="mk-doc-card__body">
                        <div class="mk-doc-card__title">СТС</div>
                        <div class="mk-doc-card__meta">СТС · до 15.08.2026</div>
                        <span class="mk-doc-card__status warning">Истекает</span>
                    </div>
                </div>
                <div class="mk-doc-card">
                    <div class="mk-doc-card__icon"><svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-success)" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></div>
                    <div class="mk-doc-card__body">
                        <div class="mk-doc-card__title">Диагностическая карта</div>
                        <div class="mk-doc-card__meta">Диагностика · до 20.12.2026</div>
                        <span class="mk-doc-card__status ok">Действует</span>
                    </div>
                </div>
                <div class="mk-doc-card">
                    <div class="mk-doc-card__icon"><svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-success)" stroke-width="2"><rect x="2" y="3" width="20" height="18" rx="2"/><path d="M8 7h8M8 11h6"/></svg></div>
                    <div class="mk-doc-card__body">
                        <div class="mk-doc-card__title">ПТС</div>
                        <div class="mk-doc-card__meta">ПТС · выдан 2019</div>
                        <span class="mk-doc-card__status ok">Действует</span>
                    </div>
                </div>
                <div class="mk-doc-card">
                    <div class="mk-doc-card__icon"><svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-success)" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
                    <div class="mk-doc-card__body">
                        <div class="mk-doc-card__title">Договор купли-продажи</div>
                        <div class="mk-doc-card__meta">ДКП · от 12.03.2022</div>
                        <span class="mk-doc-card__status ok">Действует</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- НАПОМИНАНИЯ -->
        <section class="mk-report-section" aria-label="Напоминания">
            <div class="mk-section-head">
                <h2 class="mk-section-head__title">Напоминания и регламент</h2>
            </div>
            <div class="mk-report-reminders">
                <div class="mk-report-reminder">
                    <div class="mk-report-reminder__icon" style="--ic-bg: var(--mk-c-service-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-service)" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="mk-report-reminder__body">
                        <div class="mk-report-reminder__title">Замена масла и фильтров</div>
                        <div class="mk-report-reminder__meta">Каждые 10 000 км · следующее через 1 580 км</div>
                    </div>
                    <span class="mk-report-reminder__badge" style="background:var(--mk-c-service-soft);color:var(--mk-c-service);">ТО</span>
                </div>
                <div class="mk-report-reminder">
                    <div class="mk-report-reminder__icon" style="--ic-bg: var(--mk-c-fuel-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-fuel)" stroke-width="2"><path d="M3 22h12"/><path d="M18 2l-3 3"/><path d="M10 10l3-3"/><path d="M6 14l3-3"/><path d="M13 6l3-3"/><path d="M6 22h12"/><path d="M9 7l3-3"/></svg>
                    </div>
                    <div class="mk-report-reminder__body">
                        <div class="mk-report-reminder__title">Проверка давления в шинах</div>
                        <div class="mk-report-reminder__meta">Ежемесячно · 2.2 бар</div>
                    </div>
                    <span class="mk-report-reminder__badge" style="background:var(--mk-c-fuel-soft);color:var(--mk-c-fuel);">Периодич.</span>
                </div>
                <div class="mk-report-reminder">
                    <div class="mk-report-reminder__icon" style="--ic-bg: var(--mk-c-service-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-service)" stroke-width="2"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
                    </div>
                    <div class="mk-report-reminder__body">
                        <div class="mk-report-reminder__title">Проверка уровня масла</div>
                        <div class="mk-report-reminder__meta">Еженедельно · между MIN и MAX</div>
                    </div>
                    <span class="mk-report-reminder__badge" style="background:var(--mk-c-service-soft);color:var(--mk-c-service);">Периодич.</span>
                </div>
                <div class="mk-report-reminder">
                    <div class="mk-report-reminder__icon" style="--ic-bg: var(--mk-c-service-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-service)" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="mk-report-reminder__body">
                        <div class="mk-report-reminder__title">Проверка уровня антифриза</div>
                        <div class="mk-report-reminder__meta">Каждые 3 месяца · перед сезоном</div>
                    </div>
                    <span class="mk-report-reminder__badge" style="background:var(--mk-c-service-soft);color:var(--mk-c-service);">Периодич.</span>
                </div>
                <div class="mk-report-reminder">
                    <div class="mk-report-reminder__icon" style="--ic-bg: var(--mk-c-repair-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-repair)" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                    <div class="mk-report-reminder__body">
                        <div class="mk-report-reminder__title">Замена ремня ГРМ</div>
                        <div class="mk-report-reminder__meta">Каждые 60 000 км · следующая на 120 000 км</div>
                    </div>
                    <span class="mk-report-reminder__badge" style="background:var(--mk-c-repair-soft);color:var(--mk-c-repair);">Важное</span>
                </div>
                <div class="mk-report-reminder">
                    <div class="mk-report-reminder__icon" style="--ic-bg: var(--mk-c-buy-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-buy)" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="mk-report-reminder__body">
                        <div class="mk-report-reminder__title">Замена воздушного фильтра</div>
                        <div class="mk-report-reminder__meta">Каждые 20 000 км · следующая на 100 000 км</div>
                    </div>
                    <span class="mk-report-reminder__badge" style="background:var(--mk-c-buy-soft);color:var(--mk-c-buy);">Расходник</span>
                </div>
                <div class="mk-report-reminder">
                    <div class="mk-report-reminder__icon" style="--ic-bg: var(--mk-c-note-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-note)" stroke-width="2"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
                    </div>
                    <div class="mk-report-reminder__body">
                        <div class="mk-report-reminder__title">Замена резины (сезонная)</div>
                        <div class="mk-report-reminder__meta">2 раза в год · октябрь / апрель</div>
                    </div>
                    <span class="mk-report-reminder__badge" style="background:var(--mk-c-note-soft);color:var(--mk-c-note);">Сезон</span>
                </div>
            </div>
        </section>

        <!-- ИСТОРИЯ -->
        <section class="mk-report-section" aria-label="Полная история">
            <div class="mk-section-head">
                <h2 class="mk-section-head__title">Полная история <span class="count">10</span></h2>
                <div class="mk-section-head__spacer"></div>
                <button class="mk-btn mk-btn--ghost mk-btn--sm mk-no-print" id="toggleHistory">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    <span id="toggleHistoryLabel">Свернуть</span>
                </button>
            </div>

            <div class="mk-chips" role="tablist" aria-label="Фильтр записей">
                <button class="mk-chip active" data-filter="all">Все</button>
                <button class="mk-chip" data-filter="service"><span class="dot" style="background:var(--mk-c-service);"></span> ТО</button>
                <button class="mk-chip" data-filter="repair"><span class="dot" style="background:var(--mk-c-repair);"></span> Поломки</button>
                <button class="mk-chip" data-filter="buy"><span class="dot" style="background:var(--mk-c-buy);"></span> Покупки</button>
                <button class="mk-chip" data-filter="note"><span class="dot" style="background:var(--mk-c-note);"></span> Заметки</button>
            </div>

            <div class="mk-feed" id="historyFeed">

                <article class="mk-record" data-type="service" style="--rail: var(--mk-c-service);">
                    <div class="mk-record__ic" style="--ic-bg: var(--mk-c-service-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-service)" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    </div>
                    <div class="mk-record__main">
                        <div class="mk-record__title">Замена масла и фильтров <span class="mk-tag" style="--tag-bg: var(--mk-c-service-soft); --tag-color: var(--mk-c-service);">ТО</span></div>
                        <div class="mk-record__desc">Моторное масло 5W-30, масляный фильтр, воздушный фильтр, салонный фильтр</div>
                        <div class="mk-record__metaline">
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> 82 400 км</span></span>
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> Автосервис «Техно»</span></span>
                        </div>
                    </div>
                    <div class="mk-record__side">
                        <span class="mk-record__cost">8 200 ₽</span>
                        <span class="mk-record__date">12 июня 2026</span>
                    </div>
                </article>

                <article class="mk-record" data-type="repair" style="--rail: var(--mk-c-repair);">
                    <div class="mk-record__ic" style="--ic-bg: var(--mk-c-repair-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-repair)" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
                    </div>
                    <div class="mk-record__main">
                        <div class="mk-record__title">Замена тормозных колодок <span class="mk-tag" style="--tag-bg: var(--mk-c-repair-soft); --tag-color: var(--mk-c-repair);">Поломка</span></div>
                        <div class="mk-record__desc">Передние и задние колодки, датчики износа</div>
                        <div class="mk-record__metaline">
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> 80 100 км</span></span>
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> СТО «АвтоСпас»</span></span>
                        </div>
                    </div>
                    <div class="mk-record__side">
                        <span class="mk-record__cost">5 600 ₽</span>
                        <span class="mk-record__date">2 июня 2026</span>
                    </div>
                </article>

                <article class="mk-record" data-type="buy" style="--rail: var(--mk-c-buy);">
                    <div class="mk-record__ic" style="--ic-bg: var(--mk-c-buy-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-buy)" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="mk-record__main">
                        <div class="mk-record__title">Комплект летней резины <span class="mk-tag" style="--tag-bg: var(--mk-c-buy-soft); --tag-color: var(--mk-c-buy);">Покупка</span></div>
                        <div class="mk-record__desc">Michelin Pilot Sport 4, 225/45 R17</div>
                        <div class="mk-record__metaline">
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> 79 000 км</span></span>
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> Шинный центр</span></span>
                        </div>
                    </div>
                    <div class="mk-record__side">
                        <span class="mk-record__cost">32 000 ₽</span>
                        <span class="mk-record__date">20 мая 2026</span>
                    </div>
                </article>

                <article class="mk-record" data-type="note" style="--rail: var(--mk-c-note);">
                    <div class="mk-record__ic" style="--ic-bg: var(--mk-c-note-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-note)" stroke-width="2"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
                    </div>
                    <div class="mk-record__main">
                        <div class="mk-record__title">Заметка: планирую продажу <span class="mk-tag" style="--tag-bg: var(--mk-c-note-soft); --tag-color: var(--mk-c-note);">Заметка</span></div>
                        <div class="mk-record__desc">Осмотреть подвеску, заменить передние стойки перед продажей</div>
                        <div class="mk-record__metaline">
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> 85 000 км</span></span>
                        </div>
                    </div>
                    <div class="mk-record__side">
                        <span class="mk-record__cost"></span>
                        <span class="mk-record__date">14 мая 2026</span>
                    </div>
                </article>

                <article class="mk-record" data-type="service" style="--rail: var(--mk-c-service);">
                    <div class="mk-record__ic" style="--ic-bg: var(--mk-c-service-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-service)" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    </div>
                    <div class="mk-record__main">
                        <div class="mk-record__title">Замена свечей зажигания <span class="mk-tag" style="--tag-bg: var(--mk-c-service-soft); --tag-color: var(--mk-c-service);">ТО</span></div>
                        <div class="mk-record__desc">Комплект свечей NGK, проверка катушек</div>
                        <div class="mk-record__metaline">
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> 76 200 км</span></span>
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> Автосервис «Техно»</span></span>
                        </div>
                    </div>
                    <div class="mk-record__side">
                        <span class="mk-record__cost">6 800 ₽</span>
                        <span class="mk-record__date">18 марта 2026</span>
                    </div>
                </article>

                <article class="mk-record" data-type="repair" style="--rail: var(--mk-c-repair);">
                    <div class="mk-record__ic" style="--ic-bg: var(--mk-c-repair-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-repair)" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
                    </div>
                    <div class="mk-record__main">
                        <div class="mk-record__title">Замена передних стоек стабилизатора <span class="mk-tag" style="--tag-bg: var(--mk-c-repair-soft); --tag-color: var(--mk-c-repair);">Поломка</span></div>
                        <div class="mk-record__desc">Стойки стабилизатора, втулки</div>
                        <div class="mk-record__metaline">
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> 71 500 км</span></span>
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> СТО «АвтоСпас»</span></span>
                        </div>
                    </div>
                    <div class="mk-record__side">
                        <span class="mk-record__cost">9 400 ₽</span>
                        <span class="mk-record__date">5 февраля 2026</span>
                    </div>
                </article>

                <article class="mk-record" data-type="buy" style="--rail: var(--mk-c-buy);">
                    <div class="mk-record__ic" style="--ic-bg: var(--mk-c-buy-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-buy)" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="mk-record__main">
                        <div class="mk-record__title">Комплект зимней резины <span class="mk-tag" style="--tag-bg: var(--mk-c-buy-soft); --tag-color: var(--mk-c-buy);">Покупка</span></div>
                        <div class="mk-record__desc">Nokian Hakkapeliitta 10, 225/45 R17</div>
                        <div class="mk-record__metaline">
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> 66 200 км</span></span>
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> Шинный центр</span></span>
                        </div>
                    </div>
                    <div class="mk-record__side">
                        <span class="mk-record__cost">42 800 ₽</span>
                        <span class="mk-record__date">14 октября 2025</span>
                    </div>
                </article>

                <article class="mk-record" data-type="service" style="--rail: var(--mk-c-service);">
                    <div class="mk-record__ic" style="--ic-bg: var(--mk-c-service-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-service)" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    </div>
                    <div class="mk-record__main">
                        <div class="mk-record__title">Плановое ТО-3 <span class="mk-tag" style="--tag-bg: var(--mk-c-service-soft); --tag-color: var(--mk-c-service);">ТО</span></div>
                        <div class="mk-record__desc">Замена масла, всех фильтров, проверка жидкостей</div>
                        <div class="mk-record__metaline">
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> 62 400 км</span></span>
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> Официальный дилер «BMW Автодом»</span></span>
                        </div>
                    </div>
                    <div class="mk-record__side">
                        <span class="mk-record__cost">18 400 ₽</span>
                        <span class="mk-record__date">5 августа 2025</span>
                    </div>
                </article>

                <article class="mk-record" data-type="repair" style="--rail: var(--mk-c-repair);">
                    <div class="mk-record__ic" style="--ic-bg: var(--mk-c-repair-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-repair)" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
                    </div>
                    <div class="mk-record__main">
                        <div class="mk-record__title">Ремонт кондиционера <span class="mk-tag" style="--tag-bg: var(--mk-c-repair-soft); --tag-color: var(--mk-c-repair);">Поломка</span></div>
                        <div class="mk-record__desc">Заправка фреоном, замена салонного фильтра</div>
                        <div class="mk-record__metaline">
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> 58 900 км</span></span>
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> Гараж «У Алексея»</span></span>
                        </div>
                    </div>
                    <div class="mk-record__side">
                        <span class="mk-record__cost">4 800 ₽</span>
                        <span class="mk-record__date">22 июня 2025</span>
                    </div>
                </article>

                <article class="mk-record" data-type="note" style="--rail: var(--mk-c-note);">
                    <div class="mk-record__ic" style="--ic-bg: var(--mk-c-note-soft);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-note)" stroke-width="2"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
                    </div>
                    <div class="mk-record__main">
                        <div class="mk-record__title">Заметка: ТО у дилера <span class="mk-tag" style="--tag-bg: var(--mk-c-note-soft); --tag-color: var(--mk-c-note);">Заметка</span></div>
                        <div class="mk-record__desc">Уточнить у дилера по гарантии на ЛКП — есть подозрение на отслоение</div>
                        <div class="mk-record__metaline">
                            <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> 55 000 км</span></span>
                        </div>
                    </div>
                    <div class="mk-record__side">
                        <span class="mk-record__cost"></span>
                        <span class="mk-record__date">3 марта 2025</span>
                    </div>
                </article>

            </div>

            <div class="mk-report-more mk-no-print">
                <button class="mk-btn mk-btn--ghost" id="loadMore">Показать ещё 24 записи</button>
            </div>
        </section>

        <!-- ВЛАДЕЛЕЦ -->
        <section class="mk-report-section" aria-label="Информация о владельце">
            <div class="mk-section-head">
                <h2 class="mk-section-head__title">Владелец и гараж</h2>
            </div>
            <div class="mk-report-owner">
                <div class="mk-report-owner__avatar">А</div>
                <div class="mk-report-owner__info">
                    <div class="mk-report-owner__name">Алексей Морозов</div>
                    <div class="mk-report-owner__meta">Владелец с 12 марта 2022 · г. Москва</div>
                    <div class="mk-report-owner__meta">Всего в гараже: 3 автомобиля · 128 записей · 1 240 500 ₽ расходов</div>
                </div>
                <div class="mk-report-owner__contact">
                    <div class="mk-report-owner__contact-label">Контакт</div>
                    <div class="mk-report-owner__contact-value mk-mono">a.morozov@example.com</div>
                </div>
            </div>
        </section>

        <!-- ПОДПИСЬ -->
        <div class="mk-report-sign">
            <div class="mk-report-sign__text">
                Отчёт сформирован автоматически сервисом MOTORKEEP. Данные основаны на записях пользователя и не являются юридическим документом.
            </div>
            <div class="mk-report-sign__hash mk-mono">ID: MK-320I-2026-09-16-A7F3</div>
        </div>

    </div>
</main>

<!-- ФУТЕР -->
<footer class="mk-footer">
    <div class="mk-footer__inner">
        <div class="mk-footer__brand">
            <a href="#" class="mk-logo mk-logo--small" aria-label="MOTORKEEP">
                <span class="mk-logo__mark"><i class="bi bi-car-front-fill"></i></span>
                <span class="mk-logo__text">MOTOR<span>KEEP</span></span>
            </a>
            <span class="mk-footer__copy">© 2026</span>
        </div>
        <div class="mk-footer__links">
            <a href="#">Помощь</a>
            <a href="#">Конфиденциальность</a>
            <a href="#">Контакты</a>
        </div>
    </div>
</footer>

<!-- МОДАЛКА "ПОДЕЛИТЬСЯ" -->
<div class="mk-modal-overlay" id="mkShareModalOverlay" role="dialog" aria-modal="true" aria-labelledby="mkShareTitle">
    <div class="mk-modal mk-modal--share" id="mkShareModal">
        <div class="mk-modal__header">
            <h2 id="mkShareTitle">Поделиться отчётом</h2>
            <button class="mk-modal__close" id="mkShareClose" aria-label="Закрыть">✕</button>
        </div>
        <div class="mk-modal__form">
            <div class="mk-form-group">
                <label class="mk-form-label" for="shareLink">Ссылка на отчёт</label>
                <div class="mk-share-link">
                    <input class="mk-input mk-input--mono" id="shareLink" type="text" readonly value="https://motorkeep.app/r/320i-2026-09-16-a7f3" aria-label="Ссылка на отчёт">
                    <button class="mk-btn mk-btn--primary mk-btn--sm" id="shareCopyBtn" type="button">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                        <span>Копировать</span>
                    </button>
                </div>
                <div class="mk-form-hint">Ссылка действует бессрочно. Можно отозвать в любой момент.</div>
            </div>
            <div class="mk-form-group">
                <label class="mk-form-label">Отправить в</label>
                <div class="mk-share-grid">
                    <a class="mk-share-tile" id="shareTelegram" href="#" target="_blank" rel="noopener">
              <span class="mk-share-tile__ic" style="background:#E7F1FF;color:#229ED9;">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21.9 4.6 18.6 19.2c-.2 1.1-.9 1.4-1.8.9l-5-3.7-2.4 2.3c-.3.3-.5.5-1 .5l.3-4.9 8.9-8c.4-.3-.1-.5-.6-.2L6.1 13.1.9 11.5c-1.1-.3-1.1-1.1.2-1.6L20.4 3c.9-.3 1.7.2 1.5 1.6z"/></svg>
              </span>
                        <span class="mk-share-tile__label">Telegram</span>
                    </a>
                    <a class="mk-share-tile" id="shareWhatsapp" href="#" target="_blank" rel="noopener">
              <span class="mk-share-tile__ic" style="background:#E4F8EE;color:#25D366;">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.5 3.5A11 11 0 0 0 3.6 17.4L2 22l4.7-1.6A11 11 0 1 0 20.5 3.5zM12 20.3a8.2 8.2 0 0 1-4.2-1.1l-.3-.2-2.8 1 .9-2.7-.2-.3a8.3 8.3 0 1 1 6.6 3.3zm4.6-6.2c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.5.1-.2.2-.6.8-.8 1-.1.1-.3.2-.5 0-.2-.1-1-.4-1.8-1.1a7 7 0 0 1-1.3-1.6c-.1-.2 0-.4.1-.5l.3-.4c.1-.1.2-.3.3-.4.1-.2 0-.3 0-.4l-.7-1.7c-.2-.5-.4-.4-.5-.4h-.5c-.2 0-.4.1-.6.3-.2.2-.8.8-.8 1.9s.8 2.2.9 2.4c.1.2 1.6 2.5 3.9 3.5.5.2 1 .3 1.3.4.6.2 1.1.2 1.5.1.4-.1 1.5-.6 1.7-1.2.2-.6.2-1.1.1-1.2 0-.1-.2-.2-.4-.3z"/></svg>
              </span>
                        <span class="mk-share-tile__label">WhatsApp</span>
                    </a>
                    <a class="mk-share-tile" id="shareEmail" href="#">
              <span class="mk-share-tile__ic" style="background:#FEF2E0;color:#F59412;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><polyline points="3 7 12 13 21 7"/></svg>
              </span>
                        <span class="mk-share-tile__label">Email</span>
                    </a>
                    <button class="mk-share-tile" id="shareNative" type="button">
              <span class="mk-share-tile__ic" style="background:var(--mk-primary-soft);color:var(--mk-primary);">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
              </span>
                        <span class="mk-share-tile__label">Ещё…</span>
                    </button>
                </div>
            </div>
            <div class="mk-form-group">
                <label class="mk-form-label">Доступ по ссылке</label>
                <div class="mk-access" role="radiogroup" aria-label="Уровень доступа">
                    <label class="mk-access__option">
                        <input type="radio" name="shareAccess" value="public" checked>
                        <span class="mk-access__body">
                <span class="mk-access__ic" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15 15 0 0 1 0 20 15 15 0 0 1 0-20z"/></svg></span>
                <span class="mk-access__text">
                  <span class="mk-access__title">Видно по ссылке</span>
                  <span class="mk-access__desc">Любой, у кого есть ссылка, увидит отчёт</span>
                </span>
              </span>
                    </label>
                    <label class="mk-access__option">
                        <input type="radio" name="shareAccess" value="auth">
                        <span class="mk-access__body">
                <span class="mk-access__ic" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="11" width="16" height="10" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/></svg></span>
                <span class="mk-access__text">
                  <span class="mk-access__title">Только по авторизации</span>
                  <span class="mk-access__desc">Откроется после входа в аккаунт MOTORKEEP</span>
                </span>
              </span>
                    </label>
                </div>
            </div>
            <div class="mk-share-revoke">
                <button type="button" class="mk-btn mk-btn--danger-ghost" id="shareRevoke">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                    Отозвать ссылку
                </button>
            </div>
        </div>
        <div class="mk-modal__footer">
            <button type="button" class="mk-btn mk-btn--ghost" id="mkShareCancel">Готово</button>
        </div>
    </div>
</div>

<!-- ТОСТ -->
<div class="mk-toast" id="mkToast" role="status" aria-live="polite">
    <span class="mk-toast__icon">✓</span>
    <span class="mk-toast__message">Скопировано</span>
</div>
</body>
</html>
