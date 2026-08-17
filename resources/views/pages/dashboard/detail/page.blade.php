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
                    <div class="mk-hero__silhouette" role="img" aria-label="Силуэт">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 98.967 98.967" preserveAspectRatio="xMidYMid slice">
                            <g fill="var(--mk-car-wheel-color, #23272F)">
                                <path d="M17.275,52.156c-4.124,0-7.468,3.343-7.468,7.468c0,0.318,0.026,0.631,0.066,0.938c0.463,3.681,3.596,6.528,7.401,6.528
                                    c3.908,0,7.112-3.004,7.437-6.83c0.017-0.209,0.031-0.422,0.031-0.637C24.743,55.499,21.4,52.156,17.275,52.156z M13.537,56.81
                                    l1.522,1.523c-0.118,0.203-0.211,0.422-0.271,0.656h-2.146C12.752,58.177,13.063,57.435,13.537,56.81z M12.632,60.282h2.163
                                    c0.061,0.23,0.151,0.448,0.271,0.648l-1.526,1.525C13.067,61.835,12.749,61.093,12.632,60.282z M16.629,64.263
                                    c-0.809-0.113-1.544-0.43-2.166-0.899l1.518-1.519c0.2,0.117,0.419,0.203,0.648,0.263V64.263z M16.629,57.14
                                    c-0.235,0.062-0.455,0.154-0.66,0.275l-1.521-1.521c0.625-0.475,1.367-0.789,2.181-0.902V57.14z M17.922,54.99
                                    c0.814,0.113,1.557,0.429,2.181,0.903l-1.52,1.521c-0.204-0.121-0.426-0.213-0.66-0.275L17.922,54.99L17.922,54.99z
                                     M17.922,64.261v-2.152c0.23-0.061,0.447-0.146,0.647-0.264l1.519,1.519C19.466,63.833,18.73,64.148,17.922,64.261z
                                     M21.014,62.462l-1.531-1.533c0.12-0.201,0.217-0.416,0.278-0.646h2.146C21.793,61.091,21.488,61.839,21.014,62.462z
                                     M19.764,58.989c-0.061-0.234-0.153-0.453-0.271-0.656l1.524-1.523c0.471,0.625,0.782,1.367,0.894,2.18H19.764z"/>
                                <path d="M79.284,52.156c-4.124,0-7.468,3.343-7.468,7.468c0,0.318,0.026,0.631,0.066,0.938c0.463,3.681,3.596,6.528,7.4,6.528
                                    c3.908,0,7.112-3.004,7.438-6.83c0.017-0.209,0.031-0.422,0.031-0.637C86.753,55.499,83.409,52.156,79.284,52.156z M75.546,56.81
                                    l1.521,1.523c-0.118,0.203-0.211,0.422-0.271,0.656H74.65C74.761,58.177,75.072,57.435,75.546,56.81z M74.642,60.282h2.163
                                    c0.061,0.23,0.151,0.448,0.271,0.648l-1.525,1.525C75.076,61.835,74.757,61.093,74.642,60.282z M78.638,64.263
                                    c-0.809-0.113-1.544-0.43-2.166-0.899l1.518-1.519c0.2,0.117,0.419,0.203,0.648,0.263V64.263z M78.638,57.14
                                    c-0.235,0.062-0.455,0.154-0.66,0.275l-1.521-1.521c0.625-0.475,1.366-0.789,2.181-0.902V57.14z M79.932,54.99
                                    c0.814,0.113,1.557,0.429,2.181,0.903l-1.521,1.521c-0.204-0.121-0.426-0.215-0.66-0.275V54.99z M79.932,64.261v-2.152
                                    c0.23-0.061,0.447-0.146,0.647-0.264l1.519,1.519C81.476,63.833,80.739,64.148,79.932,64.261z M83.023,62.462l-1.531-1.531
                                    c0.12-0.202,0.218-0.416,0.278-0.647h2.146C83.802,61.091,83.498,61.839,83.023,62.462z M81.773,58.989
                                    c-0.061-0.234-0.152-0.453-0.271-0.656l1.523-1.523c0.472,0.625,0.782,1.367,0.895,2.18H81.773z"/>
                            </g>
                            <g fill="{{$car->colorInfo->hex}}">
                                <path d="M97.216,48.29v-5.526c0-0.889-0.646-1.642-1.524-1.779c-2.107-0.33-5.842-0.953-7.52-1.47
                                    c-2.406-0.742-11.702-4.678-14.921-5.417c-3.22-0.739-17.738-4.685-31.643,0.135c-2.353,0.815-12.938,5.875-19.162,8.506
                                    c-1.833,0.04-19.976,3.822-20.942,6.414c-0.966,2.593-1.269,3.851-1.447,4.509c-0.178,0.658,0,3.807,1.348,6
                                    c1.374,0.777,4.019,1.299,7.077,1.649c-0.035-0.187-0.073-0.371-0.097-0.56c-0.053-0.404-0.078-0.773-0.078-1.125
                                    c0-4.945,4.022-8.969,8.968-8.969s8.968,4.023,8.968,8.969c0,0.254-0.017,0.506-0.036,0.754c-0.047,0.555-0.147,1.094-0.292,1.613
                                    c0.007,0,0.024,0,0.024,0l44.516-0.896c-0.02-0.115-0.046-0.229-0.061-0.346c-0.053-0.402-0.078-0.772-0.078-1.125
                                    c0-4.945,4.022-8.968,8.968-8.968c4.946,0,8.969,4.022,8.969,8.968c0,0.019-0.002,0.035-0.003,0.053l0.19-0.016l7.611-1.433
                                    c0,0,2.915-1.552,2.915-5.822C98.967,49.56,97.216,48.29,97.216,48.29z M53.057,43.051L36.432,43.56
                                    c0.306-2.491-1.169-3.05-1.169-3.05c6.609-5.999,19.929-6.202,19.929-6.202L53.057,43.051z M71.715,42.29l-15.15,0.509l1.373-8.49
                                    c7.83-0.102,12.303,1.626,12.303,1.626l2.237,3.61L71.715,42.29z M80.256,42.238h-4.221l-4.22-5.795
                                    c3.166,1.26,5.7,2.502,7.209,3.287C79.94,40.206,80.44,41.223,80.256,42.238z"/>
                            </g>
                        </svg>
                    </div>
                    <div class="mk-hero__plate">{{ $car->plate_number . ' ' . $car->plate_region}} RUS</div>
                </div>
                <div class="mk-hero__body">
                    <div class="mk-eyebrow">Автомобиль</div>
                    <h1 class="mk-hero__title">{{$car->brand->name .' '. $car->model->name}}</h1>
                    <div class="mk-hero__sub">{{$car->bodyInfo->name}}, {{$car->year}}, {{$car->engine_volume}} л</div>
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
                    <div class="mk-stat__value" data-history-count>48</div>
                    <div class="mk-stat__delta ok">+{{$thisMonthHistoryCount}} за месяц</div>
                </div>
                <div class="mk-stat">
                    <div class="mk-stat__head">
                        <span class="mk-stat__ic" style="--ic-bg: var(--mk-c-buy-soft);">
                            <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-buy)" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </span>
                        <span class="mk-stat__label">Расходы за год</span>
                    </div>
                    <div class="mk-stat__value">{{ number_format($TotalSpend, 0, ',', ' ') }} ₽</div>
                    @if($diffPercent)
                    <div class="mk-stat__delta up">+{{$diffPercent}}% к прошлому</div>
                    @endif
                </div>
                <div class="mk-stat mk-wip">
                    <div class="mk-stat__head">
                        <span class="mk-stat__ic" style="--ic-bg: var(--mk-c-fuel-soft);">
                            <svg viewBox="0 0 24 24" fill="none" stroke="var(--mk-c-fuel)" stroke-width="2"><path d="M3 22h12"/><path d="M18 2l-3 3"/><path d="M10 10l3-3"/><path d="M6 14l3-3"/><path d="M13 6l3-3"/><path d="M6 22h12"/><path d="M9 7l3-3"/></svg>
                        </span>
                        <span class="mk-stat__label">Средний расход</span>
                    </div>
                    <div class="mk-stat__value">8.4 л/100 км</div>
                    <div class="mk-stat__delta ok">−0.3 л с прошлого</div>
                </div>
                <div class="mk-stat mk-wip">
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
                    <h2 class="mk-section-head__title">История <span class="count" data-history-count>0</span></h2>
                    <div class="mk-section-head__spacer"></div>
                    <button class="mk-btn mk-btn--primary mk-btn--sm" id="addRecordBtn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Запись
                    </button>
                </div>
                <div class="mk-chips" role="tablist">
                    <button class="mk-chip active" data-type-history="0" role="tab">Все</button>
                    <button class="mk-chip" role="tab" data-type-history="service"><span class="dot" style="background:var(--mk-c-service);"></span> ТО</button>
                    <button class="mk-chip" role="tab" data-type-history="repair"><span class="dot" style="background:var(--mk-c-repair);"></span> Поломки</button>
                    <button class="mk-chip" role="tab" data-type-history="buy"><span class="dot" style="background:var(--mk-c-buy);"></span> Покупки</button>
                    <button class="mk-chip" role="tab" data-type-history="fuel"><span class="dot" style="background:var(--mk-c-fuel);"></span> Заправки</button>
                </div>
                <div class="mk-feed" id="recordsFeed">
                    <!-- Записи истории добавляются через JS -->
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
        <form class="mk-modal__form" id="mkRecordForm" data-history-form>
            <input name="car_id" type="hidden" value="{{$car->id}}">
            <div class="mk-form-group">
                <label class="mk-form-label">Тип записи</label>
                <div class="mk-segment" id="mkTypeSegment">
                    <button type="button" class="mk-segment__item active" data-type="service">ТО</button>
                    <button type="button" class="mk-segment__item" data-type="repair">Поломка</button>
                    <button type="button" class="mk-segment__item" data-type="buy">Покупка</button>
                    <button type="button" class="mk-segment__item" data-type="fuel">Заправка</button>
                </div>
            </div>
            <div class="mk-form-group">
                <label class="mk-form-label" for="recordTitle">Название <span class="mk-form-required">*</span></label>
                <input class="mk-input" name="name" id="recordTitle" type="text" placeholder="Например: Замена масла" required>
            </div>
            <div class="mk-form-row">
                <div class="mk-form-group" data-record-field="date">
                    <label class="mk-form-label" for="recordDate">Дата</label>
                    <input class="mk-input" name="date" id="recordDate" type="date">
                </div>
                <div class="mk-form-group" data-record-field="odometer">
                    <label class="mk-form-label" for="recordOdometer">Пробег, км</label>
                    <input class="mk-input mk-input--right" value="<?= $car->mileage ?>" name="mileage" id="recordOdometer" type="text" inputmode="numeric" placeholder="86 420">
                </div>
            </div>
            <div class="mk-form-row">
                <div class="mk-form-group" data-record-field="cost">
                    <label class="mk-form-label" for="recordCost" id="recordCostLabel">Сумма, ₽</label>
                    <input class="mk-input mk-input--right" name="price" id="recordCost" type="text" inputmode="numeric" placeholder="0">
                </div>
                <div class="mk-form-group" data-record-field="place">
                    <label class="mk-form-label" for="recordPlace" id="recordPlaceLabel">Место</label>
                    <input class="mk-input" name="place" id="recordPlace" type="text" placeholder="Название СТО">
                </div>
            </div>
            <div class="mk-form-group" data-record-field="volume">
                <label class="mk-form-label" for="recordVolume">Объём, л</label>
                <input class="mk-input mk-input--right" name="volume" id="recordVolume" type="text" inputmode="numeric" placeholder="45">
            </div>
            <div class="mk-form-group">
                <label class="mk-form-label" for="recordDesc">Описание</label>
                <textarea class="mk-textarea" name="details" id="recordDesc" rows="3" placeholder="Дополнительные детали…"></textarea>
            </div>
            <div class="mk-form-group" data-record-field="photo">
                <label class="mk-form-label">Фото / Чек</label>
                <div class="mk-dropzone" id="mkDropzone">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                    <span>Перетащите файл или кликните</span>
                    <input type="file" name="files" accept="image/*" multiple>
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
        <form class="mk-modal__form" data-reminder-form id="mkEventRemindersForm">
            <input name="car_id" type="hidden" value="{{$car->id}}">
            <div class="mk-form-group">
                <label class="mk-form-label" for="eventTitle">Название <span class="mk-form-required">*</span></label>
                <input class="mk-input" id="eventTitle" name="title" type="text" placeholder="Например: Проверить давление в шинах" required>
            </div>
            <div class="mk-form-row">
                <div class="mk-form-group">
                    <label class="mk-form-label" for="eventDate">Дата</label>
                    <input class="mk-input" name="date" id="eventDate" type="date">
                </div>
                <div class="mk-form-group">
                    <label class="mk-form-label" for="eventType">Тип</label>
                    <select class="mk-input" name="reminder_type" id="eventType">
                        <option value="event">Событие</option>
                        <option value="reminder">Напоминание</option>
                        <option value="periodic" selected>Периодическое</option>
                    </select>
                </div>
            </div>
            <div class="mk-form-group" id="periodicityGroup">
                <label class="mk-form-label" for="eventPeriodicity">Периодичность</label>
                <select class="mk-input" name="reminder_cycle" id="eventPeriodicity">
                    <option value="week">Еженедельно</option>
                    <option value="month">Ежемесячно</option>
                    <option value="month3">Каждые 3 месяца</option>
                    <option value="month6">Каждые 6 месяцев</option>
                    <option value="year">Ежегодно</option>
                </select>
            </div>
            <div class="mk-form-group">
                <label class="mk-form-label" for="eventDesc">Описание</label>
                <textarea class="mk-textarea" name="text" id="eventDesc" rows="2" placeholder="Дополнительная информация…"></textarea>
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
        <form class="mk-modal__form" id="mkDocForm" data-docs-form>
            <input name="car_id" type="hidden" value="{{$car->id}}">
            <div class="mk-form-group">
                <label class="mk-form-label" for="docTitle">Название <span class="mk-form-required">*</span></label>
                <input class="mk-input" id="docTitle" name="name" type="text" placeholder="Например: ОСАГО" required>
            </div>
            <div class="mk-form-row">
                <div class="mk-form-group">
                    <label class="mk-form-label" for="docDate">Срок действия</label>
                    <input class="mk-input" id="docDate" name="date" type="date">
                    <label class="mk-checkbox" for="docPermanent">
                        <input type="checkbox" id="docPermanent" name="is_permanent">
                        <span>Бессрочное</span>
                    </label>
                </div>
                <div class="mk-form-group">
                    <label class="mk-form-label" for="docType">Тип</label>
                    <select class="mk-input" id="docType" name="type">
                        <option value="insurance">Страховка</option>
                        <option value="registration">СТС</option>
                        <option value="review">Диагностика</option>
                        <option value="TransportPassport">ПТС</option>
                        <option value="other">Другое</option>
                    </select>
                </div>
            </div>
            <div class="mk-form-group">
                <label class="mk-form-label" for="docDesc">Описание</label>
                <textarea class="mk-textarea" id="docDesc" name="comment" rows="2" placeholder="Дополнительная информация…"></textarea>
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
        <form class="mk-modal__form" id="mkNoteForm" data-notes-form>
            <input name="car_id" type="hidden" value="{{$car->id}}">
            <div class="mk-form-group">
                <label class="mk-form-label" for="noteTitle">Заголовок <span class="mk-form-required">*</span></label>
                <input class="mk-input" id="noteTitle" name="noteTitle" type="text" placeholder="Краткий заголовок" required>
            </div>
            <div class="mk-form-group">
                <label class="mk-form-label" for="noteContent">Содержание</label>
                <textarea class="mk-textarea" name="noteText" id="noteContent" rows="4" placeholder="Текст заметки…"></textarea>
            </div>
            <div class="mk-modal__footer">
                <button type="button" class="mk-btn mk-btn--ghost" id="mkNoteModalCancel">Отмена</button>
                <button type="submit" class="mk-btn mk-btn--primary">Добавить</button>
            </div>
        </form>
    </div>
