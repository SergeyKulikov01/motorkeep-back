@include('layouts.public.landing-head')
<body>
<!-- СКРИМ -->
<div class="mk-scrim" id="mkScrim"></div>

<!-- ====== САЙДБАР (без изменений) ====== -->
@include('layouts.private.sidebar')

<!-- ====== ОБОЛОЧКА ====== -->
<div class="mk-shell" id="mkShell">
    <!-- ХЕДЕР (без изменений) -->
    @include('layouts.private.header', ['pageTitle' => 'Мой гараж', 'pageCrumb' => 'Статистика'])
    <!-- ОСНОВНОЙ КОНТЕНТ -->
    <main class="mk-main" role="main">
        <div class="mk-container">

            <!-- Заголовок страницы: без него секции начинались сразу под хедером,
                 без якоря — рядом с полным сайдбаром это смотрелось так, будто
                 контент "слипся" с ним. -->
            <div class="mk-section-head">
                <div>
                    <h2>Статистика</h2>
                    <span class="count">Расходы и пробег по всему автопарку</span>
                </div>
            </div>

            <!-- ===== ПЕРИОД ===== -->
            <div class="mk-period-selector">
                <button class="mk-period-btn active" data-period="all">За всё время</button>
                <button class="mk-period-btn" data-period="year">За год</button>
                <button class="mk-period-btn" data-period="month">За месяц</button>
                <button class="mk-period-btn" data-period="week">За неделю</button>
            </div>

            <!-- ===== КЛЮЧЕВЫЕ ПОКАЗАТЕЛИ ===== -->
            <div class="mk-stats-grid" id="key-stats">
                <div class="mk-stat-card">
                    <div class="mk-stat-card__icon" style="--ic-color:var(--mk-primary);--ic-bg:var(--mk-primary-soft);">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <div class="mk-stat-card__content">
                        <span class="mk-stat-card__label">Общие расходы</span>
                        <span class="mk-stat-card__value" data-spendtype="total"></span>
                        <span class="mk-stat-card__change up" data-changetype="total"></span>
                    </div>
                </div>

                <div class="mk-stat-card">
                    <div class="mk-stat-card__icon" style="--ic-color:var(--mk-c-fuel);--ic-bg:var(--mk-c-fuel-soft);">
                        <i class="bi bi-fuel-pump"></i>
                    </div>
                    <div class="mk-stat-card__content">
                        <span class="mk-stat-card__label">Расходы на топливо</span>
                        <span class="mk-stat-card__value" data-spendtype="fuel"></span>
                        <span class="mk-stat-card__change ok" data-changetype="fuel"></span>
                    </div>
                </div>

                <div class="mk-stat-card">
                    <div class="mk-stat-card__icon" style="--ic-color:var(--mk-c-service);--ic-bg:var(--mk-c-service-soft);">
                        <i class="bi bi-tools"></i>
                    </div>
                    <div class="mk-stat-card__content">
                        <span class="mk-stat-card__label">ТО и ремонты</span>
                        <span class="mk-stat-card__value" data-spendtype="service"></span>
                        <span class="mk-stat-card__change up" data-changetype="service"></span>
                    </div>
                </div>

                <div class="mk-stat-card">
                    <div class="mk-stat-card__icon" style="--ic-color:var(--mk-c-buy);--ic-bg:var(--mk-c-buy-soft);">
                        <i class="bi bi-bag"></i>
                    </div>
                    <div class="mk-stat-card__content">
                        <span class="mk-stat-card__label">Покупки</span>
                        <span class="mk-stat-card__value" data-spendtype="buy"></span>
                        <span class="mk-stat-card__change ok" data-changetype="buy"></span>
                    </div>
                </div>
            </div>

            <!-- ===== ГРАФИКИ (2 колонки) ===== -->
            <div class="mk-charts-row">
                <!-- График расходов по месяцам -->
                <div class="mk-chart-card">
                    <div class="mk-chart-card__header">
                        <h3>Расходы по месяцам</h3>
                        <span class="mk-chart-card__sub">₽</span>
                    </div>
                    <div class="mk-chart" id="cost-chart">
                        @php
                            $monthLabels = ['', 'Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'];
                            $maxMonthSpend = !empty($history) ? max($history) : 0;
                        @endphp
                        @for ($month = 1; $month <= 12; $month++)
                            @php
                                $monthSpend = $history[$month] ?? 0;
                                $barHeight = $maxMonthSpend > 0 ? round($monthSpend / $maxMonthSpend * 100, 2) : 0;
                            @endphp
                            <div class="mk-bar" style="height:{{ $barHeight }}%;background:var(--mk-c-service)">
                                <span class="mk-bar__value">{{ number_format($monthSpend, 0, ',', ' ') }} ₽</span>
                                <span class="mk-bar__label">{{ $monthLabels[$month] }}</span>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- График пробега по месяцам -->
                <div class="mk-chart-card mk-wip">
                    <div class="mk-chart-card__header">
                        <h3>Пробег по месяцам</h3>
                        <span class="mk-chart-card__sub">км</span>
                    </div>
                    <div class="mk-chart" id="mileage-chart">
                        <div class="mk-bar" style="height:47.48%;background:var(--mk-c-fuel)">
                            <span class="mk-bar__value">980 км</span>
                            <span class="mk-bar__label">Янв</span>
                        </div>
                        <div class="mk-bar" style="height:53.29%;background:var(--mk-c-fuel)">
                            <span class="mk-bar__value">1 100 км</span>
                            <span class="mk-bar__label">Фев</span>
                        </div>
                        <div class="mk-bar" style="height:58.14%;background:var(--mk-c-fuel)">
                            <span class="mk-bar__value">1 200 км</span>
                            <span class="mk-bar__label">Мар</span>
                        </div>
                        <div class="mk-bar" style="height:65.41%;background:var(--mk-c-fuel)">
                            <span class="mk-bar__value">1 350 км</span>
                            <span class="mk-bar__label">Апр</span>
                        </div>
                        <div class="mk-bar" style="height:68.80%;background:var(--mk-c-fuel)">
                            <span class="mk-bar__value">1 420 км</span>
                            <span class="mk-bar__label">Май</span>
                        </div>
                        <div class="mk-bar" style="height:76.55%;background:var(--mk-c-fuel)">
                            <span class="mk-bar__value">1 580 км</span>
                            <span class="mk-bar__label">Июн</span>
                        </div>
                        <div class="mk-bar" style="height:83.33%;background:var(--mk-c-fuel)">
                            <span class="mk-bar__value">1 720 км</span>
                            <span class="mk-bar__label">Июл</span>
                        </div>
                        <div class="mk-bar" style="height:79.94%;background:var(--mk-c-fuel)">
                            <span class="mk-bar__value">1 650 км</span>
                            <span class="mk-bar__label">Авг</span>
                        </div>
                        <div class="mk-bar" style="height:71.69%;background:var(--mk-c-fuel)">
                            <span class="mk-bar__value">1 480 км</span>
                            <span class="mk-bar__label">Сен</span>
                        </div>
                        <div class="mk-bar" style="height:62.98%;background:var(--mk-c-fuel)">
                            <span class="mk-bar__value">1 300 км</span>
                            <span class="mk-bar__label">Окт</span>
                        </div>
                        <div class="mk-bar" style="height:55.72%;background:var(--mk-c-fuel)">
                            <span class="mk-bar__value">1 150 км</span>
                            <span class="mk-bar__label">Ноя</span>
                        </div>
                        <div class="mk-bar" style="height:41.67%;background:var(--mk-c-fuel)">
                            <span class="mk-bar__value">860 км</span>
                            <span class="mk-bar__label">Дек</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== РАСПРЕДЕЛЕНИЕ РАСХОДОВ ===== -->
            <div class="mk-charts-row">
                <div class="mk-chart-card mk-wip">
                    <div class="mk-chart-card__header">
                        <h3>Распределение расходов по типам</h3>
                    </div>
                    <div class="mk-donut" id="donut-chart">
                        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="100" cy="100" r="70" fill="none" stroke="#F1F5FB" stroke-width="28" />
                            <circle cx="100" cy="100" r="70" fill="none" stroke="var(--mk-c-service)" stroke-width="28"
                                    stroke-dasharray="153.94 439.82" stroke-dashoffset="0"
                                    transform="rotate(0 100 100)" />
                            <circle cx="100" cy="100" r="70" fill="none" stroke="var(--mk-c-repair)" stroke-width="28"
                                    stroke-dasharray="109.96 439.82" stroke-dashoffset="0"
                                    transform="rotate(126 100 100)" />
                            <circle cx="100" cy="100" r="70" fill="none" stroke="var(--mk-c-fuel)" stroke-width="28"
                                    stroke-dasharray="96.76 439.82" stroke-dashoffset="0"
                                    transform="rotate(216 100 100)" />
                            <circle cx="100" cy="100" r="70" fill="none" stroke="var(--mk-c-buy)" stroke-width="28"
                                    stroke-dasharray="52.78 439.82" stroke-dashoffset="0"
                                    transform="rotate(295.2 100 100)" />
                            <circle cx="100" cy="100" r="70" fill="none" stroke="var(--mk-c-note)" stroke-width="28"
                                    stroke-dasharray="26.39 439.82" stroke-dashoffset="0"
                                    transform="rotate(338.4 100 100)" />
                        </svg>
                    </div>
                    <div class="mk-donut-legend" id="donut-legend">
                        <span class="mk-donut-legend-item">
                            <span class="dot" style="background:var(--mk-c-service)"></span>
                            ТО (35%)
                        </span>
                        <span class="mk-donut-legend-item">
                            <span class="dot" style="background:var(--mk-c-repair)"></span>
                            Ремонты (25%)
                        </span>
                        <span class="mk-donut-legend-item">
                            <span class="dot" style="background:var(--mk-c-fuel)"></span>
                            Заправки (22%)
                        </span>
                        <span class="mk-donut-legend-item">
                            <span class="dot" style="background:var(--mk-c-buy)"></span>
                            Покупки (12%)
                        </span>
                        <span class="mk-donut-legend-item">
                            <span class="dot" style="background:var(--mk-c-note)"></span>
                            Прочее (6%)
                        </span>
                    </div>
                </div>

                <!-- Топ-5 самых дорогих записей -->
                <div class="mk-chart-card">
                    <div class="mk-chart-card__header">
                        <h3>Самые дорогие записи</h3>
                        <span class="mk-chart-card__sub">₽</span>
                    </div>
                    <div class="mk-top-list" id="top-records">
                        @foreach($historyList as $item)
                            <div class="mk-top-item">
                                <div class="mk-top-item__info">
                                <span class="mk-top-item__tag" style="background:var({{ $item->labelColor }}-soft);color:var({{ $item->labelColor }})">
                                    {{ $item->readableType }}
                                </span>
                                    <span class="mk-top-item__name">{{ $item->name }}</span>
                                </div>
                                <span class="mk-top-item__cost">{{ number_format($item->price, 0, ',', ' ') }} ₽</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- ===== СТАТИСТИКА ПО АВТОМОБИЛЯМ ===== -->
            <div class="mk-section-head" style="margin-top:32px;">
                <div>
                    <h2>Статистика по автомобилям</h2>
                    <span class="count">Детальная аналитика</span>
                </div>
            </div>
            <div class="mk-car-stats" id="car-stats">
                @foreach($cars as $car)
                    <div class="mk-car-stat-card">
                        <div class="mk-car-stat-card__header">
                            <span class="mk-car-stat-card__name">{{ $car->brand->name }} {{ $car->model->name }}</span>
                            <span class="mk-car-stat-card__plate">{{ $car->plate_number . $car->plate_region}}</span>
                        </div>
                        <div class="mk-car-stat-card__stats">
                            <div class="mk-car-stat-card__stat">
                                <div class="mk-car-stat-card__stat-value">{{$car->mileage_formatted}}</div>
                                <div class="mk-car-stat-card__stat-label">км</div>
                            </div>
                            <div class="mk-car-stat-card__stat">
                                <div class="mk-car-stat-card__stat-value">{{ number_format($car->totalSpend, 0, ',', ' ') }} ₽</div>
                                <div class="mk-car-stat-card__stat-label">расходы</div>
                            </div>
                            <div class="mk-car-stat-card__stat">
                                <div class="mk-car-stat-card__stat-value">{{{count($car->history)}}}</div>
                                <div class="mk-car-stat-card__stat-label">записей</div>
                            </div>
                            <div class="mk-car-stat-card__stat mk-wip" style="grid-column: span 3; border-top: 1px solid var(--mk-border); padding-top: 8px;">
                                <div class="mk-car-stat-card__stat-value" style="font-size:16px;font-weight:500;color:var(--mk-ink-2);">
                                    8.2 л / 100 км
                                </div>
                                <div class="mk-car-stat-card__stat-label">средний расход</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- ===== ДОПОЛНИТЕЛЬНАЯ ИНФОРМАЦИЯ ===== -->
            <div class="mk-extra-stats">
                <div class="mk-extra-card mk-wip">
                    <div class="mk-extra-card__icon"><i class="bi bi-calendar-event"></i></div>
                    <div>
                        <span class="mk-extra-card__label">Средний расход на 100 км</span>
                        <span class="mk-extra-card__value">8.4 л</span>
                    </div>
                </div>
                <div class="mk-extra-card mk-wip">
                    <div class="mk-extra-card__icon"><i class="bi bi-clock-history"></i></div>
                    <div>
                        <span class="mk-extra-card__label">Средний пробег в месяц</span>
                        <span class="mk-extra-card__value">1 240 км</span>
                    </div>
                </div>
                <div class="mk-extra-card">
                    <div class="mk-extra-card__icon"><i class="bi bi-piggy-bank"></i></div>
                    <div>
                        <span class="mk-extra-card__label">Средние расходы в месяц</span>
                        <span class="mk-extra-card__value">{{ number_format($averageSpend, 0, ',', ' ') }} ₽</span>
                    </div>
                </div>
                <div class="mk-extra-card mk-wip">
                    <div class="mk-extra-card__icon"><i class="bi bi-clock"></i></div>
                    <div>
                        <span class="mk-extra-card__label">Следующее ТО через</span>
                        <span class="mk-extra-card__value">2 400 км</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- ФУТЕР -->
    @include('layouts.private.footer')
</div>
</body>
</html>
