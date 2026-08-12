// ===== ХРАНИЛИЩЕ ДАННЫХ (в памяти) =====
export const data = {
    docs: [
        { id: 1, title: 'ОСАГО', date: '2026-10-01', type: 'Страховка', status: 'ok', desc: 'Страховая компания Росгосстрах' },
        { id: 2, title: 'СТС', date: '2026-08-15', type: 'СТС', status: 'warning', desc: 'Свидетельство о регистрации ТС' },
        { id: 3, title: 'Диагностическая карта', date: '2026-12-20', type: 'Диагностика', status: 'ok', desc: 'Пройден техосмотр' },
        { id: 4, title: 'ПТС', date: '2025-01-01', type: 'ПТС', status: 'error', desc: 'Паспорт транспортного средства' },
    ],
    nextId: 100
};

// ===== ВСПОМОГАТЕЛЬНЫЕ ФУНКЦИИ =====
export function getNextId() {
    return data.nextId++;
}

export function showDetailToast(message) {
    const toast = document.getElementById('mkToast');
    if (!toast) return;
    const msgEl = toast.querySelector('.mk-toast__message');
    if (msgEl) msgEl.textContent = message;
    toast.classList.add('show');
    clearTimeout(window.toastTimer);
    window.toastTimer = setTimeout(() => toast.classList.remove('show'), 2500);
}

export function closeAllModals() {
    document.querySelectorAll('.mk-modal-overlay').forEach(overlay => {
        overlay.classList.remove('open');
    });
    document.body.style.overflow = '';
}

export function openModal(overlayId) {
    const overlay = document.getElementById(overlayId);
    if (overlay) {
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
}

const RU_MONTHS = [
    'января', 'февраля', 'марта', 'апреля', 'мая', 'июня',
    'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'
];

export function formatDate(dateStr) {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    if (isNaN(date.getTime())) return dateStr;
    const day = String(date.getDate()).padStart(2, '0');
    const month = RU_MONTHS[date.getMonth()];
    const year = date.getFullYear();
    return `${day} ${month} ${year}`;
}

export function getCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.content : '';
}

// ===== РЕНДЕРИНГ =====
export function handleDocDelete(e) {
    const card = e.currentTarget.closest('.mk-doc-card');
    const id = parseInt(card.dataset.id);
    if (confirm('Удалить документ?')) {
        data.docs = data.docs.filter(d => d.id !== id);
        renderDocs();
        showDetailToast('Документ удалён');
    }
}

export function renderDocs() {
    const list = document.getElementById('docsList');
    if (!list) return;
    if (data.docs.length === 0) {
        list.innerHTML = `<div class="mk-empty-state">Нет документов. Добавьте первый!</div>`;
        return;
    }
    const statusMap = {
        ok: 'Действует',
        warning: 'Истекает',
        error: 'Просрочен'
    };
    list.innerHTML = data.docs.map(d => `
      <div class="mk-doc-card" data-id="${d.id}">
        <div class="mk-doc-card__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="${d.status === 'ok' ? 'var(--mk-success)' : d.status === 'warning' ? 'var(--mk-warning)' : 'var(--mk-danger)'}" stroke-width="2"><rect x="2" y="3" width="20" height="18" rx="2"/><line x1="8" y1="9" x2="16" y2="9"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="12" y2="17"/></svg>
        </div>
        <div class="mk-doc-card__body">
          <div class="mk-doc-card__title">${d.title}</div>
          <div class="mk-doc-card__meta">${d.type} · ${d.date || 'Без срока'}</div>
          <span class="mk-doc-card__status ${d.status}">${statusMap[d.status] || d.status}</span>
        </div>
        <button class="mk-doc-card__delete" data-action="delete-doc" style="background:none;border:none;color:var(--mk-ink-3);cursor:pointer;font-size:18px;padding:4px;">✕</button>
      </div>
    `).join('');

    list.querySelectorAll('[data-action="delete-doc"]').forEach(btn => {
        btn.addEventListener('click', handleDocDelete);
    });
}

