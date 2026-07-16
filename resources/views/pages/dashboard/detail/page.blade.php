@include('layouts.public.landing-head')
<body>
<!-- СКРИМ -->
<div class="mk-scrim" id="mkScrim"></div>

<!-- ====== САЙДБАР (без изменений) ====== -->
@include('layouts.private.sidebar')

<!-- ====== ОБОЛОЧКА ====== -->
<div class="mk-shell" id="mkShell">
    <!-- ХЕДЕР (без изменений) -->
    @include('layouts.private.header', ['pageTitle' => 'Мой гараж', 'pageCrumb' => $car->brand->name .' '. $car->model->name])
    <!-- ОСНОВНОЙ КОНТЕНТ -->
    <main class="mk-main" id="mkMain">
        <div class="mk-container">
            <!-- HERO (без изменений) -->
            <section class="mk-hero" aria-label="Информация об автомобиле">
                <div class="mk-hero__media">
                    <div class="mk-hero__silhouette" role="img" aria-label="Силуэт BMW 320i">
                        <svg viewBox="0 0 400 200" fill="none">
                            <rect x="60" y="40" width="280" height="100" rx="8" fill="#EAF1FF" stroke="#2F6BFF" stroke-width="2"/>
                            <rect x="100" y="100" width="200" height="30" rx="4" fill="#2F6BFF" opacity="0.2"/>
                            <circle cx="140" cy="140" r="24" stroke="#2F6BFF" stroke-width="2" fill="#fff"/>
                            <circle cx="260" cy="140" r="24" stroke="#2F6BFF" stroke-width="2" fill="#fff"/>
                            <line x1="80" y1="70" x2="320" y2="70" stroke="#2F6BFF" stroke-width="2" stroke-dasharray="4 4"/>
                            <rect x="180" y="80" width="40" height="16" rx="4" fill="#2F6BFF" opacity="0.3"/>
                        </svg>
                    </div>
                    <div class="mk-hero__plate">{{ $car->plate_number . ' ' . $car->plate_region}} RUS</div>
                </div>
                <div class="mk-hero__body">
                    <div class="mk-eyebrow">Автомобиль</div>
                    <h1 class="mk-hero__title">{{$car->brand->name .' '. $car->model->name}}</h1>
                    <div class="mk-hero__sub">Седан, {{$car->year}}, {{$car->engine_volume}} л, 13123 л.с.</div>
                    <div class="mk-odo">
                        <span class="mk-odo__label">Пробег</span>
                        <span class="mk-odo__value">{{$car->mileage_formatted}}<span>км</span></span>
                        <div class="mk-odo__track" style="--pct: {{$mileagePercent}}%;"></div>
                    </div>
                    <div class="mk-hero__meta">
                        @if($car->vin)
                            <div class="mk-hero__meta-item">
                                <span class="mk-hero__meta-label">VIN</span>
                                <span class="mk-hero__meta-value mk-mono">{{$car->vin}}</span>
                            </div>
                        @endif
                        <div class="mk-hero__meta-item">
                            <span class="mk-hero__meta-label">В гараже с</span>
                            <span class="mk-hero__meta-value">{{ $car->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Статистика (без изменений) -->
            <section class="mk-stats-grid" aria-label="Статистика автомобиля">
                <div class="mk-stat">
                    <div class="mk-stat__head">
                        <span class="mk-stat__ic" style="--ic-bg: var(--mk-primary-soft);">
                            <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-primary)" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                        </span>
                        <span class="mk-stat__label">Всего записей</span>
                    </div>
                    <div class="mk-stat__value">48</div>
                    <div class="mk-stat__delta ok">+12 за месяц</div>
                </div>
                <div class="mk-stat">
                    <div class="mk-stat__head">
                        <span class="mk-stat__ic" style="--ic-bg: var(--mk-c-buy-soft);">
                            <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-buy)" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </span>
                        <span class="mk-stat__label">Расходы за год</span>
                    </div>
                    <div class="mk-stat__value">214 600 ₽</div>
                    <div class="mk-stat__delta up">+8% к прошлому</div>
                </div>
                <div class="mk-stat">
                    <div class="mk-stat__head">
                        <span class="mk-stat__ic" style="--ic-bg: var(--mk-c-fuel-soft);">
                            <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-fuel)" stroke-width="2"><path d="M3 22h12"/><path d="M18 2l-3 3"/><path d="M10 10l3-3"/><path d="M6 14l3-3"/><path d="M13 6l3-3"/><path d="M6 22h12"/><path d="M9 7l3-3"/></svg>
                        </span>
                        <span class="mk-stat__label">Средний расход</span>
                    </div>
                    <div class="mk-stat__value">8.4 л/100 км</div>
                    <div class="mk-stat__delta ok">−0.3 л с прошлого</div>
                </div>
                <div class="mk-stat">
                    <div class="mk-stat__head">
                        <span class="mk-stat__ic" style="--ic-bg: var(--mk-c-service-soft);">
                            <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-service)" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                        </span>
                        <span class="mk-stat__label">Следующее ТО</span>
                    </div>
                    <div class="mk-stat__value">через 1 580 км</div>
                    <div class="mk-stat__delta ok">до 92 000 км</div>
                </div>
            </section>

            <!-- ДОКУМЕНТЫ (динамические) -->
            <section class="mk-docs-events">
                <div class="mk-docs">
                    <div class="mk-section-head">
                        <h2 class="mk-section-head__title">Документы</h2>
                        <div class="mk-section-head__spacer"></div>
                        <button class="mk-btn mk-btn--ghost mk-btn--sm" id="addDocBtn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            Добавить
                        </button>
                    </div>
                    <div class="mk-docs-grid" id="docsList">
                        <!-- Документы добавляются через JS -->
                    </div>
                </div>

                <!-- СОБЫТИЯ (динамические) -->
                <div class="mk-events">
                    <div class="mk-section-head">
                        <h2 class="mk-section-head__title">Ближайшие события</h2>
                        <div class="mk-section-head__spacer"></div>
                        <button class="mk-btn mk-btn--ghost mk-btn--sm" id="addEventBtn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            Добавить
                        </button>
                    </div>
                    <div class="mk-events-list" id="eventsList">
                        <!-- События добавляются через JS -->
                    </div>
                </div>
            </section>

            <!-- ЗАМЕТКИ (динамические) -->
            <section class="mk-section" aria-label="Заметки">
                <div class="mk-section-head">
                    <h2 class="mk-section-head__title">Заметки</h2>
                    <div class="mk-section-head__spacer"></div>
                    <button class="mk-btn mk-btn--ghost mk-btn--sm" id="addNoteBtn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Добавить
                    </button>
                </div>
                <div class="mk-notes-grid" id="notesList">
                    <!-- Заметки добавляются через JS -->
                </div>
            </section>

            <!-- История (сокращённая версия) -->
            <section class="mk-section" aria-label="История записей">
                <div class="mk-section-head">
                    <h2 class="mk-section-head__title">История <span class="count">48</span></h2>
                    <div class="mk-section-head__spacer"></div>
                    <button class="mk-btn mk-btn--primary mk-btn--sm" id="addRecordBtn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Запись
                    </button>
                </div>
                <div class="mk-chips" role="tablist">
                    <button class="mk-chip active" role="tab">Все</button>
                    <button class="mk-chip" role="tab"><span class="dot" style="background:var(--mk-c-service);"></span> ТО</button>
                    <button class="mk-chip" role="tab"><span class="dot" style="background:var(--mk-c-repair);"></span> Поломки</button>
                    <button class="mk-chip" role="tab"><span class="dot" style="background:var(--mk-c-buy);"></span> Покупки</button>
                    <button class="mk-chip" role="tab"><span class="dot" style="background:var(--mk-c-fuel);"></span> Заправки</button>
                </div>
                <div class="mk-feed">
                    <article class="mk-record" style="--rail: var(--mk-c-service);">
                        <div class="mk-record__ic" style="--ic-bg: var(--mk-c-service-soft);">
                            <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-service)" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                        </div>
                        <div class="mk-record__main">
                            <div class="mk-record__title">Замена масла и фильтров <span class="mk-tag" style="--tag-bg: var(--mk-c-service-soft); --tag-color: var(--mk-c-service);">ТО</span></div>
                            <div class="mk-record__desc">Моторное масло 5W-30, масляный фильтр, воздушный фильтр</div>
                            <div class="mk-record__metaline">
                                <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> 82 400 км</span></span>
                                <span><span class="mk-record__icon-text"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> Автосервис «Техно»</span></span>
                            </div>
                        </div>
                        <div class="mk-record__side">
                            <span class="mk-record__cost">8 200 ₽</span>
                            <span class="mk-record__date">12 июня 2026</span>
                            <button class="mk-record__more" aria-label="Ещё">⋯</button>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </main>

    <!-- ФУТЕР -->
    @include('layouts.private.footer')
