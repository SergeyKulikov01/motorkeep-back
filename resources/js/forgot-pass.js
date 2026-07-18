(function() {
    'use strict';

    const form = document.getElementById('reset-form');
    const emailInput = document.getElementById('email');
    const errorEl = document.getElementById('email-error');

    // Вспомогательная функция валидации email
    function isValidEmail(value) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value.trim());
    }

    // Очистка ошибки
    function clearError() {
        emailInput.classList.remove('error');
        errorEl.textContent = '';
    }

    // Показ ошибки
    function showError(message) {
        emailInput.classList.add('error');
        errorEl.textContent = message;
    }

    // Обработка отправки
    form.addEventListener('submit', function(e) {
        // Сбрасываем предыдущую ошибку
        clearError();

        const email = emailInput.value.trim();

        // Клиентская валидация — реальный запрос на сервер уходит только если она пройдена
        if (!email) {
            e.preventDefault();
            showError('Введите адрес электронной почты.');
            emailInput.focus();
            return;
        }
        if (!isValidEmail(email)) {
            e.preventDefault();
            showError('Введите корректный email (например, ivan@example.ru).');
            emailInput.focus();
            return;
        }

        // Валидно — даём форме реально отправиться на сервер (route('password.email')).
        // Ответ сервера определяет, что показать: страница вернётся с session('status')
        // при успехе или с ошибкой валидации, которую отрисует Blade.
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Отправка...';
    });

    // Очистка ошибки при вводе
    emailInput.addEventListener('input', function() {
        if (emailInput.classList.contains('error')) {
            clearError();
        }
    });

    // Дополнительно: при потере фокуса проверяем, но не показываем ошибку, если поле пустое,
    // чтобы не раздражать пользователя. Ошибка только при отправке.
})();
