// Логика, специфичная только для страницы «Настройки».
// Сайдбар (сворачивание/drawer), поиск и его хоткей — общие для всех
// страниц и уже инициализируются в app.js, здесь не дублируются.
import { fetchJson, showToast } from './app.js';

(function() {
    'use strict';

    // ===== ВКЛАДКИ =====
    const tabs = document.querySelectorAll('.mk-tab');
    const contents = document.querySelectorAll('.mk-tab-content');

    function switchTab(tabId) {
        tabs.forEach(tab => {
            const isActive = tab.dataset.tab === tabId;
            tab.classList.toggle('active', isActive);
            tab.setAttribute('aria-selected', isActive);
        });
        contents.forEach(content => {
            const isActive = content.id === `tab-${tabId}`;
            content.classList.toggle('active', isActive);
        });
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const tabId = this.dataset.tab;
            switchTab(tabId);
            localStorage.setItem('mk-settings-tab', tabId);
        });
    });

    if (tabs.length) {
        const savedTab = localStorage.getItem('mk-settings-tab') || 'profile';
        switchTab(savedTab);
    }

    // ===== КАСТОМНЫЙ ИНТЕРВАЛ ТО =====
    const toRadios = document.querySelectorAll('input[name="to-interval"]');
    const customRow = document.getElementById('custom-to-row');

    toRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'custom') {
                customRow.style.display = 'grid';
            } else {
                customRow.style.display = 'none';
            }
        });
    });

    // Проверяем, если выбрано custom при загрузке
    const checkedCustom = document.querySelector('input[name="to-interval"]:checked');
    if (checkedCustom && checkedCustom.value === 'custom') {
        customRow.style.display = 'grid';
    }

    // ===== ДЕМОНСТРАЦИЯ: КНОПКИ СОХРАНЕНИЯ =====
    // Кнопка изменения пароля (вкладка "Безопасность") исключена — для неё
    // ниже подключён рабочий обработчик с реальным запросом к /api/settings.
    document.querySelectorAll('.mk-form-actions .mk-btn--primary').forEach(btn => {
        if (btn.closest('#tab-security')) return;
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const originalText = this.textContent;
            this.textContent = '✅ Сохранено!';
            this.style.background = 'var(--mk-success)';
            this.style.borderColor = 'var(--mk-success)';
            setTimeout(() => {
                this.textContent = originalText;
                this.style.background = '';
                this.style.borderColor = '';
            }, 2000);
        });
    });

    // ===== УДАЛЕНИЕ АККАУНТА =====
    document.querySelector('.mk-danger-zone .mk-btn')?.addEventListener('click', function() {
        if (!confirm('Вы уверены, что хотите удалить аккаунт? Это действие необратимо.')) {
            return;
        }

        fetchJson('/api/settings', { method: 'DELETE' })
            .then(function (result) {
                if (!result.ok || !result.data.success) {
                    return Promise.reject(result.data);
                }
                window.location.href = '/';
            })
            .catch(function () {
                alert('Не удалось удалить аккаунт. Попробуйте позже.');
            });
    });

    // ===== ИЗМЕНЕНИЕ ПАРОЛЯ =====
    document.querySelector('#tab-security .mk-btn--primary')?.addEventListener('click', function(e) {
        e.preventDefault();

        const currentInput = document.getElementById('current-password');
        const newInput = document.getElementById('new-password');
        const confirmInput = document.getElementById('confirm-password');

        const current = currentInput.value;
        const newPass = newInput.value;
        const confirm = confirmInput.value;

        if (!current || !newPass || !confirm) {
            showToast('Пожалуйста, заполните все поля.', 'error');
            return;
        }
        if (newPass.length < 8) {
            showToast('Пароль должен содержать не менее 8 символов.', 'error');
            return;
        }
        if (newPass !== confirm) {
            showToast('Пароли не совпадают.', 'error');
            return;
        }

        const btn = this;
        const originalText = btn.textContent;
        btn.disabled = true;

        fetchJson('/api/settings', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                current_password: current,
                password: newPass,
                password_confirmation: confirm,
            }),
        })
            .then(function (result) {
                if (!result.ok || !result.data.success) return Promise.reject(result.data);

                showToast('Пароль изменён', 'success');
                btn.textContent = 'Пароль изменён!';
                btn.style.background = 'var(--mk-success)';
                btn.style.borderColor = 'var(--mk-success)';
                [currentInput, newInput, confirmInput].forEach(function (input) {
                    input.value = '';
                });

                setTimeout(() => {
                    btn.textContent = originalText;
                    btn.style.background = '';
                    btn.style.borderColor = '';
                }, 2000);
            })
            .catch(function (data) {
                const message = data && data.errors
                    ? Object.values(data.errors).flat().join(' ')
                    : 'Не удалось изменить пароль. Проверьте текущий пароль и попробуйте снова.';
                showToast(message, 'error');
            })
            .finally(function () {
                btn.disabled = false;
            });
    });

    // ===== ДЕМОНСТРАЦИЯ: ЗАВЕРШИТЬ ВСЕ СЕССИИ =====
    document.querySelector('.mk-session-list + .mk-btn')?.addEventListener('click', function() {
        if (confirm('Завершить все активные сессии, кроме текущей?')) {
            const items = document.querySelectorAll('.mk-session-item');
            items.forEach((item, index) => {
                if (index > 0) {
                    item.style.opacity = '0.4';
                    item.style.textDecoration = 'line-through';
                    item.querySelector('.mk-session-item__status').textContent = 'Завершена';
                    item.querySelector('.mk-session-item__status').style.color = 'var(--mk-ink-3)';
                }
            });
            alert('Все сессии завершены.');
        }
    });

})();
