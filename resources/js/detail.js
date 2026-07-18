(function() {
    'use strict';

    // ===== ХРАНИЛИЩЕ ДАННЫХ (в памяти) =====
    const data = {
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
        notes: [
            { id: 1, title: 'План по обслуживанию', content: '1. Заменить масло до 90 000 км\n2. Проверить тормозные диски\n3. Запланировать замену ГРМ' },
            { id: 2, title: 'Идеи для апгрейда', content: '— Установить камеру заднего вида\n— Заменить магнитолу на CarPlay\n— Сделать шумоизоляцию дверей' },
        ],
        nextId: 100
    };

    // ===== ВСПОМОГАТЕЛЬНЫЕ ФУНКЦИИ =====
    function getNextId() {
        return data.nextId++;
    }

    function showToast(message) {
        const toast = document.getElementById('mkToast');
        if (!toast) return;
        const msgEl = toast.querySelector('.mk-toast__message');
        if (msgEl) msgEl.textContent = message;
        toast.classList.add('show');
        clearTimeout(window.toastTimer);
        window.toastTimer = setTimeout(() => toast.classList.remove('show'), 2500);
    }

    function closeAllModals() {
        document.querySelectorAll('.mk-modal-overlay').forEach(overlay => {
            overlay.classList.remove('open');
        });
        document.body.style.overflow = '';
    }

    function openModal(overlayId) {
        const overlay = document.getElementById(overlayId);
        if (overlay) {
            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
    }

    // ===== РЕНДЕРИНГ =====
    function renderEvents() {
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

        // Обработчики кнопок
        list.querySelectorAll('[data-action="done"]').forEach(btn => {
            btn.addEventListener('click', function() {
                const item = this.closest('.mk-event-item');
                const id = parseInt(item.dataset.id);
                const event = data.events.find(e => e.id === id);
                if (event) {
                    event.completed = true;
                    renderEvents();
                    showToast('Отмечено как выполненное');
                }
            });
        });

        list.querySelectorAll('[data-action="delete"]').forEach(btn => {
            btn.addEventListener('click', function() {
                const item = this.closest('.mk-event-item');
                const id = parseInt(item.dataset.id);
                if (confirm('Удалить событие?')) {
                    data.events = data.events.filter(e => e.id !== id);
                    renderEvents();
                    showToast('Событие удалено');
                }
            });
        });
    }

    function renderDocs() {
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
            btn.addEventListener('click', function() {
                const card = this.closest('.mk-doc-card');
                const id = parseInt(card.dataset.id);
                if (confirm('Удалить документ?')) {
                    data.docs = data.docs.filter(d => d.id !== id);
                    renderDocs();
                    showToast('Документ удалён');
                }
            });
        });
    }

    function renderNotes() {
        const list = document.getElementById('notesList');
        if (!list) return;
        if (data.notes.length === 0) {
            list.innerHTML = `<div class="mk-empty-state">Нет заметок. Добавьте первую!</div>`;
            return;
        }
        list.innerHTML = data.notes.map(n => `
      <div class="mk-note-card" data-id="${n.id}">
        <div class="mk-note-card__title">${n.title}</div>
        <div class="mk-note-card__content">${n.content || ''}</div>
        <button class="mk-note-card__delete" data-action="delete-note" title="Удалить">✕</button>
      </div>
    `).join('');

        list.querySelectorAll('[data-action="delete-note"]').forEach(btn => {
            btn.addEventListener('click', function() {
                const card = this.closest('.mk-note-card');
                const id = parseInt(card.dataset.id);
                if (confirm('Удалить заметку?')) {
                    data.notes = data.notes.filter(n => n.id !== id);
                    renderNotes();
                    showToast('Заметка удалена');
                }
            });
        });
    }

    // ===== ОБРАБОТЧИКИ МОДАЛОК =====
    // Событие
    document.getElementById('addEventBtn')?.addEventListener('click', () => openModal('mkEventModalOverlay'));
    document.getElementById('mkEventModalClose')?.addEventListener('click', closeAllModals);
    document.getElementById('mkEventModalCancel')?.addEventListener('click', closeAllModals);
    document.getElementById('mkEventModalOverlay')?.addEventListener('click', function(e) {
        if (e.target === this) closeAllModals();
    });

    document.getElementById('mkEventForm')?.addEventListener('submit', function(e) {
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
        this.reset();
        showToast('Событие добавлено');
    });

    // Показать/скрыть периодичность
    document.getElementById('eventType')?.addEventListener('change', function() {
        const group = document.getElementById('periodicityGroup');
        if (group) {
            group.style.display = this.value === 'periodic' ? 'block' : 'none';
        }
    });

    // Документ
    document.getElementById('addDocBtn')?.addEventListener('click', () => openModal('mkDocModalOverlay'));
    document.getElementById('mkDocModalClose')?.addEventListener('click', closeAllModals);
    document.getElementById('mkDocModalCancel')?.addEventListener('click', closeAllModals);
    document.getElementById('mkDocModalOverlay')?.addEventListener('click', function(e) {
        if (e.target === this) closeAllModals();
    });

    document.getElementById('mkDocForm')?.addEventListener('submit', function(e) {
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
        this.reset();
        showToast('Документ добавлен');
    });

    // Заметка
    document.getElementById('addNoteBtn')?.addEventListener('click', () => openModal('mkNoteModalOverlay'));
    document.getElementById('mkNoteModalClose')?.addEventListener('click', closeAllModals);
    document.getElementById('mkNoteModalCancel')?.addEventListener('click', closeAllModals);
    document.getElementById('mkNoteModalOverlay')?.addEventListener('click', function(e) {
        if (e.target === this) closeAllModals();
    });

    function addNotes(){
        const form = document.getElementById('mkNoteForm');
        if (!form){
            return;
        }
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const data = new FormData(form);
            console.log(data);
            return;
            const title = document.getElementById('noteTitle').value.trim();
            if (!title) { alert('Введите заголовок'); return; }
            const content = document.getElementById('noteContent').value.trim();
            data.notes.push({
                id: getNextId(),
                title,
                content
            });
            renderNotes();
            closeAllModals();
            this.reset();
            showToast('Заметка добавлена');
        });
    }

    // ===== ОСТАЛЬНАЯ ЛОГИКА (сайдбар, бургер, FAB, модалка записи) =====
    // ... (вставьте весь код из предыдущей версии: бургер, свёртка, FAB, модалка записи)
    // Для краткости я оставлю только ключевые, но вы можете скопировать их из предыдущего ответа

    // Бургер
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

    // Свёртка
    const collapseBtn = document.getElementById('mkCollapse');
    const COLLAPSED_KEY = 'mk-collapsed';
    function setCollapsed(state) {
        body.classList.toggle('is-collapsed', state);
        try { localStorage.setItem(COLLAPSED_KEY, state ? 'true' : 'false'); } catch (_) {}
    }
    try {
        if (localStorage.getItem(COLLAPSED_KEY) === 'true') body.classList.add('is-collapsed');
    } catch (_) {}
    collapseBtn?.addEventListener('click', () => setCollapsed(!body.classList.contains('is-collapsed')));

    // FAB и модалка записи
    const fab = document.getElementById('mkFab');
    const addRecordBtn = document.getElementById('addRecordBtn');
    const modalOverlay = document.getElementById('mkModalOverlay');
    const modalClose = document.getElementById('mkModalClose');
    const modalCancel = document.getElementById('mkModalCancel');

    function openRecordModal() {
        modalOverlay?.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    fab?.addEventListener('click', openRecordModal);
    addRecordBtn?.addEventListener('click', openRecordModal);
    modalClose?.addEventListener('click', closeAllModals);
    modalCancel?.addEventListener('click', closeAllModals);
    modalOverlay?.addEventListener('click', function(e) {
        if (e.target === this) closeAllModals();
    });

    // Сегменты в модалке записи
    document.querySelectorAll('.mk-segment__item').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.mk-segment').querySelectorAll('.mk-segment__item').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Форма записи
    document.getElementById('mkRecordForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const title = document.getElementById('recordTitle').value.trim();
        if (!title) { alert('Введите название'); return; }
        closeAllModals();
        this.reset();
        showToast('Сохранено');
    });

    // Чипы
    document.querySelectorAll('.mk-chips').forEach(group => {
        const chips = group.querySelectorAll('.mk-chip');
        chips.forEach(chip => {
            chip.addEventListener('click', function() {
                chips.forEach(c => { c.classList.remove('active'); c.setAttribute('aria-selected', 'false'); });
                this.classList.add('active');
                this.setAttribute('aria-selected', 'true');
            });
        });
    });

    // Дропзона
    const dropzone = document.getElementById('mkDropzone');
    if (dropzone) {
        const fileInput = dropzone.querySelector('input[type="file"]');
        dropzone.addEventListener('click', () => fileInput?.click());
        fileInput?.addEventListener('change', function() {
            if (this.files.length) {
                dropzone.querySelector('span').textContent = 'Выбрано: ' + this.files.length + ' файл(ов)';
            }
        });
    }

    // Инициализация дат
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('recordDate')?.setAttribute('value', today);
    document.getElementById('eventDate')?.setAttribute('value', today);
    document.getElementById('docDate')?.setAttribute('value', today);

    // ===== ПЕРВИЧНЫЙ РЕНДЕРИНГ =====
    renderEvents();
    renderDocs();
    renderNotes();

    addNotes();
})();
