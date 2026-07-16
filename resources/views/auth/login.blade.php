<!DOCTYPE html>
<html lang="ru">
<head>
    @include('layouts.public.landing-head')
    <script src="https://yastatic.net/s3/passport-sdk/autofill/v1/sdk-suggest-with-polyfills-latest.js"></script>
</head>
<body>

<div class="mk-auth-page">

    <!-- Левая панель: бренд + новый текст -->
    <div class="mk-auth-brand">
        <div class="mk-auth-brand__inner">
            <a href="/" class="mk-logo mk-logo--lg" aria-label="MOTORKEEP — на главную">
                    <span class="mk-logo__mark">
                        <i class="bi bi-car-front-fill"></i>
                    </span>
                <span class="mk-logo__text">MOTOR<span class="mk-logo__text-accent">KEEP</span></span>
            </a>
            <p class="mk-auth-brand__slogan">Дневник автомобиля</p>

            <div class="mk-auth-brand__features">
                <div class="mk-auth-brand__feature">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <span>Ведите полную историю обслуживания</span>
                </div>
                <div class="mk-auth-brand__feature">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <span>Контролируйте расходы на топливо и ремонт</span>
                </div>
                <div class="mk-auth-brand__feature">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <span>Получайте напоминания о ТО</span>
                </div>
                <div class="mk-auth-brand__feature">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <span>Все данные в одном месте</span>
                </div>
            </div>

            <div class="mk-auth-brand__illustration" aria-hidden="true">
                <svg viewBox="0 0 160 100" fill="none">
                    <rect x="12" y="28" width="136" height="44" rx="8" fill="rgba(255,255,255,.12)"/>
                    <rect x="20" y="34" width="120" height="32" rx="6" fill="rgba(255,255,255,.08)"/>
                    <path d="M34 50h92M40 42h80M46 58h68" stroke="rgba(255,255,255,.15)" stroke-width="2"
                          stroke-linecap="round"/>
                    <circle cx="56" cy="50" r="10" stroke="rgba(255,255,255,.2)" stroke-width="1.8"/>
                    <circle cx="104" cy="50" r="10" stroke="rgba(255,255,255,.2)" stroke-width="1.8"/>
                    <text x="48" y="82" font-family="Space Grotesk" font-size="22" font-weight="700"
                          fill="rgba(255,255,255,.5)">86 420 км
                    </text>
                </svg>
            </div>
        </div>
    </div>

    <!-- Правая панель: форма -->
    @php($showRegister = $errors->has('name'))
    <div class="mk-auth-form">
        <div class="mk-auth-form__card">
            <div class="mk-auth-form__head">
                <h1 class="mk-auth-form__title" id="form-title">{{ $showRegister ? 'Регистрация' : 'Вход' }}</h1>
                <p class="mk-auth-form__sub" id="form-sub">{{ $showRegister ? 'Создайте новый аккаунт' : 'Войдите в свой аккаунт' }}</p>
            </div>

            <form class="mk-auth-form__form" id="login-form" method="POST" action="{{ route('login') }}"
                  autocomplete="off" novalidate style="display:{{ $showRegister ? 'none' : 'flex' }};">
                @csrf
                <div class="mk-field @error('email') mk-field--error @enderror">
                    <label for="login-email" class="mk-field__label">Email</label>
                    <input type="email" id="login-email" name="email" class="mk-field__input"
                           placeholder="ivan@example.com" value="{{ old('email') }}" autocomplete="username" autofocus
                           required/>
                    <div class="mk-field__error" id="login-email-error">{{ $errors->first('email') }}</div>
                </div>
                <div class="mk-field @error('password') mk-field--error @enderror">
                    <label for="login-password" class="mk-field__label">Пароль</label>
                    <input type="password" id="login-password" name="password" class="mk-field__input"
                           placeholder="••••••••" autocomplete="current-password" required/>
                    <div class="mk-field__error" id="login-password-error">{{ $errors->first('password') }}</div>
                </div>
                <div class="mk-auth-form__options">
                    <label class="mk-checkbox">
                        <input type="checkbox" name="remember" checked/> Запомнить меня
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="mk-auth-form__link">Забыли пароль?</a>
                    @endif
                </div>
                <button type="submit" class="mk-btn mk-btn--primary mk-btn--block mk-btn--lg">Войти</button>
            </form>

            <form class="mk-auth-form__form" method="POST" action="{{ route('register') }}" id="register-form" autocomplete="off" novalidate
                  style="display:{{ $showRegister ? 'flex' : 'none' }};">
                @csrf
                <div class="mk-field @error('name') mk-field--error @enderror">
                    <label for="reg-name" class="mk-field__label">Имя</label>
                    <input type="text" id="reg-name" name="name" class="mk-field__input" placeholder="Иван" value="{{ old('name') }}" required/>
                    <div class="mk-field__error" id="reg-name-error">{{ $errors->first('name') }}</div>
                </div>
                <div class="mk-field @error('last_name') mk-field--error @enderror">
                    <label for="reg-last-name" class="mk-field__label">Фамилия</label>
                    <input type="text" id="reg-last-name" name="last_name" class="mk-field__input" placeholder="Петров" value="{{ old('last_name') }}" required/>
                    <div class="mk-field__error" id="reg-last-name-error">{{ $errors->first('last_name') }}</div>
                </div>
                <div class="mk-field @error('email') mk-field--error @enderror">
                    <label for="reg-email" class="mk-field__label">Email</label>
                    <input type="email" id="reg-email" name="email" class="mk-field__input" placeholder="ivan@example.com" value="{{ old('email') }}" required/>
                    <div class="mk-field__error" id="reg-email-error">{{ $errors->first('email') }}</div>
                </div>
                <div class="mk-field @error('password') mk-field--error @enderror">
                    <label for="reg-password" class="mk-field__label">Пароль</label>
                    <input type="password" id="reg-password" name="password" class="mk-field__input" placeholder="••••••••" required/>
                    <div class="mk-field__error" id="reg-password-error">{{ $errors->first('password') }}</div>
                </div>
                <div class="mk-field">
                    <label for="reg-password-confirm" class="mk-field__label">Подтвердите пароль</label>
                    <input type="password" id="reg-password-confirm" name="password_confirmation" class="mk-field__input" placeholder="••••••••"
                           required/>
                    <div class="mk-field__error" id="reg-password-confirm-error"></div>
                </div>
                <button type="submit" class="mk-btn mk-btn--primary mk-btn--block mk-btn--lg">Создать аккаунт</button>
            </form>

            <div class="mk-auth-form__divider"><span>или</span></div>
            <div class="mk-auth-form__social">
                <script>
                    window.onload = function() {
                        window.YaAuthSuggest.init({
                                client_id: '400ef071329e44188865a1fcd4572105',
                                response_type: 'token',
                                redirect_uri: 'https://motorkeep.ru/'
                            },
                            'https://motorkeep.ru',
                            {
                                view: "button",
                                parentId: "social-auth",
                                buttonSize: 'm',
                                buttonView: 'main',
                                buttonTheme: 'light',
                                buttonBorderRadius: "22",
                                buttonIcon: 'ya',
                            }
                        )
                            .then(function(result) {
                                return result.handler()
                            })
                            .then(function(data) {
                                console.log('Сообщение с токеном: ', data);
                                document.body.innerHTML += `Сообщение с токеном: ${JSON.stringify(data)}`;
                            })
                            .catch(function(error) {
                                console.log('Что-то пошло не так: ', error);
                                document.body.innerHTML += `Что-то пошло не так: ${JSON.stringify(error)}`;
                            });
                    };
                </script>
                <div id="social-auth">

                </div>
                <button class="mk-btn mk-btn--ghost mk-btn--block" type="button" >
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Google
                </button>
            </div>

            <div class="mk-auth-form__switch">
                <span id="switch-text">{{ $showRegister ? 'Уже есть аккаунт?' : 'Нет аккаунта?' }}</span>
                <button type="button" class="mk-auth-form__switch-btn" id="switch-mode">{{ $showRegister ? 'Войти' : 'Зарегистрироваться' }}</button>
            </div>
        </div>
    </div>

</div>

<div class="mk-toast-container" aria-live="polite"></div>

</body>
</html>
