(function () {
    'use strict';

    // Элементы
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const switchBtn = document.getElementById('switch-mode');
    const switchText = document.getElementById('switch-text');
    const formTitle = document.getElementById('form-title');
    const formSub = document.getElementById('form-sub');

    // Скрипт грузится на всех страницах через общий app.js —
    // выполняем логику только там, где есть форма входа/регистрации.
    if (!loginForm || !registerForm || !switchBtn) {
        return;
    }

    let isLoginMode = true;

    // Функция переключения режима
    function toggleMode() {
        isLoginMode = !isLoginMode;

        if (isLoginMode) {
            loginForm.style.display = 'flex';
            registerForm.style.display = 'none';
            formTitle.textContent = 'Вход';
            formSub.textContent = 'Войдите в свой аккаунт';
            switchText.textContent = 'Нет аккаунта?';
            switchBtn.textContent = 'Зарегистрироваться';
            // Очищаем ошибки
            clearErrors(loginForm);
        } else {
            loginForm.style.display = 'none';
            registerForm.style.display = 'flex';
            formTitle.textContent = 'Регистрация';
            formSub.textContent = 'Создайте новый аккаунт';
            switchText.textContent = 'Уже есть аккаунт?';
            switchBtn.textContent = 'Войти';
            clearErrors(registerForm);
        }
    }

    // Очистка ошибок
    function clearErrors(form) {
        form.querySelectorAll('.mk-field').forEach(field => {
            field.classList.remove('mk-field--error');
            const err = field.querySelector('.mk-field__error');
            if (err) err.textContent = '';
        });
    }

    // Валидация email
    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    // Валидация пароля (минимум 6 символов)
    function isValidPassword(pwd) {
        return pwd.length >= 6;
    }

    // Показ ошибки поля
    function setFieldError(field, message) {
        const wrapper = field.closest('.mk-field');
        if (!wrapper) return;
        wrapper.classList.add('mk-field--error');
        const errorEl = wrapper.querySelector('.mk-field__error');
        if (errorEl) errorEl.textContent = message;
    }

    // Обработка отправки формы входа — клиентская валидация перед
    // реальной отправкой формы на бэкенд (action="{{ route('login') }}")
    loginForm.addEventListener('submit', function (e) {
        clearErrors(loginForm);

        const email = document.getElementById('login-email');
        const password = document.getElementById('login-password');
        let valid = true;

        if (!isValidEmail(email.value)) {
            setFieldError(email, 'Введите корректный email');
            valid = false;
        }

        if (!isValidPassword(password.value)) {
            setFieldError(password, 'Пароль должен содержать минимум 6 символов');
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
        }
        // Если валидно — форма отправляется на сервер как обычно.
    });

    // Обработка отправки формы регистрации
    registerForm.addEventListener('submit', function (e) {
        e.preventDefault();
        clearErrors(registerForm);

        const name = document.getElementById('reg-name');
        const email = document.getElementById('reg-email');
        const password = document.getElementById('reg-password');
        const confirm = document.getElementById('reg-password-confirm');
        let valid = true;

        if (name.value.trim().length < 2) {
            setFieldError(name, 'Введите имя (минимум 2 символа)');
            valid = false;
        }

        if (!isValidEmail(email.value)) {
            setFieldError(email, 'Введите корректный email');
            valid = false;
        }

        if (!isValidPassword(password.value)) {
            setFieldError(password, 'Пароль должен содержать минимум 6 символов');
            valid = false;
        }

        if (password.value !== confirm.value) {
            setFieldError(confirm, 'Пароли не совпадают');
            valid = false;
        }

        if (!valid) return;

        // Имитация регистрации
        console.log('Регистрация:', name.value, email.value, password.value);
        window.showToast('Аккаунт создан!', 'success');
        setTimeout(() => {
            window.location.href = '/garage';
        }, 1500);
    });

    // Переключение режима
    switchBtn.addEventListener('click', toggleMode);

    // Дополнительно: если нажать Enter в поле пароля — отправка формы
    // (уже работает за счёт type="submit")

})();
