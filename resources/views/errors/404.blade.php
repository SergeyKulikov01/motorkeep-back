@include('layouts.public.landing-head')
<body>
@include('layouts.public.landing-header')
<!-- ===== ОСНОВНОЙ КОНТЕНТ ===== -->
<main class="mk-error-page">
    <div class="mk-error-page__inner">

        <!-- Левая колонка: текст -->
        <div class="mk-error-page__content">
            <p class="mk-eyebrow">ОШИБКА 404</p>
            <h1 class="mk-error-page__title">
                <span class="mk-error-page__code">404</span>
                Страница не найдена
            </h1>
            <p class="mk-error-page__text">
                Похоже, вы свернули не туда. Такой страницы не существует — возможно, она была перемещена или удалена.
            </p>

            <div class="mk-error-page__actions">
                <a href="/" class="mk-btn mk-btn--primary">
                    <i class="bi bi-arrow-left"></i> На главную
                </a>
                <a href="/contacts.html" class="mk-btn mk-btn--ghost">
                    Сообщить о проблеме
                </a>
            </div>

            <!-- Полезные ссылки -->
            <div class="mk-error-page__links">
                <span class="mk-error-page__links-label">Возможно, вы искали:</span>
                <div class="mk-error-page__links-grid">
                    <a href="/#features">
                        <i class="bi bi-grid"></i> Возможности
                    </a>
                    <a href="/#pricing">
                        <i class="bi bi-tag"></i> Цены
                    </a>
                    <a href="/login">
                        <i class="bi bi-box-arrow-in-right"></i> Войти
                    </a>
                    <a href="/register">
                        <i class="bi bi-person-plus"></i> Регистрация
                    </a>
                    <a href="/contacts.html">
                        <i class="bi bi-envelope"></i> Контакты
                    </a>
                    <a href="/privacy.html">
                        <i class="bi bi-shield-check"></i> Конфиденциальность
                    </a>
                </div>
            </div>
        </div>

        <!-- Правая колонка: иллюстрация -->
        <div class="mk-error-page__illustration" aria-hidden="true">
            <svg viewBox="0 0 500 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Фоновый круг -->
                <circle cx="250" cy="200" r="180" fill="#EAF1FF" opacity="0.5" />
                <circle cx="250" cy="200" r="130" fill="#EAF1FF" opacity="0.6" />

                <!-- Дорога -->
                <path d="M 40 340 Q 250 320 460 340" stroke="#D4DCE8" stroke-width="2" fill="none" stroke-dasharray="12 10" />

                <!-- Указатель -->
                <g transform="translate(360, 120)">
                    <rect x="-4" y="0" width="8" height="120" fill="#D4DCE8" rx="3" />
                    <rect x="-60" y="-30" width="120" height="34" rx="6" fill="#FFFFFF" stroke="#E5EAF2" stroke-width="2" />
                    <text x="0" y="-8" text-anchor="middle" font-family="Space Grotesk, sans-serif" font-weight="700" font-size="13" fill="#5B6B82">ТУПИК</text>
                    <text x="0" y="20" text-anchor="middle" font-family="Inter, sans-serif" font-size="10" fill="#93A1B5">дальше дороги нет</text>
                </g>

                <!-- Автомобиль (силуэт, outline) -->
                <g transform="translate(120, 210)" stroke="#2F6BFF" stroke-width="2.2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M 30 50 L 50 50 L 65 20 L 135 20 L 150 50 L 170 50 L 180 70 L 180 95 L 20 95 L 20 70 Z" />
                    <path d="M 70 20 L 78 50 M 122 20 L 114 50" />
                    <circle cx="60" cy="100" r="15" />
                    <circle cx="140" cy="100" r="15" />
                    <path d="M 20 75 L 10 75" />
                    <circle cx="6" cy="75" r="3" fill="#2F6BFF" />
                </g>

                <!-- Знак вопроса над машиной -->
                <g transform="translate(240, 170)">
                    <circle cx="0" cy="0" r="26" fill="#2F6BFF" />
                    <text x="0" y="9" text-anchor="middle" font-family="Space Grotesk, sans-serif" font-weight="700" font-size="28" fill="#FFFFFF">?</text>
                </g>

                <!-- Декоративные точки -->
                <circle cx="90" cy="120" r="4" fill="#2F6BFF" opacity="0.3" />
                <circle cx="420" cy="90" r="6" fill="#2F6BFF" opacity="0.2" />
                <circle cx="80" cy="280" r="5" fill="#2F6BFF" opacity="0.25" />
                <circle cx="440" cy="280" r="3" fill="#2F6BFF" opacity="0.4" />
            </svg>
        </div>

    </div>
</main>

@include('layouts.public.landing-footer')

</body>
</html>
