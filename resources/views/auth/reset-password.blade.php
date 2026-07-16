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

        <!-- Состояние: токен недействителен -->
        <div id="invalid-state">
            <div class="mk-error-icon">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>
            <h1>Ссылка недействительна</h1>
            <p class="mk-error-text">
                Срок действия ссылки для сброса пароля истёк, или она была использована ранее.
                Пожалуйста, запросите восстановление пароля заново.
            </p>
            <a href="/forgot-password.html" class="mk-btn mk-btn--primary mk-btn--full">Запросить новую ссылку</a>
            <p class="mk-reset-back">
                <a href="/login">← Вернуться ко входу</a>
            </p>
        </div>

        <!-- Состояние: форма сброса -->
        <div id="form-state" style="display:none;">
            <h1 id="reset-title">Установите новый пароль</h1>
            <p class="mk-reset-sub">Для учётной записи <strong id="display-email"></strong> установите новый пароль.</p>

            <form id="reset-form" novalidate>
                <!-- Email (readonly) -->
                <div class="mk-form-group">
                    <label for="email">Электронная почта</label>
                    <input type="email" id="email" readonly />
                </div>

                <!-- Новый пароль -->
                <div class="mk-form-group">
                    <label for="password">Новый пароль</label>
                    <input type="password" id="password" placeholder="Не менее 8 символов, буквы и цифры" autofocus />
                    <div class="mk-error-message" id="password-error"></div>
                </div>

                <!-- Подтверждение пароля -->
                <div class="mk-form-group">
                    <label for="password-confirm">Подтвердите пароль</label>
                    <input type="password" id="password-confirm" placeholder="Повторите пароль" />
                    <div class="mk-error-message" id="confirm-error"></div>
                </div>

                <button type="submit" class="mk-btn mk-btn--primary mk-btn--full">Сохранить новый пароль</button>
            </form>

            <p class="mk-reset-back">
                <a href="/login">← Вернуться ко входу</a>
            </p>
        </div>

        <!-- Состояние: успех -->
        <div id="success-state" style="display:none;">
            <div class="mk-success-icon">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <h1>Пароль изменён</h1>
            <p class="mk-success-text">
                Ваш пароль успешно обновлён. Теперь вы можете войти в систему с новым паролем.
            </p>
            <a href="/login" class="mk-btn mk-btn--primary mk-btn--full">Войти</a>
        </div>
    </div>
</div>
</body>
</html>
{{--<x-guest-layout>--}}
{{--    <form method="POST" action="{{ route('password.store') }}">--}}
{{--        @csrf--}}

{{--        <!-- Password Reset Token -->--}}
{{--        <input type="hidden" name="token" value="{{ $request->route('token') }}">--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}
{{--            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />--}}
{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Confirm Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--            <x-text-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                                type="password"--}}
{{--                                name="password_confirmation" required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <x-primary-button>--}}
{{--                {{ __('Reset Password') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}
