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
                <button class="mk-period-btn active">За всё время</button>
                <button class="mk-period-btn">За год</button>
                <button class="mk-period-btn">За месяц</button>
                <button class="mk-period-btn">За неделю</button>
            </div>

            <!-- ===== КЛЮЧЕВЫЕ ПОКАЗАТЕЛИ ===== -->
            <div class="mk-stats-grid" id="key-stats">
                <div class="mk-stat-card">
                    <div class="mk-stat-card__icon" style="--ic-color:var(--mk-primary);--ic-bg:var(--mk-primary-soft);">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <div class="mk-stat-card__content">
                        <span class="mk-stat-card__label">Общие расходы</span>
                        <span class="mk-stat-card__value" id="total-cost">257 700 ₽</span>
                        <span class="mk-stat-card__change up">+12.4%</span>
                    </div>
                </div>

                <div class="mk-stat-card">
                    <div class="mk-stat-card__icon" style="--ic-color:var(--mk-c-fuel);--ic-bg:var(--mk-c-fuel-soft);">
                        <i class="bi bi-fuel-pump"></i>
                    </div>
                    <div class="mk-stat-card__content">
                        <span class="mk-stat-card__label">Расходы на топливо</span>
                        <span class="mk-stat-card__value">89 400 ₽</span>
                        <span class="mk-stat-card__change ok">−2.1%</span>
                    </div>
                </div>

                <div class="mk-stat-card">
                    <div class="mk-stat-card__icon" style="--ic-color:var(--mk-c-service);--ic-bg:var(--mk-c-service-soft);">
                        <i class="bi bi-tools"></i>
                    </div>
                    <div class="mk-stat-card__content">
                        <span class="mk-stat-card__label">ТО и ремонты</span>
                        <span class="mk-stat-card__value">112 300 ₽</span>
                        <span class="mk-stat-card__change up">+5.8%</span>
                    </div>
                </div>

                <div class="mk-stat-card">
                    <div class="mk-stat-card__icon" style="--ic-color:var(--mk-c-buy);--ic-bg:var(--mk-c-buy-soft);">
                        <i class="bi bi-bag"></i>
                    </div>
                    <div class="mk-stat-card__content">
                        <span class="mk-stat-card__label">Покупки</span>
                        <span class="mk-stat-card__value">56 000 ₽</span>
                        <span class="mk-stat-card__change ok">0.0%</span>
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
                        <!-- Бар-чарт будет построен JS -->
                    </div>
                </div>

                <!-- График пробега по месяцам -->
                <div class="mk-chart-card">
                    <div class="mk-chart-card__header">
                        <h3>Пробег по месяцам</h3>
                        <span class="mk-chart-card__sub">км</span>
                    </div>
                    <div class="mk-chart" id="mileage-chart">
                        <!-- Бар-чарт будет построен JS -->
                    </div>
                </div>
            </div>

            <!-- ===== РАСПРЕДЕЛЕНИЕ РАСХОДОВ ===== -->
            <div class="mk-charts-row">
                <div class="mk-chart-card">
                    <div class="mk-chart-card__header">
                        <h3>Распределение расходов по типам</h3>
                    </div>
                    <div class="mk-donut" id="donut-chart">
                        <!-- Donut будет построен JS -->
                    </div>
                    <div class="mk-donut-legend" id="donut-legend">
                        <!-- Легенда будет построена JS -->
                    </div>
                </div>

                <!-- Топ-5 самых дорогих записей -->
                <div class="mk-chart-card">
                    <div class="mk-chart-card__header">
                        <h3>Самые дорогие записи</h3>
                        <span class="mk-chart-card__sub">₽</span>
                    </div>
                    <div class="mk-top-list" id="top-records">
                        <!-- Список будет построен JS -->
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
                <!-- Карточки статистики по авто будут построены JS -->
            </div>

            <!-- ===== ДОПОЛНИТЕЛЬНАЯ ИНФОРМАЦИЯ ===== -->
            <div class="mk-extra-stats">
                <div class="mk-extra-card">
                    <div class="mk-extra-card__icon"><i class="bi bi-calendar-event"></i></div>
                    <div>
                        <span class="mk-extra-card__label">Средний расход на 100 км</span>
                        <span class="mk-extra-card__value">8.4 л</span>
                    </div>
                </div>
                <div class="mk-extra-card">
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
                        <span class="mk-extra-card__value">14 300 ₽</span>
                    </div>
                </div>
                <div class="mk-extra-card">
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
