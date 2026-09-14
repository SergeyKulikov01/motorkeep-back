@include('layouts.public.landing-head')
<body>
<!-- СКРИМ -->
<div class="mk-scrim" id="mkScrim"></div>

<!-- ====== САЙДБАР (без изменений) ====== -->
@include('layouts.private.sidebar')

<!-- ====== ОБОЛОЧКА ====== -->
<div class="mk-shell" id="mkShell">
    <!-- ХЕДЕР (без изменений) -->
    @include('layouts.private.header', ['pageTitle' => 'Настройки'])
    <!-- ОСНОВНОЙ КОНТЕНТ -->
    <main class="mk-content">
        <div class="mk-content__inner">

            <!-- ===== ВКЛАДКИ ===== -->
            <div class="mk-settings-tabs" role="tablist">
                <button class="mk-tab active" data-tab="profile" role="tab" aria-selected="true" aria-controls="tab-profile">
                    <i class="bi bi-person"></i> Профиль
                </button>
                <button class="mk-tab" data-tab="account" role="tab" aria-selected="false" aria-controls="tab-account">
                    <i class="bi bi-envelope"></i> Аккаунт
                </button>
                <button class="mk-tab" data-tab="vehicle" role="tab" aria-selected="false" aria-controls="tab-vehicle">
                    <i class="bi bi-car-front"></i> Автомобиль
                </button>
                <button class="mk-tab" data-tab="notifications" role="tab" aria-selected="false" aria-controls="tab-notifications">
                    <i class="bi bi-bell"></i> Уведомления
                </button>
                <button class="mk-tab" data-tab="security" role="tab" aria-selected="false" aria-controls="tab-security">
                    <i class="bi bi-shield-lock"></i> Безопасность
                </button>
            </div>

            <!-- ===== СОДЕРЖИМОЕ ВКЛАДОК ===== -->

            <!-- Вкладка: Профиль -->
            <div class="mk-tab-content active" id="tab-profile" role="tabpanel" aria-labelledby="tab-profile">
                <div class="mk-settings-card">
                    <h2>Личная информация</h2>
                    <p class="mk-settings-card__sub">Данные, которые будут отображаться в профиле</p>
                    <div class="mk-settings-form">
                        <div class="mk-form-row">
                            <div class="mk-form-group">
                                <label for="first-name">Имя</label>
                                <input type="text" id="first-name" value="{{$user->name}}" />
                            </div>
                            <div class="mk-form-group">
                                <label for="last-name">Фамилия</label>
                                <input type="text" id="last-name" value="{{$user->last_name}}" />
                            </div>
                        </div>
                        <div class="mk-form-row">
                            <div class="mk-form-group">
                                <label for="birth-date">Дата рождения</label>
                                <input type="date" id="birth-date" value="{{$settings->date_birth}}" />
                            </div>
                            <div class="mk-form-group">
                                <label for="gender">Пол</label>
                                <select id="gender">
                                    <option value="male" <?= ($settings->gender === 'male')? 'selected' : '' ?>>Мужской</option>
                                    <option value="female" <?= ($settings->gender === 'female')? 'selected' : '' ?>>Женский</option>
                                    <option value="unset" <?= ($settings->gender === 'unset')? 'selected' : '' ?>>Не указывать</option>
                                </select>
                            </div>
                        </div>

                        <div class="mk-form-group">
                            <label for="bio">О себе</label>
                            <textarea id="bio" rows="3" placeholder="Расскажите немного о себе...">{{$settings->about}}</textarea>
                        </div>

                        <div class="mk-form-actions">
                            <button class="mk-btn mk-btn--primary">Сохранить изменения</button>
                            <button class="mk-btn mk-btn--ghost">Отмена</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Вкладка: Аккаунт -->
            <div class="mk-tab-content" id="tab-account" role="tabpanel" aria-labelledby="tab-account">
                <div class="mk-settings-card">
                    <h2>Данные аккаунта</h2>
                    <p class="mk-settings-card__sub">Электронная почта, телефон и настройки входа</p>
                    <div class="mk-settings-form">
                        <div class="mk-form-group">
                            <label for="email">Электронная почта</label>
                            <input type="email" id="email" value="{{$user->email}}" />
                            <span class="mk-form-hint">На этот адрес будут приходить уведомления</span>
                        </div>
                        <div class="mk-form-group">
                            <label for="phone">Телефон</label>
                            <input type="tel" id="phone" value="{{$settings->phone}}" />
                            <span class="mk-form-hint">Для восстановления доступа и уведомлений</span>
                        </div>
                        <div class="mk-form-group mk-wip">
                            <label for="language">Язык интерфейса</label>
                            <select id="language">
                                <option value="ru" selected>Русский</option>
                                <option value="en">English</option>
                                <option value="de">Deutsch</option>
                            </select>
                        </div>
                        <div class="mk-form-group mk-wip">
                            <label for="timezone">Часовой пояс</label>
                            <select id="timezone">
                                <option value="UTC+3" selected>Москва (UTC+3)</option>
                                <option value="UTC+2">Калининград (UTC+2)</option>
                                <option value="UTC+4">Самара (UTC+4)</option>
                                <option value="UTC+5">Екатеринбург (UTC+5)</option>
                                <option value="UTC+7">Новосибирск (UTC+7)</option>
                                <option value="UTC+10">Владивосток (UTC+10)</option>
                            </select>
                        </div>
                        <div class="mk-form-group mk-wip">
                            <label for="currency">Валюта</label>
                            <select id="currency">
                                <option value="RUB" selected>Рубль (₽)</option>
                                <option value="USD">Доллар ($)</option>
                                <option value="EUR">Евро (€)</option>
                            </select>
                        </div>
                        <div class="mk-form-actions">
                            <button class="mk-btn mk-btn--primary">Сохранить изменения</button>
                            <button class="mk-btn mk-btn--ghost">Отмена</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Вкладка: Автомобиль (НОВАЯ) -->
            <div class="mk-tab-content" id="tab-vehicle" role="tabpanel" aria-labelledby="tab-vehicle">
                <div class="mk-settings-card">
                    <h2>Настройки автомобиля</h2>
                    <p class="mk-settings-card__sub">Интервалы обслуживания и предпочтения</p>
                    <div class="mk-settings-form">
                        <!-- Как часто делается ТО -->
                        <div class="mk-form-group">
                            <label>Как часто делается ТО</label>
                            <div class="mk-radio-group">
                                @foreach($periodKm as $period)
                                    <label class="mk-radio">
                                        <input type="radio" name="to-interval" value="{{$period}}" <?= ($settings->service_period === $period)? 'checked' : '' ?>/>
                                        <span class="mk-radio__control"></span>
                                        Каждые {{$period}} км
                                    </label>
                                @endforeach
                                <label class="mk-radio">
                                    <input type="radio" name="to-interval" value="custom" <?= (!in_array($settings->service_period,$periodKm))? 'checked' : '' ?>/>
                                    <span class="mk-radio__control"></span>
                                    Своё значение
                                </label>
                            </div>
                            <div class="mk-form-row" style="margin-top:12px;display:none;" id="custom-to-row">
                                <div class="mk-form-group">
                                    <label for="custom-to-km">Километры</label>
                                    <input type="number" id="custom-to-km" placeholder="Например: 12000" />
                                </div>
                                <div class="mk-form-group">
                                    <label for="custom-to-months">Месяцы</label>
                                    <input type="number" id="custom-to-months" placeholder="Например: 12" />
                                </div>
                            </div>
                            <span class="mk-form-hint">Рекомендуемый интервал для большинства автомобилей — 10 000 км или 1 раз в год</span>
                        </div>

                        <!-- Как часто меняется масло -->
                        <div class="mk-form-group">
                            <label>Как часто меняется масло</label>
                            <div class="mk-radio-group">
                                @foreach($periodKm as $period)
                                    <label class="mk-radio">
                                        <input type="radio" name="oil-interval" value="{{$period}}" <?= ($settings->oil_period === $period)? 'checked' : '' ?>/>
                                        <span class="mk-radio__control"></span>
                                        Каждые {{$period}} км
                                    </label>
                                @endforeach
                            </div>
                            <span class="mk-form-hint">Для турбированных двигателей рекомендуется менять масло чаще — каждые 5 000–7 500 км</span>
                        </div>

                        <!-- Напоминание о сезонной смене шин -->
                        <div class="mk-form-group">
                            <label>Напоминать о смене шин</label>
                            <div class="mk-radio-group">
                                @foreach($changeTyreOptions as $value => $option)
                                    <label class="mk-radio">
                                        <input type="radio" name="tire-reminder" value="{{$value}}" <?= ($settings->change_tyre_notify === $value)? 'checked' : '' ?> />
                                        <span class="mk-radio__control"></span>
                                        {{$option}}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Даты смены шин -->
                        <div class="mk-form-row">
                            <div class="mk-form-group">
                                <label for="summer-tires-date">Переход на летние шины</label>
                                <input type="date" id="summer-tires-date" value="{{$settings->summer_tyre}}" />
                            </div>
                            <div class="mk-form-group">
                                <label for="winter-tires-date">Переход на зимние шины</label>
                                <input type="date" id="winter-tires-date" value="{{$settings->winter_tyre}}" />
                            </div>
                        </div>

                        <div class="mk-form-actions">
                            <button class="mk-btn mk-btn--primary">Сохранить настройки</button>
                            <button class="mk-btn mk-btn--ghost">Отмена</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Вкладка: Уведомления -->
            <div class="mk-tab-content" id="tab-notifications" role="tabpanel" aria-labelledby="tab-notifications">
                <div class="mk-settings-card">
                    <h2>Настройки уведомлений</h2>
                    <p class="mk-settings-card__sub">Выберите, о чём вы хотите получать уведомления</p>

                    <div class="mk-notification-settings">
                        <div class="mk-notification-group">
                            <h3>Напоминания</h3>
                            <div class="mk-toggle-row">
                                <div>
                                    <span class="mk-toggle-row__label">Следующее ТО</span>
                                    <span class="mk-toggle-row__desc">За 7 дней до планового обслуживания</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" {{($settings->notify_next_service)? 'checked' : ''}} />
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                            <div class="mk-toggle-row">
                                <div>
                                    <span class="mk-toggle-row__label">Замена масла</span>
                                    <span class="mk-toggle-row__desc">По пробегу или времени</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" {{($settings->notify_oil_change)? 'checked' : ''}} />
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                            <div class="mk-toggle-row">
                                <div>
                                    <span class="mk-toggle-row__label">Сезонная смена шин</span>
                                    <span class="mk-toggle-row__desc">Весной и осенью</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" {{($settings->notify_tyres_change)? 'checked' : ''}} />
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                            <div class="mk-toggle-row">
                                <div>
                                    <span class="mk-toggle-row__label">Замена тормозных колодок</span>
                                    <span class="mk-toggle-row__desc">По пробегу (каждые 30 000 км)</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" {{($settings->notify_change_breakes)? 'checked' : ''}} />
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                        </div>

                        <div class="mk-notification-group">
                            <h3>Статистика</h3>
                            <div class="mk-toggle-row">
                                <div>
                                    <span class="mk-toggle-row__label">Еженедельный отчёт</span>
                                    <span class="mk-toggle-row__desc">Сводка расходов и пробега за неделю</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" {{($settings->stats_week)? 'checked' : ''}} />
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                            <div class="mk-toggle-row">
                                <div>
                                    <span class="mk-toggle-row__label">Ежемесячный отчёт</span>
                                    <span class="mk-toggle-row__desc">Детальная аналитика за месяц</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" {{($settings->stats_months)? 'checked' : ''}} />
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                        </div>

                        <div class="mk-notification-group">
                            <h3>Способы доставки</h3>
                            <div class="mk-toggle-row">
                                <div>
                                    <span class="mk-toggle-row__label">Email</span>
                                    <span class="mk-toggle-row__desc">На электронную почту</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" {{($settings->notify_email)? 'checked' : ''}} />
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                            <div class="mk-toggle-row">
                                <div>
                                    <span class="mk-toggle-row__label">Push-уведомления</span>
                                    <span class="mk-toggle-row__desc">В браузере или приложении</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" {{($settings->notify_push)? 'checked' : ''}} />
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                            <div class="mk-toggle-row">
                                <div>
                                    <span class="mk-toggle-row__label">Telegram</span>
                                    <span class="mk-toggle-row__desc">Подключите Telegram-бот</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" {{($settings->notify_telegram)? 'checked' : ''}}/>
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mk-form-actions">
                        <button class="mk-btn mk-btn--primary">Сохранить настройки</button>
                        <button class="mk-btn mk-btn--ghost">Отмена</button>
                    </div>
                </div>
            </div>
            <!-- Вкладка: Безопасность -->
            <div class="mk-tab-content" id="tab-security" role="tabpanel" aria-labelledby="tab-security">
                <div class="mk-settings-card">
                    <h2>Безопасность</h2>
                    <p class="mk-settings-card__sub">Управление паролем и сессиями</p>

                    <div class="mk-settings-form">
                        <div class="mk-form-group">
                            <label for="current-password">Текущий пароль</label>
                            <input type="password" id="current-password" placeholder="••••••••" />
                        </div>
                        <div class="mk-form-group">
                            <label for="new-password">Новый пароль</label>
                            <input type="password" id="new-password" placeholder="Не менее 8 символов" />
                            <span class="mk-form-hint">Пароль должен содержать буквы и цифры</span>
                        </div>
                        <div class="mk-form-group">
                            <label for="confirm-password">Подтвердите пароль</label>
                            <input type="password" id="confirm-password" placeholder="Повторите новый пароль" />
                        </div>
                        <div class="mk-form-actions">
                            <button class="mk-btn mk-btn--primary">Изменить пароль</button>
                        </div>

                        <hr class="mk-divider" />

                        <div class="mk-form-group">
                            <label>Активные сессии</label>
                            <div class="mk-session-list">
                                @foreach($sessions as $session)
                                    <div class="mk-session-item">
                                        <div class="mk-session-item__info">
                                            @if($session->isDesktop)
                                                <i class="bi bi-laptop"></i>
                                            @else
                                                <i class="bi bi-phone"></i>
                                            @endif
                                            <div>
                                                <span class="mk-session-item__device">{{$session->userPlatform}} на {{$session->userBrowser}}</span>
                                                <span class="mk-session-item__location">{{$session->ip_address}}</span>
                                            </div>
                                        </div>
                                        <span class="mk-session-item__status <?= ($session->isCurrent)? 'active' : '' ?>"><?= ($session->isCurrent)? 'Активен' : $session->dateDiff ?></span>
                                    </div>
                                @endforeach
                            </div>
                            <button class="mk-btn mk-btn--ghost" style="margin-top:12px;border-color:var(--mk-danger);color:var(--mk-danger);">
                                Завершить все сессии
                            </button>
                        </div>

                        <hr class="mk-divider" />

                        <div class="mk-danger-zone">
                            <h3>Опасная зона</h3>
                            <p>Удаление аккаунта приведёт к безвозвратной потере всех данных.</p>
                            <button class="mk-btn" style="border-color:var(--mk-danger);color:var(--mk-danger);">
                                <i class="bi bi-trash"></i> Удалить аккаунт
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ФУТЕР -->
    @include('layouts.private.footer')
</div>
<!-- ТОСТ -->
<div class="mk-toast" id="mkToast">
    <span class="mk-toast__icon">✓</span>
    <span class="mk-toast__message">Сохранено</span>
</div>

</body>
</html>