</div>

<!-- FAB -->
<button class="mk-fab" id="mkFab" aria-label="Добавить запись">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    <span class="mk-fab__label">Добавить запись</span>
</button>

<!-- МОДАЛКА ДОБАВЛЕНИЯ ЗАПИСИ (без изменений) -->
<div class="mk-modal-overlay" id="mkModalOverlay">
    <div class="mk-modal" id="mkModal">
        <div class="mk-modal__header">
            <h2>Новая запись</h2>
            <button class="mk-modal__close" id="mkModalClose">✕</button>
        </div>
        <form class="mk-modal__form" id="mkRecordForm">
            <div class="mk-form-group">
                <label class="mk-form-label">Тип записи</label>
                <div class="mk-segment" id="mkTypeSegment">
                    <button type="button" class="mk-segment__item active" data-type="service">ТО</button>
                    <button type="button" class="mk-segment__item" data-type="repair">Поломка</button>
                    <button type="button" class="mk-segment__item" data-type="buy">Покупка</button>
                    <button type="button" class="mk-segment__item" data-type="fuel">Заправка</button>
                    <button type="button" class="mk-segment__item" data-type="note">Заметка</button>
                </div>
            </div>
            <div class="mk-form-group">
                <label class="mk-form-label" for="recordTitle">Название <span class="mk-form-required">*</span></label>
                <input class="mk-input" id="recordTitle" type="text" placeholder="Например: Замена масла" required>
            </div>
            <div class="mk-form-row">
                <div class="mk-form-group">
                    <label class="mk-form-label" for="recordDate">Дата</label>
                    <input class="mk-input" id="recordDate" type="date">
                </div>
                <div class="mk-form-group">
                    <label class="mk-form-label" for="recordOdometer">Пробег, км</label>
                    <input class="mk-input mk-input--right" id="recordOdometer" type="text" inputmode="numeric" placeholder="86 420">
                </div>
            </div>
            <div class="mk-form-row">
                <div class="mk-form-group">
                    <label class="mk-form-label" for="recordCost">Сумма, ₽</label>
                    <input class="mk-input mk-input--right" id="recordCost" type="text" inputmode="numeric" placeholder="0">
                </div>
                <div class="mk-form-group">
                    <label class="mk-form-label" for="recordPlace">Место</label>
                    <input class="mk-input" id="recordPlace" type="text" placeholder="Название СТО">
                </div>
            </div>
            <div class="mk-form-group">
                <label class="mk-form-label" for="recordDesc">Описание</label>
                <textarea class="mk-textarea" id="recordDesc" rows="3" placeholder="Дополнительные детали…"></textarea>
            </div>
            <div class="mk-form-group">
                <label class="mk-form-label">Фото / Чек</label>
                <div class="mk-dropzone" id="mkDropzone">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                    <span>Перетащите файл или кликните</span>
                    <input type="file" accept="image/*" multiple>
                </div>
            </div>
            <div class="mk-modal__footer">
                <button type="button" class="mk-btn mk-btn--ghost" id="mkModalCancel">Отмена</button>
                <button type="submit" class="mk-btn mk-btn--primary">Сохранить</button>
            </div>
        </form>
    </div>
