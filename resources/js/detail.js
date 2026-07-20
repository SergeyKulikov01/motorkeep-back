// ===== ХРАНИЛИЩЕ ДАННЫХ (в памяти) =====
export const data = {
    events: [
        { id: 1, title: 'Замена масла и фильтров', date: '2026-08-15', type: 'periodic', periodicity: 'каждые 6 месяцев', desc: 'Моторное масло 5W-30, фильтры', completed: false },
        { id: 2, title: 'Проверить давление в шинах', date: '2026-07-01', type: 'periodic', periodicity: 'ежемесячно', desc: 'Рекомендуемое давление 2.2 бар', completed: false },
        { id: 3, title: 'Проверить уровень масла', date: '2026-06-25', type: 'periodic', periodicity: 'еженедельно', desc: 'Уровень должен быть между MIN и MAX', completed: false },
        { id: 4, title: 'Проверить антифриз', date: '2026-06-20', type: 'periodic', periodicity: 'ежемесячно', desc: 'Уровень в расширительном бачке', completed: false },
        { id: 5, title: 'Замена резины (лето → зима)', date: '2026-10-15', type: 'event', periodicity: '', desc: 'Переобувка в шиномонтаже', completed: false },
    ],
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

export function getCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.content : '';
}

// ===== РЕНДЕРИНГ =====
export function handleEventDone(e) {
    const item = e.currentTarget.closest('.mk-event-item');
    const id = parseInt(item.dataset.id);
    const event = data.events.find(ev => ev.id === id);
    if (event) {
        event.completed = true;
        renderEvents();
        showDetailToast('Отмечено как выполненное');
    }
}

export function handleEventDelete(e) {
    const item = e.currentTarget.closest('.mk-event-item');
    const id = parseInt(item.dataset.id);
    if (confirm('Удалить событие?')) {
        data.events = data.events.filter(ev => ev.id !== id);
        renderEvents();
        showDetailToast('Событие удалено');
    }
}

export function renderEvents() {
    const list = document.getElementById('eventsList');
    if (!list) return;
    const incomplete = data.events.filter(e => !e.completed);
    const completed = data.events.filter(e => e.completed);
    const allEvents = [...incomplete, ...completed];

    if (allEvents.length === 0) {
        list.innerHTML = `<div class="mk-empty-state">Нет событий. Добавьте первое!</div>`;
        return;
    }

    list.innerHTML = allEvents.map(e => {
        const typeLabel = e.type === 'periodic' ? 'Периодическое' : e.type === 'reminder' ? 'Напоминание' : 'Событие';
        const periodLabel = e.periodicity ? `<span class="mk-event-item__period">${e.periodicity}</span>` : '';
        const completedClass = e.completed ? 'completed' : '';
        return `
        <div class="mk-event-item ${completedClass}" data-id="${e.id}">
          <span class="mk-event-item__date">${e.date || 'Без даты'}</span>
          <span class="mk-event-item__desc">${e.title}</span>
          ${periodLabel}
          <span class="mk-event-item__tag" style="background:var(--mk-primary-soft);color:var(--mk-primary);">${typeLabel}</span>
          <div class="mk-event-item__actions">
            ${!e.completed ? `<button class="btn-done" data-action="done" title="Выполнено">✓</button>` : ''}
            <button class="btn-delete" data-action="delete" title="Удалить">🗑</button>
          </div>
        </div>
      `;
    }).join('');

    list.querySelectorAll('[data-action="done"]').forEach(btn => {
        btn.addEventListener('click', handleEventDone);
    });

    list.querySelectorAll('[data-action="delete"]').forEach(btn => {
        btn.addEventListener('click', handleEventDelete);
    });
}

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

export function renderNotes(notes) {
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

// ===== ОБРАБОТЧИКИ МОДАЛОК: СОБЫТИЕ =====
export function handleEventFormSubmit(e) {
    e.preventDefault();
    const title = document.getElementById('eventTitle').value.trim();
    if (!title) { alert('Введите название'); return; }
    const date = document.getElementById('eventDate').value;
    const type = document.getElementById('eventType').value;
    const periodicity = document.getElementById('eventPeriodicity').value;
    const desc = document.getElementById('eventDesc').value.trim();
    data.events.push({
        id: getNextId(),
        title,
        date,
        type,
        periodicity: type === 'periodic' ? periodicity : '',
        desc,
        completed: false
    });
    renderEvents();
    closeAllModals();
    e.target.reset();
    showDetailToast('Событие добавлено');
}

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
    document.getElementById('mkEventForm')?.addEventListener('submit', handleEventFormSubmit);
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
    const title = document.getElementById('recordTitle').value.trim();
    if (!title) { alert('Введите название'); return; }
    closeAllModals();
    e.target.reset();
    showDetailToast('Сохранено');
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

// ===== ИНИЦИАЛИЗАЦИЯ ДАТ =====
export function initDateDefaults() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('recordDate')?.setAttribute('value', today);
    document.getElementById('eventDate')?.setAttribute('value', today);
    document.getElementById('docDate')?.setAttribute('value', today);
}

export function initDetailPage() {
    initEventModal();
    initDocModal();
    initNoteModal();
    initDetailBurger();
    initDetailCollapse();
    initRecordModal();
    initSegments();
    initDetailChips();
    initDropzone();
    initDateDefaults();

    renderEvents();
    renderDocs();

    loadNotes();
}

document.addEventListener('DOMContentLoaded', function () {
    initDetailPage();
});