export function handleNoteDelete(e) {
    const card = e.currentTarget.closest('.mk-note-card');
    const params = new URLSearchParams({ note_id: card.dataset.id });
    fetch(`/api/notes?${params}`, {
        method: 'DELETE',
        credentials: 'same-origin',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken()
        }
    })
        .then(function (res) {
            return res.json().catch(function () { return {}; }).then(function (json) {
                return { ok: res.ok, data: json };
            });
        })
        .then(function (result) {
            const list = card.closest('#notesList');
            card.remove();
            if (list && !list.querySelector('.mk-note-card')) {
                list.innerHTML = `<div class="mk-empty-state">Нет заметок. Добавьте первую!</div>`;
            }
            showDetailToast('Заметка удалена');
        })
        .catch(function () {
            showDetailToast('Не удалось удалить заметку. Попробуйте позже.');
        });
}
export function handleReminderDelete(e) {
    const card = e.target.closest('[data-reminder-item]');
    const params = new URLSearchParams({ id: card.dataset.id });
    fetch(`/api/reminders?${params}`, {
        method: 'DELETE',
        credentials: 'same-origin',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken()
        }
    })
        .then(function (res) {
            return res.json().catch(function () { return {}; }).then(function (json) {
                return { ok: res.ok, data: json };
            });
        })
        .then(function (result) {
            showDetailToast('Напоминание удалено');
        })
        .catch(function () {
            showDetailToast('Не удалось удалить напоминание. Попробуйте позже.');
        });
}
function handleReminderUpdate(e,action) {
    const card = e.target.closest('[data-reminder-item]');
    const params = new URLSearchParams({ id: card.dataset.id,action: action });
    fetch(`/api/reminders?${params}`, {
        method: 'PATCH',
        credentials: 'same-origin',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken()
        }
    })
        .then(function (res) {
            return res.json().catch(function () { return {}; }).then(function (json) {
                return { ok: res.ok, data: json };
            });
        })
        .then(function (result) {
            loadReminders()
            showDetailToast('Напоминание перенесено');
        })
        .catch(function () {
            showDetailToast('Не удалось перенести напоминание. Попробуйте позже.');
        });
}

function renderNotes(notes) {
    const list = document.getElementById('notesList');
    if (!list) return;
    if (!notes || notes.length === 0) {
        list.innerHTML = `<div class="mk-empty-state">Нет заметок. Добавьте первую!</div>`;
        return;
    }
    list.innerHTML = notes.map(n => `
      <div class="mk-note-card" data-id="${n.id}">
        <div class="mk-note-card__title">${n.name}</div>
        <div class="mk-note-card__content">${n.comment || ''}</div>
        <button class="mk-note-card__delete" data-action="delete-note" title="Удалить">✕</button>
      </div>
    `).join('');

    list.querySelectorAll('[data-action="delete-note"]').forEach(btn => {
        btn.addEventListener('click', handleNoteDelete);
    });
}
const REMINDER_CYCLE_LABELS = {
    week: 'еженедельно',
    month: 'ежемесячно',
    month3: 'раз в 3 месяца',
    month6: 'раз в 6 месяцев',
    year: 'ежегодно'
};

export function renderReminders(reminders) {
    const list = document.getElementById('eventsList');
    if (!list) return;
    if (!reminders || reminders.length === 0) {
        list.innerHTML = `<div class="mk-empty-state">Напоминания не добавлены.</div>`;
        return;
    }

    list.innerHTML = reminders.map(n => {
        const typeLabel = n.type === 'periodic' ? 'Периодическое' : 'Напоминание';
        const periodLabel = n.cycle ? `<span class="mk-event-item__period">${REMINDER_CYCLE_LABELS[n.cycle] || n.cycle}</span>` : '';
        return `
        <div class="mk-event-item" data-reminder-item data-id="${n.id}">
          <span class="mk-event-item__date">${n.date_of_exec ? formatDate(n.date_of_exec) : 'Без даты'}</span>
          <span class="mk-event-item__desc">${n.name}</span>
          ${periodLabel}
          <span class="mk-event-item__tag" style="background:var(--mk-primary-soft);color:var(--mk-primary);">${typeLabel}</span>
          <div class="mk-event-item__actions">
            <button class="btn-done" data-reminder-action="done" title="Отметить выполненным">✓</button>
            <button class="btn-move" data-reminder-action="move" title="Перенести">↻</button>
            <button class="btn-delete" data-reminder-action="delete" title="Удалить">🗑</button>
          </div>
        </div>
      `;
    }).join('');
}
function remindersItems(){
    document.addEventListener('click', function (e) {
        const target = e.target.closest('[data-reminder-action]');
        if (!target) return;
        console.log(target.dataset.reminderAction);
        if (target.dataset.reminderAction === 'delete'){
            handleReminderDelete(e)
        }
        if (target.dataset.reminderAction === 'move' || target.dataset.reminderAction === 'done'){
            handleReminderUpdate(e,target.dataset.reminderAction)
        }
    });
}
// ===== ОБРАБОТЧИКИ МОДАЛОК: СОБЫТИЕ =====
export function handleEventTypeChange() {
    const group = document.getElementById('periodicityGroup');
    if (group) {
        group.style.display = document.getElementById('eventType').value === 'periodic' ? 'block' : 'none';
    }
}