</div>

<!-- ЕДИНОЕ ВЫПАДАЮЩЕЕ МЕНЮ ЗАПИСИ (position: fixed, общее на всю ленту) -->
<div class="mk-record__dropdown" id="mkRecordMenu" data-record-dropdown>
    <button type="button" class="mk-record__dropdown-item" data-record-action="edit">✏️ Редактировать</button>
    <button type="button" class="mk-record__dropdown-item mk-record__dropdown-item--danger" data-record-action="delete">🗑 Удалить</button>
</div>

<!-- МОДАЛКА ПОДРОБНОСТЕЙ ЗАПИСИ -->
<div class="mk-modal-overlay" id="mkRecordDetailOverlay">
    <div class="mk-modal" id="mkRecordDetailModal">
        <div class="mk-modal__header">
            <h2 id="mkDetailTitle">Запись</h2>
            <button class="mk-modal__close" id="mkRecordDetailClose">✕</button>
        </div>
        <div class="mk-modal__form">
            <span class="mk-record-detail__tag" id="mkDetailTag"></span>
            <p class="mk-record-detail__desc" id="mkDetailDesc"></p>
            <div class="mk-record-detail__grid">
                <div class="mk-record-detail__row" data-detail-field="date">
                    <span class="mk-record-detail__label">Дата</span>
                    <span class="mk-record-detail__value" id="mkDetailDate"></span>
                </div>
                <div class="mk-record-detail__row" data-detail-field="mileage">
                    <span class="mk-record-detail__label">Пробег</span>
                    <span class="mk-record-detail__value" id="mkDetailMileage"></span>
                </div>
                <div class="mk-record-detail__row" data-detail-field="place">
                    <span class="mk-record-detail__label">Место</span>
                    <span class="mk-record-detail__value" id="mkDetailPlace"></span>
                </div>
                <div class="mk-record-detail__row" data-detail-field="volume">
                    <span class="mk-record-detail__label">Объём</span>
                    <span class="mk-record-detail__value" id="mkDetailVolume"></span>
                </div>
                <div class="mk-record-detail__row" data-detail-field="cost">
                    <span class="mk-record-detail__label">Сумма</span>
                    <span class="mk-record-detail__value" id="mkDetailCost"></span>
                </div>
            </div>
        </div>
        <div class="mk-modal__footer">
            <button type="button" class="mk-btn mk-btn--ghost" id="mkRecordDetailDelete">Удалить</button>
            <button type="button" class="mk-btn mk-btn--primary" id="mkRecordDetailCloseBtn">Закрыть</button>
        </div>
    </div>
</div>

<!-- ТОСТ -->
<div class="mk-toast" id="mkToast">
    <span class="mk-toast__icon">✓</span>
    <span class="mk-toast__message">Сохранено</span>
</div>

</body>
</html>
