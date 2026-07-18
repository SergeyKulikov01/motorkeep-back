(function() {
    'use strict';

    // #password и #password-confirm существуют только на странице сброса пароля —
    // проверяем оба, чтобы не задеть другие формы, где тоже встречается id="password"
    // (профиль, регистрация, подтверждение пароля).
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password-confirm');
    if (!passwordInput || !confirmInput) return;

    const form = passwordInput.closest('form');
    const passwordError = document.getElementById('password-error');
    const confirmError = document.getElementById('confirm-error');
    if (!form || !passwordError || !confirmError) return;

    function clearErrors() {
        passwordInput.classList.remove('error');
        confirmInput.classList.remove('error');
        passwordError.textContent = '';
        confirmError.textContent = '';
    }

    // Политика: минимум 8 символов, хотя бы одна буква и одна цифра
    function validatePassword(password) {
        if (password.length < 8) {
            return 'Пароль должен содержать не менее 8 символов.';
        }
        if (!/[A-Za-z]/.test(password)) {
            return 'Пароль должен содержать хотя бы одну букву.';
        }
        if (!/[0-9]/.test(password)) {
            return 'Пароль должен содержать хотя бы одну цифру.';
        }
        return null;
    }

    form.addEventListener('submit', function(e) {
        clearErrors();

        const password = passwordInput.value;
        const confirm = confirmInput.value;

        const passError = validatePassword(password);
        if (passError) {
            e.preventDefault();
            passwordError.textContent = passError;
            passwordInput.classList.add('error');
            return;
        }

        if (password !== confirm) {
            e.preventDefault();
            confirmError.textContent = 'Пароли не совпадают.';
            confirmInput.classList.add('error');
            return;
        }

        // Клиентская проверка пройдена — форма реально отправляется на сервер
        // (route('password.store')). Ответ определяет Blade: успех — редирект
        // на login, ошибка — страница вернётся с $errors.
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Сохранение...';
    });

    passwordInput.addEventListener('input', function() {
        if (passwordInput.classList.contains('error')) {
            passwordError.textContent = '';
            passwordInput.classList.remove('error');
        }
    });
    confirmInput.addEventListener('input', function() {
        if (confirmInput.classList.contains('error')) {
            confirmError.textContent = '';
            confirmInput.classList.remove('error');
        }
    });
})();