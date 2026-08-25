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
// Поля и подписи по типу записи — как на детальной странице авто
// (RECORD_TYPE_FIELDS в detail.js), но без сегмент-переключателя: тип
// задаётся самой кнопкой быстрого действия.
const QUICK_RECORD_TITLES = {
    service: 'Новая запись «ТО»',
    repair: 'Новая запись «Ремонт»',
    fuel: 'Новая запись «Заправка»',
    buy: 'Новая запись «Покупка»',
};

const QUICK_RECORD_NAME_PLACEHOLDERS = {
    service: 'Например: Замена масла',
    repair: 'Например: Замена тормозных колодок',
    fuel: 'Например: АИ-95',
    buy: 'Например: Комплект ковриков',
};

const QUICK_RECORD_TYPE_FIELDS = {
    service: ['odometer', 'cost', 'place'],
    repair: ['odometer', 'cost', 'place'],
    fuel: ['odometer', 'cost', 'place', 'volume'],
    buy: ['cost', 'place'],
};

const QUICK_RECORD_PLACE_LABELS = { service: 'Автосервис', repair: 'Автосервис', fuel: 'АЗС', buy: 'Магазин' };
const QUICK_RECORD_PLACE_PLACEHOLDERS = { service: 'Название СТО', repair: 'Название СТО', fuel: 'Название АЗС', buy: 'Название магазина' };

export function initQuickActions() {
    document.querySelectorAll('.mk-quick-action').forEach(btn => {
        btn.addEventListener('click', function () {
            const type = this.dataset.type;
            if (QUICK_RECORD_TITLES[type]) {
                openQuickRecordModal(type);
                return;
            }
            showToast(`Добавить запись "${type}"`, 'info');
        });
    });
}

// ---------- БЫСТРОЕ ДОБАВЛЕНИЕ ЗАПИСИ ----------
function applyQuickRecordTypeFields(type) {
    const fields = QUICK_RECORD_TYPE_FIELDS[type] || [];

    document.querySelectorAll('#quick-record-form [data-record-field]').forEach(group => {
        group.hidden = !fields.includes(group.dataset.recordField);
    });

    document.querySelectorAll('#quick-record-form .mk-form-row').forEach(row => {
        const groups = row.querySelectorAll('.mk-form-group');
        row.hidden = groups.length > 0 && Array.from(groups).every(g => g.hidden);
    });

    const placeLabel = document.getElementById('quickRecordPlaceLabel');
    const placeInput = document.getElementById('quickRecordPlace');
    if (placeLabel) placeLabel.textContent = QUICK_RECORD_PLACE_LABELS[type] || 'Место';
    if (placeInput) placeInput.placeholder = QUICK_RECORD_PLACE_PLACEHOLDERS[type] || 'Название места';

    const nameInput = document.getElementById('quickRecordName');
    if (nameInput) nameInput.placeholder = QUICK_RECORD_NAME_PLACEHOLDERS[type] || '';
}

function openQuickRecordModal(type) {
    const overlay = document.getElementById('quick-record-overlay');
    const form = document.getElementById('quick-record-form');
    const carSelect = document.getElementById('quickRecordCar');
    const mileageInput = document.getElementById('quickRecordMileage');
    if (!overlay || !form) return;

    form.reset();
    document.getElementById('quickRecordType').value = type;
    document.getElementById('quick-record-title').textContent = QUICK_RECORD_TITLES[type] || 'Новая запись';
    document.getElementById('quickRecordDate').value = new Date().toISOString().split('T')[0];
    applyQuickRecordTypeFields(type);
    if (carSelect && mileageInput) {
        mileageInput.value = carSelect.selectedOptions[0]?.dataset.mileage || '';
    }

    overlay.classList.add('mk-overlay--open');
}

function closeQuickRecordModal() {
    document.getElementById('quick-record-overlay')?.classList.remove('mk-overlay--open');
}

function handleQuickRecordSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const payload = Object.fromEntries(new FormData(form).entries());

    fetchReminderApi('/api/car-history', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
    })
        .then(function (result) {
            if (!result.ok || !result.data.success) return Promise.reject(result.data);
            closeQuickRecordModal();
            showToast('Запись добавлена', 'success');
            setTimeout(() => window.location.reload(), 600);
        })
        .catch(function () {
            showToast('Не удалось добавить запись. Попробуйте позже.', 'error');
        });
}

function initQuickRecordModal() {
    const overlay = document.getElementById('quick-record-overlay');
    const form = document.getElementById('quick-record-form');
    const carSelect = document.getElementById('quickRecordCar');
    const mileageInput = document.getElementById('quickRecordMileage');
    if (!overlay || !form) return;

    document.getElementById('quick-record-close')?.addEventListener('click', closeQuickRecordModal);
    document.getElementById('quick-record-cancel')?.addEventListener('click', closeQuickRecordModal);
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeQuickRecordModal();
    });
    carSelect?.addEventListener('change', function () {
        if (mileageInput) mileageInput.value = this.selectedOptions[0]?.dataset.mileage || '';
    });
    form.addEventListener('submit', handleQuickRecordSubmit);
}

// ---------- НАПОМИНАНИЯ ----------
function getCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.content : '';
}

// Та же обёртка над fetch, что и в detail.js: CSRF-заголовок + безопасный
// разбор JSON-ответа (даже если тело пустое).
function fetchReminderApi(url, options = {}) {
    const { headers, ...rest } = options;
    return fetch(url, {
        credentials: 'same-origin',
        ...rest,
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
            ...headers,
        },
    }).then(function (res) {
        return res.json().catch(function () { return {}; }).then(function (json) {
            return { ok: res.ok, data: json };
        });
    });
}

export function updateReminderCount() {
    const reminderList = document.getElementById('reminder-list');
    const reminderCount = document.getElementById('reminder-count');
    const items = reminderList.querySelectorAll('.mk-reminder-item:not(.mk-reminder-item--done)');
    reminderCount.textContent = items.length;
}

// Отправляет действие на /api/reminders (тот же PATCH, что и на детальной
// странице авто — action=done|move). Бэкенд сам пересчитывает дату/статус,
// поэтому после успешного ответа просто перезагружаем список напоминаний.
function sendReminderAction(item, action, pendingLabel) {
    const params = new URLSearchParams({ id: item.dataset.id, action });

    fetchReminderApi(`/api/reminders?${params}`, { method: 'PATCH' })
        .then(function (result) {
            if (!result.ok) return Promise.reject(result.data);
            showToast(pendingLabel, action === 'done' ? 'success' : 'warning');
            setTimeout(() => window.location.reload(), 600);
        })
        .catch(function () {
            showToast('Не удалось обновить напоминание. Попробуйте позже.', 'error');
        });
}

export function handleReminderDone(item) {
    const title = item.querySelector('.mk-reminder-item__title')?.textContent || 'Напоминание';
    sendReminderAction(item, 'done', `«${title}» отмечено выполненным`);
}

export function handleReminderPostpone(item) {
    const title = item.querySelector('.mk-reminder-item__title')?.textContent || 'Напоминание';
    sendReminderAction(item, 'move', `«${title}» перенесено`);
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
    initQuickRecordModal();
    initReminders();

    console.log('Гараж инициализирован');
}

document.addEventListener('DOMContentLoaded', function () {
    initDashboardPage();
});