</div>

<!-- МОДАЛКА ДОБАВЛЕНИЯ СОБЫТИЯ -->
<div class="mk-modal-overlay" id="mkEventModalOverlay">
    <div class="mk-modal" id="mkEventModal">
        <div class="mk-modal__header">
            <h2>Новое событие / напоминание</h2>
            <button class="mk-modal__close" id="mkEventModalClose">✕</button>
        </div>
        <form class="mk-modal__form" id="mkEventForm">
            <div class="mk-form-group">
                <label class="mk-form-label" for="eventTitle">Название <span class="mk-form-required">*</span></label>
                <input class="mk-input" id="eventTitle" type="text" placeholder="Например: Проверить давление в шинах" required>
            </div>
            <div class="mk-form-row">
                <div class="mk-form-group">
                    <label class="mk-form-label" for="eventDate">Дата</label>
                    <input class="mk-input" id="eventDate" type="date">
                </div>
                <div class="mk-form-group">
                    <label class="mk-form-label" for="eventType">Тип</label>
                    <select class="mk-input" id="eventType">
                        <option value="event">Событие</option>
                        <option value="reminder">Напоминание</option>
                        <option value="periodic" selected>Периодическое</option>
                    </select>
                </div>
            </div>
            <div class="mk-form-group" id="periodicityGroup">
                <label class="mk-form-label" for="eventPeriodicity">Периодичность</label>
                <select class="mk-input" id="eventPeriodicity">
                    <option value="еженедельно">Еженедельно</option>
                    <option value="ежемесячно">Ежемесячно</option>
                    <option value="каждые 3 месяца">Каждые 3 месяца</option>
                    <option value="каждые 6 месяцев">Каждые 6 месяцев</option>
                    <option value="ежегодно">Ежегодно</option>
                </select>
            </div>
            <div class="mk-form-group">
                <label class="mk-form-label" for="eventDesc">Описание</label>
                <textarea class="mk-textarea" id="eventDesc" rows="2" placeholder="Дополнительная информация…"></textarea>
            </div>
            <div class="mk-modal__footer">
                <button type="button" class="mk-btn mk-btn--ghost" id="mkEventModalCancel">Отмена</button>
                <button type="submit" class="mk-btn mk-btn--primary">Добавить</button>
            </div>
        </form>
    </div>
