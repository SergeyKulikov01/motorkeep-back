// Логика, специфичная только для страницы «Настройки».
// Сайдбар (сворачивание/drawer), поиск и его хоткей — общие для всех
// страниц и уже инициализируются в app.js, здесь не дублируются.
import { fetchJson } from './app.js';

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
    document.querySelectorAll('.mk-form-actions .mk-btn--primary').forEach(btn => {
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

    // ===== ДЕМОНСТРАЦИЯ: ИЗМЕНЕНИЕ ПАРОЛЯ =====
    document.querySelector('#tab-security .mk-btn--primary')?.addEventListener('click', function(e) {
        e.preventDefault();
        const current = document.getElementById('current-password').value;
        const newPass = document.getElementById('new-password').value;
        const confirm = document.getElementById('confirm-password').value;

        if (!current || !newPass || !confirm) {
            alert('Пожалуйста, заполните все поля.');
            return;
        }
        if (newPass.length < 8) {
            alert('Пароль должен содержать не менее 8 символов.');
            return;
        }
        if (newPass !== confirm) {
            alert('Пароли не совпадают.');
            return;
        }

        const originalText = this.textContent;
        this.textContent = '✅ Пароль изменён!';
        this.style.background = 'var(--mk-success)';
        this.style.borderColor = 'var(--mk-success)';
        setTimeout(() => {
            this.textContent = originalText;
            this.style.background = '';
            this.style.borderColor = '';
        }, 2000);
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
