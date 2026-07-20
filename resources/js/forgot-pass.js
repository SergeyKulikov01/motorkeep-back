// Вспомогательная функция валидации email
export function isValidEmail(value) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value.trim());
}

// Очистка ошибки
export function clearError(emailInput, errorEl) {
    emailInput.classList.remove('error');
    errorEl.textContent = '';
}

// Показ ошибки
export function showError(emailInput, errorEl, message) {
    emailInput.classList.add('error');
    errorEl.textContent = message;
}

// Обработка отправки
export function handleForgotPassSubmit(e) {
    const form = document.getElementById('reset-form');
    const emailInput = document.getElementById('email');
    const errorEl = document.getElementById('email-error');

    // Сбрасываем предыдущую ошибку
    clearError(emailInput, errorEl);

    const email = emailInput.value.trim();

    // Клиентская валидация — реальный запрос на сервер уходит только если она пройдена
    if (!email) {
        e.preventDefault();
        showError(emailInput, errorEl, 'Введите адрес электронной почты.');
        emailInput.focus();
        return;
    }
    if (!isValidEmail(email)) {
        e.preventDefault();
        showError(emailInput, errorEl, 'Введите корректный email (например, ivan@example.ru).');
        emailInput.focus();
        return;
    }

    // Валидно — даём форме реально отправиться на сервер (route('password.email')).
    // Ответ сервера определяет, что показать: страница вернётся с session('status')
    // при успехе или с ошибкой валидации, которую отрисует Blade.
    const submitBtn = form.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Отправка...';
}

export function handleForgotPassInput() {
    const emailInput = document.getElementById('email');
    const errorEl = document.getElementById('email-error');
    if (emailInput.classList.contains('error')) {
        clearError(emailInput, errorEl);
    }
}

export function initForgotPassPage() {
    const form = document.getElementById('reset-form');
    const emailInput = document.getElementById('email');
    const errorEl = document.getElementById('email-error');

    // Скрипт грузится на всех страницах через общий app.js —
    // выполняем логику только там, где есть форма запроса сброса пароля.
    if (!form || !emailInput || !errorEl) {
        return;
    }

    form.addEventListener('submit', handleForgotPassSubmit);
    emailInput.addEventListener('input', handleForgotPassInput);

    // Дополнительно: при потере фокуса проверяем, но не показываем ошибку, если поле пустое,
    // чтобы не раздражать пользователя. Ошибка только при отправке.
}

document.addEventListener('DOMContentLoaded', function () {
    initForgotPassPage();
});