</div>

<!-- МОДАЛКА ДОБАВЛЕНИЯ ДОКУМЕНТА -->
<div class="mk-modal-overlay" id="mkDocModalOverlay">
    <div class="mk-modal" id="mkDocModal">
        <div class="mk-modal__header">
            <h2>Новый документ</h2>
            <button class="mk-modal__close" id="mkDocModalClose">✕</button>
        </div>
        <form class="mk-modal__form" id="mkDocForm">
            <div class="mk-form-group">
                <label class="mk-form-label" for="docTitle">Название <span class="mk-form-required">*</span></label>
                <input class="mk-input" id="docTitle" type="text" placeholder="Например: ОСАГО" required>
            </div>
            <div class="mk-form-row">
                <div class="mk-form-group">
                    <label class="mk-form-label" for="docDate">Срок действия</label>
                    <input class="mk-input" id="docDate" type="date">
                </div>
                <div class="mk-form-group">
                    <label class="mk-form-label" for="docType">Тип</label>
                    <select class="mk-input" id="docType">
                        <option value="Страховка">Страховка</option>
                        <option value="СТС">СТС</option>
                        <option value="Диагностика">Диагностика</option>
                        <option value="ПТС">ПТС</option>
                        <option value="Другое">Другое</option>
                    </select>
                </div>
            </div>
            <div class="mk-form-group">
                <label class="mk-form-label" for="docStatus">Статус</label>
                <select class="mk-input" id="docStatus">
                    <option value="ok">Действует</option>
                    <option value="warning">Истекает</option>
                    <option value="error">Просрочен</option>
                </select>
            </div>
            <div class="mk-form-group">
                <label class="mk-form-label" for="docDesc">Описание</label>
                <textarea class="mk-textarea" id="docDesc" rows="2" placeholder="Дополнительная информация…"></textarea>
            </div>
            <div class="mk-modal__footer">
                <button type="button" class="mk-btn mk-btn--ghost" id="mkDocModalCancel">Отмена</button>
                <button type="submit" class="mk-btn mk-btn--primary">Добавить</button>
            </div>
        </form>
    </div>
</div>

<!-- МОДАЛКА ДОБАВЛЕНИЯ ЗАМЕТКИ -->
<div class="mk-modal-overlay" id="mkNoteModalOverlay">
    <div class="mk-modal" id="mkNoteModal">
        <div class="mk-modal__header">
            <h2>Новая заметка</h2>
            <button class="mk-modal__close" id="mkNoteModalClose">✕</button>
        </div>
        <form class="mk-modal__form" id="mkNoteForm">
            <div class="mk-form-group">
                <label class="mk-form-label" for="noteTitle">Заголовок <span class="mk-form-required">*</span></label>
                <input class="mk-input" id="noteTitle" type="text" placeholder="Краткий заголовок" required>
            </div>
            <div class="mk-form-group">
                <label class="mk-form-label" for="noteContent">Содержание</label>
                <textarea class="mk-textarea" id="noteContent" rows="4" placeholder="Текст заметки…"></textarea>
            </div>
            <div class="mk-modal__footer">
                <button type="button" class="mk-btn mk-btn--ghost" id="mkNoteModalCancel">Отмена</button>
                <button type="submit" class="mk-btn mk-btn--primary">Добавить</button>
            </div>
        </form>
    </div>
</div>

<!-- ТОСТ -->
<div class="mk-toast" id="mkToast">
    <span class="mk-toast__icon">✓</span>
    <span class="mk-toast__message">Сохранено</span>
</div>

</body>
</html>
