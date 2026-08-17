import { showToast } from './app.js';

// Сворачивание сайдбара и мобильный бургер уже обрабатываются
// общим app.js (он подключается на всех страницах, включая дашборд).

// ---------- ПОПОВЕРЫ ----------
export function togglePopover(popover, event) {
    event.stopPropagation();
    const isOpen = popover.classList.contains('mk-popover--open');
    document.querySelectorAll('.mk-popover').forEach(p => p.classList.remove('mk-popover--open'));
    if (!isOpen) {
        popover.classList.add('mk-popover--open');
    }
}

export function handleDocumentClickForPopovers(e) {
    const wrappers = document.querySelectorAll('.mk-popover-wrapper');
    let inside = false;
    wrappers.forEach(w => {
        if (w.contains(e.target)) inside = true;
    });
    if (!inside) {
        document.querySelectorAll('.mk-popover').forEach(p => p.classList.remove('mk-popover--open'));
    }
}

export function initPopovers() {
    const notifBtn = document.getElementById('notif-btn');
    const notifPopover = document.getElementById('notif-popover');
    const profileBtn = document.getElementById('profile-btn');
    const profilePopover = document.getElementById('profile-popover');

    document.addEventListener('click', handleDocumentClickForPopovers);

    if (notifBtn && notifPopover) {
        notifBtn.addEventListener('click', function (e) {
            togglePopover(notifPopover, e);
        });
    }

    if (profileBtn && profilePopover) {
        profileBtn.addEventListener('click', function (e) {
            togglePopover(profilePopover, e);
        });
    }
}

// ---------- МОДАЛКА ----------
export function openModal(title, contentId) {
    const popupTitle = document.getElementById('popup-title');
    const popupBody = document.getElementById('popup-body');
    const overlay = document.getElementById('popup-overlay');

    popupTitle.textContent = title;
    const children = popupBody.querySelectorAll('[id^="popup-content-"]');
    children.forEach(el => el.style.display = 'none');
    const target = document.getElementById(contentId);
    if (target) target.style.display = 'block';
    overlay.classList.add('mk-overlay--open');
}

export function closeModal() {
    const overlay = document.getElementById('popup-overlay');
    overlay.classList.remove('mk-overlay--open');
}

export function initPopupModal() {
    const overlay = document.getElementById('popup-overlay');
    const closeBtn = document.getElementById('popup-close');

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (overlay) {
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) closeModal();
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && overlay.classList.contains('mk-overlay--open')) closeModal();
        });
    }
}

export function initShowAllLinks() {
    document.querySelectorAll('.js-show-all').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const target = this.dataset.target;
            let title = '', contentId = '';
            if (target === 'activity') {
                title = 'Все действия';
                contentId = 'popup-content-activity';
            } else if (target === 'reminders') {
                title = 'Все напоминания';
                contentId = 'popup-content-reminders';
            } else {
                title = 'Информация';
                contentId = 'popup-content-default';
            }
            openModal(title, contentId);
        });
    });
}

// ---------- КАРТОЧКИ СВОДКИ ----------
export function initSummaryCards() {
    const popupBody = document.getElementById('popup-body');
    const popupTitle = document.getElementById('popup-title');
    const overlay = document.getElementById('popup-overlay');

    document.querySelectorAll('.js-summary-card').forEach(card => {
        card.addEventListener('click', function () {
            const label = this.querySelector('.mk-garage-summary__label')?.textContent || 'Информация';
            const value = this.querySelector('.mk-garage-summary__value')?.textContent || '';
            const meta = this.querySelector('.mk-garage-summary__meta')?.textContent || '';
            popupTitle.textContent = label;
            const defaultContent = document.getElementById('popup-content-default');
            if (defaultContent) {
                defaultContent.innerHTML = `<p><strong>${value}</strong></p><p>${meta}</p><p>Подробности можно посмотреть в соответствующем разделе.</p>`;
                const children = popupBody.querySelectorAll('[id^="popup-content-"]');
                children.forEach(el => el.style.display = 'none');
                defaultContent.style.display = 'block';
                overlay.classList.add('mk-overlay--open');
            }
        });
    });
}

// ---------- БЫСТРЫЕ ДЕЙСТВИЯ ----------
export function initQuickActions() {
    document.querySelectorAll('.mk-quick-action').forEach(btn => {
        btn.addEventListener('click', function () {
            const type = this.dataset.type;
            const typeNames = { service: 'ТО', fuel: 'Заправку', repair: 'Ремонт', note: 'Заметку' };
            const name = typeNames[type] || type;
            showToast(`Добавить запись "${name}"`, 'info');
        });
    });
}

// ---------- НАПОМИНАНИЯ ----------
export function updateReminderCount() {
    const reminderList = document.getElementById('reminder-list');
    const reminderCount = document.getElementById('reminder-count');
    const items = reminderList.querySelectorAll('.mk-reminder-item:not(.mk-reminder-item--done)');
    reminderCount.textContent = items.length;
}

export function handleReminderDone(item) {
    item.classList.toggle('mk-reminder-item--done');
    const title = item.querySelector('.mk-reminder-item__title')?.textContent || 'Напоминание';
    if (item.classList.contains('mk-reminder-item--done')) {
        showToast(`✅ "${title}" выполнено!`, 'success');
    } else {
        showToast(`↩️ "${title}" возвращено в список`, 'info');
    }
    updateReminderCount();
}

export function handleReminderPostpone(item) {
    const meta = item.querySelector('.mk-reminder-item__meta');
    if (!meta) return;

    const match = meta.textContent.match(/\d{2}\.\d{2}\.\d{4}/);
    if (match) {
        const dateParts = match[0].split('.');
        const dateObj = new Date(parseInt(dateParts[2]), parseInt(dateParts[1]) - 1, parseInt(dateParts[0]));
        dateObj.setDate(dateObj.getDate() + 1);
        const newDate = String(dateObj.getDate()).padStart(2, '0') + '.' + String(dateObj.getMonth() + 1).padStart(2, '0') + '.' + dateObj.getFullYear();
        meta.textContent = meta.textContent.replace(/\d{2}\.\d{2}\.\d{4}/, newDate);
        showToast(`⏩ Дата перенесена на ${newDate}`, 'warning');
    } else {
        const now = new Date();
        now.setDate(now.getDate() + 1);
        const newDate = String(now.getDate()).padStart(2, '0') + '.' + String(now.getMonth() + 1).padStart(2, '0') + '.' + now.getFullYear();
        meta.textContent += ` (перенесено на ${newDate})`;
        showToast(`⏩ Дата перенесена на ${newDate}`, 'warning');
    }
}

export function handleReminderListClick(e) {
    const target = e.target.closest('button');
    if (!target) return;
    const item = target.closest('.mk-reminder-item');
    if (!item) return;

    if (target.classList.contains('mk-reminder-item__done')) {
        handleReminderDone(item);
        return;
    }

    if (target.classList.contains('mk-reminder-item__postpone')) {
        handleReminderPostpone(item);
    }
}

export function initReminders() {
    const reminderList = document.getElementById('reminder-list');
    if (!reminderList) return;

    reminderList.addEventListener('click', handleReminderListClick);
    updateReminderCount();
}

export function initDashboardPage() {
    initPopovers();
    initPopupModal();
    initShowAllLinks();
    initSummaryCards();
    initQuickActions();
    initReminders();

    console.log('Гараж инициализирован');
}

document.addEventListener('DOMContentLoaded', function () {
    initDashboardPage();
});
