<!DOCTYPE html>
<html lang="ru">
<head>
    @include('layouts.public.landing-head')
</head>
<body class="mk-reset-page">

<div class="mk-reset-container">
    <div class="mk-reset-card" role="main" aria-labelledby="reset-title">

        <!-- Логотип -->
        <a href="/" class="mk-logo" aria-label="MOTORKEEP — на главную">
            <span class="mk-logo__mark"><i class="bi bi-car-front-fill"></i></span>
            <span class="mk-logo__text">MOTOR<span>KEEP</span></span>
        </a>

        @if ($errors->has('email'))
            <!-- Состояние: токен недействителен -->
            <div id="invalid-state">
                <div class="mk-error-icon">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <h1>Ссылка недействительна</h1>
                <p class="mk-error-text">
                    {{ $errors->first('email') }}
                    Пожалуйста, запросите восстановление пароля заново.
                </p>
                <a href="{{ route('password.request') }}" class="mk-btn mk-btn--primary mk-btn--full">Запросить новую ссылку</a>
                <p class="mk-reset-back">
                    <a href="{{ route('login') }}">← Вернуться ко входу</a>
                </p>
            </div>
        @else
            <!-- Состояние: форма сброса -->
            <div id="form-state">
                <h1 id="reset-title">Установите новый пароль</h1>
                <p class="mk-reset-sub">Для учётной записи <strong id="display-email">{{ $request->email }}</strong> установите новый пароль.</p>

                <form method="POST" action="{{ route('password.store') }}" id="reset-form" novalidate>
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email (readonly) -->
                    <div class="mk-form-group">
                        <label for="email">Электронная почта</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" readonly required />
                    </div>

                    <!-- Новый пароль -->
                    <div class="mk-form-group">
                        <label for="password">Новый пароль</label>
                        <input type="password" id="password" name="password" class="{{ $errors->has('password') ? 'error' : '' }}" placeholder="Не менее 8 символов, буквы и цифры" autofocus required />
                        <div class="mk-error-message" id="password-error">{{ $errors->first('password') }}</div>
                    </div>

                    <!-- Подтверждение пароля -->
                    <div class="mk-form-group">
                        <label for="password-confirm">Подтвердите пароль</label>
                        <input type="password" id="password-confirm" name="password_confirmation" placeholder="Повторите пароль" required />
                        <div class="mk-error-message" id="confirm-error"></div>
                    </div>

                    <button type="submit" class="mk-btn mk-btn--primary mk-btn--full">Сохранить новый пароль</button>
                </form>

                <p class="mk-reset-back">
                    <a href="{{ route('login') }}">← Вернуться ко входу</a>
                </p>
            </div>
        @endif
    </div>
</div>
</body>
</html>