export function initEventModal() {
    document.getElementById('addEventBtn')?.addEventListener('click', () => openModal('mkEventModalOverlay'));
    document.getElementById('mkEventModalClose')?.addEventListener('click', closeAllModals);
    document.getElementById('mkEventModalCancel')?.addEventListener('click', closeAllModals);
    document.getElementById('mkEventModalOverlay')?.addEventListener('click', function (e) {
        if (e.target === this) closeAllModals();
    });
    const form = document.getElementById('mkEventRemindersForm');
    if (form) {
        form.addEventListener('submit', handleRemindersSubmit);
    }
    document.getElementById('eventType')?.addEventListener('change', handleEventTypeChange);
}

// ===== ОБРАБОТЧИКИ МОДАЛОК: ДОКУМЕНТ =====
export function handleDocFormSubmit(e) {
    e.preventDefault();
    const title = document.getElementById('docTitle').value.trim();
    if (!title) { alert('Введите название'); return; }
    const date = document.getElementById('docDate').value;
    const type = document.getElementById('docType').value;
    const status = document.getElementById('docStatus').value;
    const desc = document.getElementById('docDesc').value.trim();
    data.docs.push({
        id: getNextId(),
        title,
        date,
        type,
        status,
        desc
    });
    renderDocs();
    closeAllModals();
    e.target.reset();
    showDetailToast('Документ добавлен');
}

export function initDocModal() {
    document.getElementById('addDocBtn')?.addEventListener('click', () => openModal('mkDocModalOverlay'));
    document.getElementById('mkDocModalClose')?.addEventListener('click', closeAllModals);
    document.getElementById('mkDocModalCancel')?.addEventListener('click', closeAllModals);
    document.getElementById('mkDocModalOverlay')?.addEventListener('click', function (e) {
        if (e.target === this) closeAllModals();
    });
    document.getElementById('mkDocForm')?.addEventListener('submit', handleDocFormSubmit);
}

