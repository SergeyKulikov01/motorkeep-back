(function() {
    'use strict';

    // Получение параметров из URL
    const urlParams = new URLSearchParams(window.location.search);
    const token = urlParams.get('token');
    const emailParam = urlParams.get('email');

    // Элементы
    const invalidState = document.getElementById('invalid-state');
    const formState = document.getElementById('form-state');
    const successState = document.getElementById('success-state');
    const form = document.getElementById('reset-form');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password-confirm');
    const displayEmail = document.getElementById('display-email');
    const passwordError = document.getElementById('password-error');
    const confirmError = document.getElementById('confirm-error');

    // --- Проверка токена ---
    // Имитация проверки: токен должен быть не пустым, длиной не менее 10 символов,
    // и содержать только буквы и цифры (упрощённо).
    function isTokenValid(token) {
        if (!token) return false;
        if (token.length < 10) return false;
        // допустим, токен должен состоять из латинских букв и цифр
        return /^[A-Za-z0-9]+$/.test(token);
    }

    if (!isTokenValid(token) || !emailParam) {
        // Показываем ошибку токена
        invalidState.style.display = 'block';
        formState.style.display = 'none';
        successState.style.display = 'none';
        return;
    }

    // Токен валиден — показываем форму
    invalidState.style.display = 'none';
    formState.style.display = 'block';
    successState.style.display = 'none';

    // Предзаполняем email (readonly)
    emailInput.value = emailParam;
    displayEmail.textContent = emailParam;

    // --- Очистка ошибок ---
    function clearErrors() {
        passwordInput.classList.remove('error');
        confirmInput.classList.remove('error');
        passwordError.textContent = '';
        confirmError.textContent = '';
    }

    // --- Валидация пароля ---
    function validatePassword(password) {
        // Политика: минимум 8 символов, хотя бы одна буква и одна цифра
        if (password.length < 8) {
            return 'Пароль должен содержать не менее 8 символов.';
        }
        if (!/[A-Za-z]/.test(password)) {
            return 'Пароль должен содержать хотя бы одну букву.';
        }
        if (!/[0-9]/.test(password)) {
            return 'Пароль должен содержать хотя бы одну цифру.';
        }
        return null; // null = ошибок нет
    }

    // --- Обработка отправки ---
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Сброс ошибок
        clearErrors();

        const email = emailInput.value.trim();
        const password = passwordInput.value;
        const confirm = confirmInput.value;

        // Проверка email (должен совпадать с параметром)
        if (email !== emailParam) {
            // В реальном приложении это может быть ошибка "несоответствие токена"
            // Покажем общую ошибку
            passwordError.textContent = 'Недействительный запрос. Пожалуйста, запросите сброс заново.';
            passwordInput.classList.add('error');
            return;
        }

        // Проверка пароля
        const passError = validatePassword(password);
        if (passError) {
            passwordError.textContent = passError;
            passwordInput.classList.add('error');
            return;
        }

        // Проверка совпадения
        if (password !== confirm) {
            confirmError.textContent = 'Пароли не совпадают.';
            confirmInput.classList.add('error');
            return;
        }

        // Если всё ок — имитируем отправку
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Сохранение...';

        setTimeout(function() {
            // Успех
            formState.style.display = 'none';
            successState.style.display = 'block';
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        }, 1200);
    });

    // Очистка ошибок при вводе
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
