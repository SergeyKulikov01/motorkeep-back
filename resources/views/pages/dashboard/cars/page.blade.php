@include('layouts.public.landing-head')
<body>
<!-- СКРИМ -->
<div class="mk-scrim" id="mkScrim"></div>

<!-- ====== САЙДБАР (без изменений) ====== -->
@include('layouts.private.sidebar')

<!-- ====== ОБОЛОЧКА ====== -->
<div class="mk-shell" id="mkShell">
    <!-- ХЕДЕР (без изменений) -->
    @include('layouts.private.header', ['pageTitle' => 'Мой гараж', 'pageCrumb' => 'Все автомобили'])
    <!-- ОСНОВНОЙ КОНТЕНТ -->
    <main class="mk-main" id="mkMain">
        <div class="mk-container">
            <!-- Заголовок секции -->
            <div class="mk-section-head">
                <div>
                    <h2>Все автомобили</h2>
                    <span class="count">{{ $cars->count() }} машины</span>
                </div>
                <a href="{{ route('dashboard.add') }}" class="mk-btn mk-btn--primary" id="add-car-btn">
                    <i class="bi bi-plus-lg"></i> Добавить авто
                </a>
            </div>

            <!-- Сетка карточек -->
            <div class="mk-garage-grid">
                @foreach ($cars as $car)
                    <a href="{{ route('dashboard.cardetail', ['id' => $car->id]) }}" class="mk-car-card">
                        <div class="mk-car-card__media">
                            <svg viewBox="0 0 400 160" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <rect width="400" height="160" rx="12" fill="url(#carGrad-{{ $car->id }})" />
                                <g transform="translate(40, 10)">
                                    <path d="M240 100 L220 100 L210 80 L190 80 L180 100 L160 100 L150 120 L290 120 L280 100 L270 100 L240 100Z" fill="#2F6BFF" opacity="0.2" />
                                    <path d="M165 120 L275 120 L270 140 L170 140 L165 120Z" fill="#2F6BFF" opacity="0.12" />
                                    <circle cx="195" cy="150" r="18" fill="none" stroke="#2F6BFF" stroke-width="3" opacity="0.3" />
                                    <circle cx="245" cy="150" r="18" fill="none" stroke="#2F6BFF" stroke-width="3" opacity="0.3" />
                                    <rect x="145" y="88" width="14" height="5" rx="2.5" fill="#2F6BFF" opacity="0.4" />
                                    <rect x="277" y="88" width="14" height="5" rx="2.5" fill="#2F6BFF" opacity="0.4" />
                                </g>
                                <defs>
                                    <linearGradient id="carGrad-{{ $car->id }}" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#EAF1FF" />
                                        <stop offset="100%" stop-color="#DCE8F8" />
                                    </linearGradient>
                                </defs>
                            </svg>
                            <span class="mk-car-card__plate">{{ $car->plate }}</span>
                        </div>
                        <div class="mk-car-card__body">
                            <h3 class="mk-car-card__name">{{ $car->brand->name }}</h3>
                            <div class="mk-car-card__model">{{ $car->model->name }} · {{ $car->year }}</div>

                            <div class="mk-car-card__odo">
                                <div class="mk-odo-small">
                                    <span class="mk-odo-small__label">Пробег</span>
                                    <span class="mk-odo-small__value">{{ $car->mileage_formatted }} <span class="mk-odo-small__unit">км</span></span>
                                    <span class="mk-odo-small__track" aria-hidden="true"></span>
                                </div>
                            </div>

                            <div class="mk-car-card__stats">
                                <div class="mk-car-card__stat">
                                    <div class="mk-car-card__stat-value">{{ count($car->history)}}</div>
                                    <div class="mk-car-card__stat-label">записей</div>
                                </div>
                                <div class="mk-car-card__stat">
                                    <div class="mk-car-card__stat-value">{{ $car->year_spend_formatted }} ₽</div>
                                    <div class="mk-car-card__stat-label">расходы</div>
                                </div>
                                <div class="mk-car-card__stat">
                                    <div class="mk-car-card__stat-value">{{ $car->next_service_formatted }}</div>
                                    <div class="mk-car-card__stat-label">до ТО, км</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </main>

    <!-- ФУТЕР -->
    @include('layouts.private.footer')
</div>
</body>
</html>