// ===== ОБРАБОТЧИКИ МОДАЛОК: ЗАМЕТКА =====
export function handleNoteFormSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);
    const payload = Object.fromEntries(formData.entries());
    fetch('/api/notes', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken()
        },
        body: JSON.stringify(payload)
    })
        .then(function (res) {
            return res.json().catch(function () { return {}; }).then(function (json) {
                return { ok: res.ok, data: json };
            });
        })
        .then(function (result) {
            if (!result.ok || !result.data.success) {
                return Promise.reject(result.data);
            }
            closeAllModals();
            loadNotes();
            showDetailToast('Заметка добавлена');
            form.reset();
        })
        .catch(function () {
            showDetailToast('Не удалось добавить заметку. Попробуйте ещё раз.');
        });
}
// ===== ОБРАБОТЧИКИ МОДАЛОК: НАПОМИНАНИЕ =====
export function handleRemindersSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);
    const payload = Object.fromEntries(formData.entries());
    fetch('/api/reminders', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken()
        },
        body: JSON.stringify(payload)
    })
        .then(function (res) {
            return res.json().catch(function () { return {}; }).then(function (json) {
                return { ok: res.ok, data: json };
            });
        })
        .then(function (result) {
            if (!result.ok || !result.data.success) {
                return Promise.reject(result.data);
            }
            closeAllModals();
            loadReminders()
            showDetailToast('Заметка добавлена');
            form.reset();
        })
        .catch(function () {
            showDetailToast('Не удалось добавить заметку. Попробуйте ещё раз.');
        });
}
function loadNotes(){
    const form = document.querySelector('[data-notes-form]');
    if (!form){
        return;
    }
    const carId = form.querySelector('input[name="car_id"]').value;
    const params = new URLSearchParams({ car_id: carId });
    fetch(`/api/notes?${params}`, {
        method: 'GET',
        credentials: 'same-origin',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken()
        }
    })
        .then(function (res) {
            return res.json().catch(function () { return {}; }).then(function (json) {
                return { ok: res.ok, data: json };
            });
        })
        .then(function (result) {
            console.log(result.data);
            renderNotes(result.data.notes);
        })
        .catch(function () {
            showDetailToast('Не удалось получить заметки. Попробуйте позже.');
        });
}
function loadReminders(){
    const form = document.querySelector('[data-reminder-form]');
    if (!form){
        return;
    }
    const carId = form.querySelector('input[name="car_id"]').value;
    const params = new URLSearchParams({ car_id: carId });
    fetch(`/api/reminders?${params}`, {
        method: 'GET',
        credentials: 'same-origin',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken()
        }
    })
        .then(function (res) {
            return res.json().catch(function () { return {}; }).then(function (json) {
                return { ok: res.ok, data: json };
            });
        })
        .then(function (result) {
            console.log(result.data);
            renderReminders(result.data.remind);
        })
        .catch(function () {
            showDetailToast('Не удалось получить напоминания. Попробуйте позже.');
        });
}
export function initNoteModal() {
    document.getElementById('addNoteBtn')?.addEventListener('click', () => openModal('mkNoteModalOverlay'));
    document.getElementById('mkNoteModalClose')?.addEventListener('click', closeAllModals);
    document.getElementById('mkNoteModalCancel')?.addEventListener('click', closeAllModals);
    document.getElementById('mkNoteModalOverlay')?.addEventListener('click', function (e) {
        if (e.target === this) closeAllModals();
    });

    const form = document.getElementById('mkNoteForm');
    if (form) {
        form.addEventListener('submit', handleNoteFormSubmit);
    }
}

// ===== САЙДБАР: БУРГЕР И СВЁРТКА =====
export function initDetailBurger() {
    const burger = document.getElementById('mkBurger');
    const scrim = document.getElementById('mkScrim');
    const body = document.body;

    burger?.addEventListener('click', () => body.classList.toggle('nav-open'));
    scrim?.addEventListener('click', () => body.classList.remove('nav-open'));
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            body.classList.remove('nav-open');
            closeAllModals();
        }
    });
    document.querySelectorAll('.mk-navitem').forEach(item => {
        item.addEventListener('click', () => { if (window.innerWidth <= 900) body.classList.remove('nav-open'); });
    });
}

export function setCollapsed(state) {
    const COLLAPSED_KEY = 'mk-collapsed';
    document.body.classList.toggle('is-collapsed', state);
    try { localStorage.setItem(COLLAPSED_KEY, state ? 'true' : 'false'); } catch (_) {}
}

export function initDetailCollapse() {
    const COLLAPSED_KEY = 'mk-collapsed';
    const collapseBtn = document.getElementById('mkCollapse');

    try {
        if (localStorage.getItem(COLLAPSED_KEY) === 'true') document.body.classList.add('is-collapsed');
    } catch (_) {}
    collapseBtn?.addEventListener('click', () => setCollapsed(!document.body.classList.contains('is-collapsed')));
}

// ===== FAB И МОДАЛКА ЗАПИСИ =====
export function openRecordModal() {
    const modalOverlay = document.getElementById('mkModalOverlay');
    modalOverlay?.classList.add('open');
    document.body.style.overflow = 'hidden';
}

