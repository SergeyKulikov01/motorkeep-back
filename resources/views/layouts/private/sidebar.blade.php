<aside class="mk-sidebar" role="navigation" aria-label="Главное меню">
    <div class="mk-sidebar__brand">
        <a href="{{ route('dashboard') }}" class="mk-logo" aria-label="MOTORKEEP — на главную">
            <span class="mk-logo__mark"><i class="bi bi-car-front-fill"></i></span>
            <span class="mk-logo__text">MOTOR<span class="mk-logo__text-accent">KEEP</span></span>
        </a>
    </div>
    <?
//    echo '<pre>';
//    print_r($sidebarCars);
//    echo '</pre>';
    ?>
    <nav class="mk-sidebar__nav">
        <div class="mk-navlabel">Меню</div>
        <a href="garage.html" class="mk-navitem mk-navitem--active" data-tip="Гараж">
            <svg viewBox="0 0 24 24">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            <span class="lbl">Гараж</span>
        </a>
        <a href="#" class="mk-navitem" data-tip="Автомобили" data-section="cars">
            <svg viewBox="0 0 24 24">
                <rect x="2" y="6" width="20" height="12" rx="2"/>
                <circle cx="8" cy="18" r="2"/>
                <circle cx="16" cy="18" r="2"/>
                <path d="M2 10h20"/>
            </svg>
            <span class="lbl">Автомобили</span>
        </a>
        <a href="#" class="mk-navitem" data-tip="Статистика" data-section="stats">
            <svg viewBox="0 0 24 24">
                <line x1="18" y1="20" x2="18" y2="10"/>
                <line x1="12" y1="20" x2="12" y2="4"/>
                <line x1="6" y1="20" x2="6" y2="14"/>
            </svg>
            <span class="lbl">Статистика</span>
        </a>
        @if(count($sidebarCars) > 0)
            <div class="mk-navlabel">Автомобили</div>
        @foreach($sidebarCars as $car)
                <a href="garage.html" class="mk-navitem mk-navitem--active" data-tip="Гараж">
                    <span class="mk-userchip__avatar">LG</span>
                    <span class="lbl">{{$car->brand->name}} {{$car->model->name}}</span>
                </a>
        @endforeach
        @endif
        <div class="mk-navlabel">Гараж</div>
        <a href="#" class="mk-navitem" data-tip="Напоминания" data-section="reminders">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
            </svg>
            <span class="lbl">Напоминания</span>
            <span class="pill">3</span>
        </a>
        <a href="#" class="mk-navitem" data-tip="Расходы" data-section="expenses">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <path d="M8 12h8"/>
                <path d="M12 8v8"/>
            </svg>
            <span class="lbl">Расходы</span>
        </a>
    </nav>
    <div class="mk-sidebar__foot">
        <a href="#" class="mk-navitem" data-tip="Настройки" data-section="settings">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="3"/>
                <path
                    d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
            </svg>
            <span class="lbl">Настройки</span>
        </a>
        <button class="mk-collapse" aria-label="Свернуть сайдбар">
            <svg viewBox="0 0 24 24" width="20" height="20">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            <span>Свернуть</span>
        </button>
        <!-- Кнопка Выйти -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="mk-navitem mk-logout" data-tip="Выйти">
                <svg viewBox="0 0 24 24">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                <span class="lbl">Выйти</span>
            </button>
        </form>
    </div>
</aside>
