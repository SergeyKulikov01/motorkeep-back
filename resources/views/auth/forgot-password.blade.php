<!DOCTYPE html>
<html lang="ru">
<head>
    @include('layouts.public.landing-head')
</head>
<body class="mk-forgot-page">

<div class="mk-forgot-container">
    <div class="mk-forgot-card" role="main" aria-labelledby="forgot-title">

        <!-- Логотип -->
        <a href="/" class="mk-logo" aria-label="MOTORKEEP — на главную">
            <span class="mk-logo__mark"><i class="bi bi-car-front-fill"></i></span>
            <span class="mk-logo__text">MOTOR<span>KEEP</span></span>
        </a>

        <!-- Состояние: форма -->
        <div id="form-state" style="{{ session('status') ? 'display:none;' : '' }}">
            <h1 id="forgot-title">Восстановление пароля</h1>
            <p class="mk-forgot-sub">Введите адрес электронной почты, указанный при регистрации. Мы отправим ссылку для сброса пароля.</p>

            <form method="POST" action="{{ route('password.email') }}" id="reset-form" novalidate>
                @csrf
                <div class="mk-form-group">
                    <label for="email">Электронная почта</label>
                    <input type="email" id="email" name="email" class="{{ $errors->has('email') ? 'error' : '' }}" placeholder="ivan@example.ru" value="{{ old('email') }}" required autofocus />
                    <div class="mk-error-message" id="email-error">{{ $errors->first('email') }}</div>
                </div>
                <button type="submit" class="mk-btn mk-btn--primary mk-btn--full">Отправить ссылку</button>
            </form>

            <p class="mk-forgot-back">
                <a href="/login">← Вернуться ко входу</a>
            </p>
        </div>

        <!-- Состояние: успех -->
        <div id="success-state" style="{{ session('status') ? '' : 'display:none;' }}">
            <div class="mk-success-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <h1>Письмо отправлено</h1>
            <p class="mk-success-text">
                Ссылка для сброса пароля отправлена на ваш email.<br />
                Если письмо не пришло, проверьте папку «Спам» или попробуйте ещё раз.
            </p>
            <a href="/login" class="mk-btn mk-btn--primary mk-btn--full">Вернуться ко входу</a>
        </div>
    </div>
</div>

</body>
</html>