export function handleRecordFormSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);
    const payload = Object.fromEntries(formData.entries());

    const activeType = form.querySelector('[data-type].active');
    if (activeType) payload.type = activeType.dataset.type;

    console.log(payload)
    fetch('/api/car-history', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken()
        },
        body: JSON.stringify(payload)
    })
        .then(function (res) {
            return res.json().catch(function () { return {}; }).then(function (json) {
                return { ok: res.ok, data: json };
            });
        })
        .then(function (result) {
            if (!result.ok || !result.data.success) {
                return Promise.reject(result.data);
            }
            closeAllModals();
            loadRecords();
            showDetailToast('Запись добавлена');
            form.reset();
        })
        .catch(function () {
            showDetailToast('Не удалось добавить запись. Попробуйте ещё раз.');
        });
}

export function initRecordModal() {
    const fab = document.getElementById('mkFab');
    const addRecordBtn = document.getElementById('addRecordBtn');
    const modalOverlay = document.getElementById('mkModalOverlay');
    const modalClose = document.getElementById('mkModalClose');
    const modalCancel = document.getElementById('mkModalCancel');

    fab?.addEventListener('click', openRecordModal);
    addRecordBtn?.addEventListener('click', openRecordModal);
    modalClose?.addEventListener('click', closeAllModals);
    modalCancel?.addEventListener('click', closeAllModals);
    modalOverlay?.addEventListener('click', function (e) {
        if (e.target === this) closeAllModals();
    });

    document.getElementById('mkRecordForm')?.addEventListener('submit', handleRecordFormSubmit);
}

