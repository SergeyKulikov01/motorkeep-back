<!DOCTYPE html>
<html lang="ru">
<head>
    @include('layouts.public.landing-head')
    <script src="https://yastatic.net/s3/passport-sdk/autofill/v1/sdk-suggest-with-polyfills-latest.js"></script>
</head>
<body>
<div class="mk-auth-page">
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
                                client_id: '{{ config('services.yandex.client_id') }}',
                                response_type: 'token',
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
                                return fetch('{{ route('auth.yandex.callback') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    },
                                    body: JSON.stringify({ access_token: data.access_token }),
                                });
                            })
                            .then(function(response) {
                                return response.json().then(function(result) {
                                    return { ok: response.ok, result: result };
                                });
                            })
                            .then(function({ ok, result }) {
                                if (ok && result.redirect) {
                                    window.location.href = result.redirect;
                                } else {
                                    mkToast(result.message || 'Не удалось войти через Яндекс.');
                                }
                            })
                            .catch(function(error) {
                                console.log('Что-то пошло не так: ', error);
                                mkToast('Что-то пошло не так при входе через Яндекс.');
                            });
                    };
                    function mkToast(message) {
                        var container = document.querySelector('.mk-toast-container');
                        if (!container) return;
                        var toast = document.createElement('div');
                        toast.className = 'mk-toast';
                        toast.style.borderLeftColor = 'var(--mk-danger)';
                        toast.innerHTML = '<span class="mk-toast__dot" style="background: var(--mk-danger);"></span>' + message;
                        container.appendChild(toast);
                        setTimeout(function() { toast.remove(); }, 5000);
                    }
                </script>
                <div id="social-auth">

                </div>
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
