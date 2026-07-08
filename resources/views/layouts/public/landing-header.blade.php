<!-- ============================================================ -->
<!--  ШАПКА ЛЕНДИНГА (упрощённая, без сайдбара)                    -->
<!-- ============================================================ -->
<header class="mk-landing-topbar" role="banner">
    <div class="mk-landing-topbar__inner">
        <!-- Логотип — компонент .mk-logo -->
        <a href="/" class="mk-logo" aria-label="MOTORKEEP — на главную">
                <span class="mk-logo__mark">
                    <i class="bi bi-car-front-fill"></i>
                </span>
            <span class="mk-logo__text">MOTOR<span class="mk-logo__text-accent">KEEP</span></span>
        </a>

        <!-- Навигация (десктоп) — расширенная -->
        <nav class="mk-landing-nav" aria-label="Основная навигация">
            <a href="#features">Возможности</a>
            <a href="#pricing">Цены</a>
            <a href="#about">О нас</a>
            <a href="#blog">Блог</a>
            <a href="#contacts">Контакты</a>
        </nav>

        <!-- Кнопки входа / регистрации -->
        <div class="mk-landing-actions">
            @if (Auth::check())
                <a href="{{ route('dashboard') }}" class="mk-btn mk-btn--primary mk-btn--sm">Панель управления</a>
            @else
                <a href="{{ route('login') }}" class="mk-btn mk-btn--primary mk-btn--sm">Вход</a>
            @endif
        </div>

        <!-- Бургер (мобайл) -->
        <button class="mk-landing-burger" aria-label="Открыть меню" data-mobile-toggle>
            <span></span><span></span><span></span>
        </button>
    </div>

    <!-- Мобильное меню (выезжает) — обновлённое -->
    <div class="mk-landing-mobile-menu" data-mobile-menu>
        <nav>
            <a href="#features">Возможности</a>
            <a href="#pricing">Цены</a>
            <a href="#about">О нас</a>
            <a href="#blog">Блог</a>
            <a href="#contacts">Контакты</a>
            <hr />
            <a href="#login" class="mk-btn mk-btn--ghost mk-btn--block">Войти</a>
            <a href="#register" class="mk-btn mk-btn--primary mk-btn--block">Начать</a>
        </nav>
    </div>
</header>