// ===== СЕГМЕНТЫ (в модалке записи) =====
export function initSegments() {
    document.querySelectorAll('.mk-segment__item').forEach(btn => {
        btn.addEventListener('click', function () {
            this.closest('.mk-segment').querySelectorAll('.mk-segment__item').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
}

// ===== ПОЛЯ ФОРМЫ ЗАПИСИ В ЗАВИСИМОСТИ ОТ ТИПА =====
// Для каждого типа записи показываем только те поля, которые имеют смысл.
const RECORD_TYPE_FIELDS = {
    service: ['date', 'odometer', 'cost', 'place', 'photo'],
    repair: ['date', 'odometer', 'cost', 'place', 'photo'],
    buy: ['date', 'cost', 'place', 'photo'],
    fuel: ['date', 'odometer', 'cost', 'place', 'volume', 'photo'],
    note: ['date', 'photo'],
};

const RECORD_PLACE_LABELS = {
    service: 'Автосервис',
    repair: 'Автосервис',
    buy: 'Магазин',
    fuel: 'АЗС',
};

const RECORD_PLACE_PLACEHOLDERS = {
    service: 'Название СТО',
    repair: 'Название СТО',
    buy: 'Название магазина',
    fuel: 'Название АЗС',
};

export function applyRecordTypeFields(type) {
    const fields = RECORD_TYPE_FIELDS[type] || RECORD_TYPE_FIELDS.service;

    document.querySelectorAll('#mkRecordForm [data-record-field]').forEach(group => {
        group.hidden = !fields.includes(group.dataset.recordField);
    });

    document.querySelectorAll('#mkRecordForm .mk-form-row').forEach(row => {
        const groups = row.querySelectorAll('.mk-form-group');
        row.hidden = groups.length > 0 && Array.from(groups).every(g => g.hidden);
    });

    const placeLabel = document.getElementById('recordPlaceLabel');
    const placeInput = document.getElementById('recordPlace');
    if (placeLabel) placeLabel.textContent = RECORD_PLACE_LABELS[type] || 'Место';
    if (placeInput) placeInput.placeholder = RECORD_PLACE_PLACEHOLDERS[type] || 'Название места';
}

export function initRecordTypeFields() {
    const segment = document.getElementById('mkTypeSegment');
    if (!segment) return;

    applyRecordTypeFields(segment.querySelector('.mk-segment__item.active')?.dataset.type || 'service');

    segment.querySelectorAll('.mk-segment__item').forEach(btn => {
        btn.addEventListener('click', function () {
            applyRecordTypeFields(this.dataset.type);
        });
    });
}

// ===== ЧИПЫ =====
export function initDetailChips() {
    document.querySelectorAll('.mk-chips').forEach(group => {
        const chips = group.querySelectorAll('.mk-chip');
        chips.forEach(chip => {
            chip.addEventListener('click', function () {
                chips.forEach(c => { c.classList.remove('active'); c.setAttribute('aria-selected', 'false'); });
                this.classList.add('active');
                this.setAttribute('aria-selected', 'true');
            });
        });
    });
}

// ===== ДРОПЗОНА =====
export function initDropzone() {
    const dropzone = document.getElementById('mkDropzone');
    if (!dropzone) return;

    const fileInput = dropzone.querySelector('input[type="file"]');
    dropzone.addEventListener('click', () => fileInput?.click());
    fileInput?.addEventListener('change', function () {
        if (this.files.length) {
            dropzone.querySelector('span').textContent = 'Выбрано: ' + this.files.length + ' файл(ов)';
        }
    });
}

// ===== ЛЕНТА ЗАПИСЕЙ: ЗАГРУЗКА И РЕНДЕРИНГ =====
function escapeHtml(value) {
    return String(value ?? '').replace(/[&<>"']/g, ch => ({
        '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
    }[ch]));
}

function formatThousands(value) {
    const num = Math.round(Number(value) || 0);
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
}

const RECORD_ICON_CLOCK = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>';
const RECORD_ICON_PIN = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>';
const RECORD_ICON_DROP = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22c4.4 0 8-3.6 8-8 0-4-8-12-8-12S4 10 4 14c0 4.4 3.6 8 8 8z"/></svg>';

const RECORD_TYPE_META = {
    service: {
        tag: 'ТО',
        icon: '<svg viewBox="0 0 24 24" fill="none" stroke="{COLOR}" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>',
    },
    repair: {
        tag: 'Поломка',
        icon: '<svg viewBox="0 0 24 24" fill="none" stroke="{COLOR}" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94z"/></svg>',
    },
    buy: {
        tag: 'Покупка',
        icon: '<svg viewBox="0 0 24 24" fill="none" stroke="{COLOR}" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>',
    },
    fuel: {
        tag: 'Заправка',
        icon: '<svg viewBox="0 0 24 24" fill="none" stroke="{COLOR}" stroke-width="2"><path d="M3 22h12"/><path d="M18 2l-3 3"/><path d="M10 10l3-3"/><path d="M6 14l3-3"/><path d="M13 6l3-3"/><path d="M6 22h12"/><path d="M9 7l3-3"/></svg>',
    },
    note: {
        tag: 'Заметка',
        icon: '<svg viewBox="0 0 24 24" fill="none" stroke="{COLOR}" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="13" y2="17"/></svg>',
    },
};

function buildRecordCard(r) {
    const meta = RECORD_TYPE_META[r.type] || RECORD_TYPE_META.service;
    const title = escapeHtml(r.name);
    const desc = r.comment ? `<div class="mk-record__desc">${escapeHtml(r.comment)}</div>` : '';
    const dateLabel = formatDate(r.date);
    const mileageLabel = r.mileage > 0 ? `${formatThousands(r.mileage)} км` : '';
    const placeLabel = r.place ? escapeHtml(r.place) : '';
    const volumeLabel = r.volume > 0 ? `${formatThousands(r.volume)} л` : '';
    const costLabel = r.price > 0 ? `${formatThousands(r.price)} ₽` : '';

    const metaItems = [
        mileageLabel && `<span><span class="mk-record__icon-text">${RECORD_ICON_CLOCK} ${mileageLabel}</span></span>`,
        placeLabel && `<span><span class="mk-record__icon-text">${RECORD_ICON_PIN} ${placeLabel}</span></span>`,
        volumeLabel && `<span><span class="mk-record__icon-text">${RECORD_ICON_DROP} ${volumeLabel}</span></span>`,
    ].filter(Boolean).join('');
    const metaline = metaItems ? `<div class="mk-record__metaline">${metaItems}</div>` : '';

    return `
      <article class="mk-record" style="--rail: var(--mk-c-${r.type});" data-record data-id="${r.id}" data-type="${r.type}"
               data-tag="${escapeHtml(meta.tag)}" data-title="${title}" data-desc="${escapeHtml(r.comment || '')}"
               data-date="${escapeHtml(dateLabel)}" data-mileage="${escapeHtml(mileageLabel)}"
               data-place="${placeLabel}" data-volume="${escapeHtml(volumeLabel)}" data-cost="${escapeHtml(costLabel)}">
          <div class="mk-record__ic" style="--ic-bg: var(--mk-c-${r.type}-soft);">${meta.icon.replace('{COLOR}', `var(--mk-c-${r.type})`)}</div>
          <div class="mk-record__main">
              <div class="mk-record__title">${title} <span class="mk-tag" style="--tag-bg: var(--mk-c-${r.type}-soft); --tag-color: var(--mk-c-${r.type});">${escapeHtml(meta.tag)}</span></div>
              ${desc}
              ${metaline}
          </div>
          <div class="mk-record__side">
              ${costLabel ? `<span class="mk-record__cost">${costLabel}</span>` : ''}
              <span class="mk-record__date">${escapeHtml(dateLabel)}</span>
              <button class="mk-record__more" data-record-menu-toggle type="button" aria-haspopup="true" aria-expanded="false" aria-label="Ещё">⋯</button>
          </div>
      </article>
    `;
}

function renderRecords(records) {
    const feed = document.getElementById('recordsFeed');
    if (!feed) return;
    if (!records || records.length === 0) {
        feed.innerHTML = `<div class="mk-empty-state">Записей пока нет. Добавьте первую!</div>`;
        return;
    }
    feed.innerHTML = records.map(buildRecordCard).join('');

    const countEl = document.querySelector('.mk-section-head__title .count');
    if (countEl) countEl.textContent = records.length;
}

function loadRecords() {
    const form = document.getElementById('mkRecordForm');
    if (!form) return;
    const carId = form.querySelector('input[name="car_id"]').value;
    const params = new URLSearchParams({ car_id: carId });
    fetch(`/api/car-history?${params}`, {
        method: 'GET',
        credentials: 'same-origin',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken()
        }
    })
        .then(function (res) {
            return res.json().catch(function () { return {}; }).then(function (json) {
                return { ok: res.ok, data: json };
            });
        })
        .then(function (result) {
            renderRecords(result.data.records);
        })
        .catch(function () {
            showDetailToast('Не удалось получить историю. Попробуйте позже.');
        });
}

// ===== ЛЕНТА ЗАПИСЕЙ: МЕНЮ «⋯» И ПОДРОБНЫЙ ПРОСМОТР =====
let activeDetailRecord = null;
let activeMenuRecord = null;
let activeMenuToggle = null;

function closeAllRecordDropdowns() {
    const menu = document.getElementById('mkRecordMenu');
    if (menu) {
        menu.classList.remove('open');
        menu.style.display = '';
    }
    activeMenuToggle?.setAttribute('aria-expanded', 'false');
    activeMenuRecord = null;
    activeMenuToggle = null;
}

function positionRecordMenu(toggle) {
    const menu = document.getElementById('mkRecordMenu');
    if (!menu) return;
    const btnRect = toggle.getBoundingClientRect();
    menu.style.display = 'flex';
    const menuRect = menu.getBoundingClientRect();
    let left = btnRect.right - menuRect.width;
    let top = btnRect.bottom + 4;
    left = Math.max(8, Math.min(left, window.innerWidth - menuRect.width - 8));
    if (top + menuRect.height > window.innerHeight - 8) {
        top = btnRect.top - menuRect.height - 4;
    }
    menu.style.left = `${left}px`;
    menu.style.top = `${top}px`;
}

function openRecordMenu(toggle) {
    const menu = document.getElementById('mkRecordMenu');
    if (!menu) return;
    const article = toggle.closest('[data-record]');
    const willOpen = activeMenuToggle !== toggle || !menu.classList.contains('open');
    closeAllRecordDropdowns();
    if (!willOpen) return;
    activeMenuRecord = article;
    activeMenuToggle = toggle;
    positionRecordMenu(toggle);
    menu.classList.add('open');
    toggle.setAttribute('aria-expanded', 'true');
}

function decrementRecordsCount() {
    const countEl = document.querySelector('.mk-section-head__title .count');
    if (!countEl) return;
    const current = parseInt(countEl.textContent, 10);
    if (!isNaN(current) && current > 0) countEl.textContent = current - 1;
}

function deleteRecord(article) {
    if (!article) return;
    if (!confirm('Удалить запись?')) return;
    if (activeDetailRecord === article) {
        closeAllModals();
        activeDetailRecord = null;
    }
    article.remove();
    decrementRecordsCount();
    showDetailToast('Запись удалена');
}

function populateRecordDetail(article) {
    const d = article.dataset;
    const setRow = (fieldId, rowField, value) => {
        const valueEl = document.getElementById(fieldId);
        const row = document.querySelector(`#mkRecordDetailModal [data-detail-field="${rowField}"]`);
        if (valueEl) valueEl.textContent = value || '';
        if (row) row.hidden = !value;
    };

    document.getElementById('mkDetailTitle').textContent = d.title || 'Запись';
    const tagEl = document.getElementById('mkDetailTag');
    if (tagEl) {
        tagEl.textContent = d.tag || '';
        tagEl.style.setProperty('--tag-bg', `var(--mk-c-${d.type}-soft)`);
        tagEl.style.setProperty('--tag-color', `var(--mk-c-${d.type})`);
    }
    const descEl = document.getElementById('mkDetailDesc');
    if (descEl) descEl.textContent = d.desc || '';

    setRow('mkDetailDate', 'date', d.date);
    setRow('mkDetailMileage', 'mileage', d.mileage);
    setRow('mkDetailPlace', 'place', d.place);
    setRow('mkDetailVolume', 'volume', d.volume);
    setRow('mkDetailCost', 'cost', d.cost);
}

export function openRecordDetail(article) {
    if (!article) return;
    activeDetailRecord = article;
    populateRecordDetail(article);
    openModal('mkRecordDetailOverlay');
}

export function initRecordFeed() {
    const feed = document.getElementById('recordsFeed');
    if (!feed) return;

    feed.addEventListener('click', function (e) {
        const toggle = e.target.closest('[data-record-menu-toggle]');
        if (toggle) {
            e.stopPropagation();
            openRecordMenu(toggle);
            return;
        }

        const article = e.target.closest('[data-record]');
        if (article) openRecordDetail(article);
    });

    document.getElementById('mkRecordMenu')?.addEventListener('click', function (e) {
        const actionBtn = e.target.closest('[data-record-action]');
        if (!actionBtn) return;
        e.stopPropagation();
        const article = activeMenuRecord;
        closeAllRecordDropdowns();
        if (actionBtn.dataset.recordAction === 'delete') {
            deleteRecord(article);
        } else if (actionBtn.dataset.recordAction === 'edit') {
            showDetailToast('Редактирование скоро будет доступно');
        }
    });

    window.addEventListener('resize', closeAllRecordDropdowns);
    window.addEventListener('scroll', closeAllRecordDropdowns, true);
    document.addEventListener('click', closeAllRecordDropdowns);
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeAllRecordDropdowns();
    });

    document.getElementById('mkRecordDetailClose')?.addEventListener('click', closeAllModals);
    document.getElementById('mkRecordDetailCloseBtn')?.addEventListener('click', closeAllModals);
    document.getElementById('mkRecordDetailOverlay')?.addEventListener('click', function (e) {
        if (e.target === this) closeAllModals();
    });
    document.getElementById('mkRecordDetailDelete')?.addEventListener('click', () => deleteRecord(activeDetailRecord));
}

// ===== ИНИЦИАЛИЗАЦИЯ ДАТ =====
export function initDateDefaults() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('recordDate')?.setAttribute('value', today);
    document.getElementById('eventDate')?.setAttribute('value', today);
    document.getElementById('docDate')?.setAttribute('value', today);
}

export function initDetailPage() {
    remindersItems();
    initEventModal();
    initDocModal();
    initNoteModal();
    initDetailBurger();
    initDetailCollapse();
    initRecordModal();
    initSegments();
    initRecordTypeFields();
    initDetailChips();
    initRecordFeed();
    initDropzone();
    initDateDefaults();

    renderDocs();

    loadNotes();
    loadReminders();
    loadRecords();
}

document.addEventListener('DOMContentLoaded', function () {
    initDetailPage();
});
