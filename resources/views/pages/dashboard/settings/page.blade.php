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
                <button class="mk-tab" data-tab="units" role="tab" aria-selected="false" aria-controls="tab-units">
                    <i class="bi bi-rulers"></i> Единицы
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
                                <input type="text" id="first-name" value="Алексей" />
                            </div>
                            <div class="mk-form-group">
                                <label for="last-name">Фамилия</label>
                                <input type="text" id="last-name" value="Смирнов" />
                            </div>
                        </div>

                        <div class="mk-form-group">
                            <label for="display-name">Отображаемое имя</label>
                            <input type="text" id="display-name" value="Алексей Смирнов" />
                            <span class="mk-form-hint">Имя, которое видят другие пользователи</span>
                        </div>

                        <div class="mk-form-row">
                            <div class="mk-form-group">
                                <label for="birth-date">Дата рождения</label>
                                <input type="date" id="birth-date" value="1990-05-15" />
                            </div>
                            <div class="mk-form-group">
                                <label for="gender">Пол</label>
                                <select id="gender">
                                    <option value="male" selected>Мужской</option>
                                    <option value="female">Женский</option>
                                    <option value="other">Другой</option>
                                    <option value="prefer-not">Не указывать</option>
                                </select>
                            </div>
                        </div>

                        <div class="mk-form-group">
                            <label for="bio">О себе</label>
                            <textarea id="bio" rows="3" placeholder="Расскажите немного о себе...">Автомобильный энтузиаст, люблю путешествия и технику.</textarea>
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
                            <input type="email" id="email" value="alexey@example.ru" />
                            <span class="mk-form-hint">На этот адрес будут приходить уведомления</span>
                        </div>

                        <div class="mk-form-group">
                            <label for="phone">Телефон</label>
                            <input type="tel" id="phone" value="+7 (495) 123-45-67" />
                            <span class="mk-form-hint">Для восстановления доступа и уведомлений</span>
                        </div>

                        <div class="mk-form-group">
                            <label for="language">Язык интерфейса</label>
                            <select id="language">
                                <option value="ru" selected>Русский</option>
                                <option value="en">English</option>
                                <option value="de">Deutsch</option>
                            </select>
                        </div>

                        <div class="mk-form-group">
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

                        <div class="mk-form-group">
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
                                <label class="mk-radio">
                                    <input type="radio" name="to-interval" value="5000" />
                                    <span class="mk-radio__control"></span>
                                    Каждые 5 000 км
                                </label>
                                <label class="mk-radio">
                                    <input type="radio" name="to-interval" value="7500" />
                                    <span class="mk-radio__control"></span>
                                    Каждые 7 500 км
                                </label>
                                <label class="mk-radio">
                                    <input type="radio" name="to-interval" value="10000" checked />
                                    <span class="mk-radio__control"></span>
                                    Каждые 10 000 км
                                </label>
                                <label class="mk-radio">
                                    <input type="radio" name="to-interval" value="15000" />
                                    <span class="mk-radio__control"></span>
                                    Каждые 15 000 км
                                </label>
                                <label class="mk-radio">
                                    <input type="radio" name="to-interval" value="custom" />
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
                                <label class="mk-radio">
                                    <input type="radio" name="oil-interval" value="5000" checked />
                                    <span class="mk-radio__control"></span>
                                    Каждые 5 000 км
                                </label>
                                <label class="mk-radio">
                                    <input type="radio" name="oil-interval" value="7500" />
                                    <span class="mk-radio__control"></span>
                                    Каждые 7 500 км
                                </label>
                                <label class="mk-radio">
                                    <input type="radio" name="oil-interval" value="10000" />
                                    <span class="mk-radio__control"></span>
                                    Каждые 10 000 км
                                </label>
                                <label class="mk-radio">
                                    <input type="radio" name="oil-interval" value="15000" />
                                    <span class="mk-radio__control"></span>
                                    Каждые 15 000 км
                                </label>
                            </div>
                            <span class="mk-form-hint">Для турбированных двигателей рекомендуется менять масло чаще — каждые 5 000–7 500 км</span>
                        </div>

                        <!-- Предпочтительный тип топлива -->
                        <div class="mk-form-group">
                            <label for="fuel-type">Предпочтительный тип топлива</label>
                            <select id="fuel-type">
                                <option value="92">АИ-92</option>
                                <option value="95" selected>АИ-95</option>
                                <option value="98">АИ-98</option>
                                <option value="100">АИ-100</option>
                                <option value="diesel">Дизель</option>
                                <option value="gas">Газ</option>
                                <option value="electric">Электричество</option>
                            </select>
                            <span class="mk-form-hint">Используется для расчёта среднего расхода и стоимости</span>
                        </div>

                        <!-- Средний расход топлива (по умолчанию) -->
                        <div class="mk-form-row">
                            <div class="mk-form-group">
                                <label for="avg-fuel">Средний расход (л/100 км)</label>
                                <input type="number" id="avg-fuel" value="8.4" step="0.1" min="0" />
                            </div>
                            <div class="mk-form-group">
                                <label for="fuel-price">Средняя цена топлива (₽/л)</label>
                                <input type="number" id="fuel-price" value="55" step="0.5" min="0" />
                            </div>
                        </div>

                        <!-- Напоминание о сезонной смене шин -->
                        <div class="mk-form-group">
                            <label>Напоминать о смене шин</label>
                            <div class="mk-radio-group">
                                <label class="mk-radio">
                                    <input type="radio" name="tire-reminder" value="automatic" checked />
                                    <span class="mk-radio__control"></span>
                                    Автоматически (по дате)
                                </label>
                                <label class="mk-radio">
                                    <input type="radio" name="tire-reminder" value="manual" />
                                    <span class="mk-radio__control"></span>
                                    Вручную (по пробегу)
                                </label>
                                <label class="mk-radio">
                                    <input type="radio" name="tire-reminder" value="off" />
                                    <span class="mk-radio__control"></span>
                                    Не напоминать
                                </label>
                            </div>
                        </div>

                        <!-- Даты смены шин -->
                        <div class="mk-form-row">
                            <div class="mk-form-group">
                                <label for="summer-tires-date">Переход на летние шины</label>
                                <input type="date" id="summer-tires-date" value="2026-04-15" />
                            </div>
                            <div class="mk-form-group">
                                <label for="winter-tires-date">Переход на зимние шины</label>
                                <input type="date" id="winter-tires-date" value="2026-10-15" />
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
                                    <input type="checkbox" checked />
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                            <div class="mk-toggle-row">
                                <div>
                                    <span class="mk-toggle-row__label">Замена масла</span>
                                    <span class="mk-toggle-row__desc">По пробегу или времени</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" checked />
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                            <div class="mk-toggle-row">
                                <div>
                                    <span class="mk-toggle-row__label">Сезонная смена шин</span>
                                    <span class="mk-toggle-row__desc">Весной и осенью</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" checked />
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                            <div class="mk-toggle-row">
                                <div>
                                    <span class="mk-toggle-row__label">Замена тормозных колодок</span>
                                    <span class="mk-toggle-row__desc">По пробегу (каждые 30 000 км)</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" />
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
                                    <input type="checkbox" checked />
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                            <div class="mk-toggle-row">
                                <div>
                                    <span class="mk-toggle-row__label">Ежемесячный отчёт</span>
                                    <span class="mk-toggle-row__desc">Детальная аналитика за месяц</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" checked />
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                            <div class="mk-toggle-row">
                                <div>
                                    <span class="mk-toggle-row__label">Превышение бюджета</span>
                                    <span class="mk-toggle-row__desc">Если расходы превысили лимит</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" checked />
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
                                    <input type="checkbox" checked />
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                            <div class="mk-toggle-row">
                                <div>
                                    <span class="mk-toggle-row__label">Push-уведомления</span>
                                    <span class="mk-toggle-row__desc">В браузере или приложении</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" checked />
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                            <div class="mk-toggle-row">
                                <div>
                                    <span class="mk-toggle-row__label">Telegram</span>
                                    <span class="mk-toggle-row__desc">Подключите Telegram-бот</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" />
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

            <!-- Вкладка: Единицы измерения -->
            <div class="mk-tab-content" id="tab-units" role="tabpanel" aria-labelledby="tab-units">
                <div class="mk-settings-card">
                    <h2>Единицы измерения</h2>
                    <p class="mk-settings-card__sub">Как отображать пробег, расход и температуру</p>

                    <div class="mk-settings-form">
                        <div class="mk-form-group">
                            <label>Расстояние</label>
                            <div class="mk-radio-group">
                                <label class="mk-radio">
                                    <input type="radio" name="distance" value="km" checked />
                                    <span class="mk-radio__control"></span>
                                    Километры (км)
                                </label>
                                <label class="mk-radio">
                                    <input type="radio" name="distance" value="mi" />
                                    <span class="mk-radio__control"></span>
                                    Мили (mi)
                                </label>
                            </div>
                        </div>

                        <div class="mk-form-group">
                            <label>Расход топлива</label>
                            <div class="mk-radio-group">
                                <label class="mk-radio">
                                    <input type="radio" name="fuel" value="l/100km" checked />
                                    <span class="mk-radio__control"></span>
                                    Литров на 100 км
                                </label>
                                <label class="mk-radio">
                                    <input type="radio" name="fuel" value="km/l" />
                                    <span class="mk-radio__control"></span>
                                    Км на литр
                                </label>
                                <label class="mk-radio">
                                    <input type="radio" name="fuel" value="mpg" />
                                    <span class="mk-radio__control"></span>
                                    Миль на галлон (MPG)
                                </label>
                            </div>
                        </div>

                        <div class="mk-form-group">
                            <label>Температура</label>
                            <div class="mk-radio-group">
                                <label class="mk-radio">
                                    <input type="radio" name="temp" value="c" checked />
                                    <span class="mk-radio__control"></span>
                                    Цельсий (°C)
                                </label>
                                <label class="mk-radio">
                                    <input type="radio" name="temp" value="f" />
                                    <span class="mk-radio__control"></span>
                                    Фаренгейт (°F)
                                </label>
                            </div>
                        </div>

                        <div class="mk-form-group">
                            <label>Формат даты</label>
                            <div class="mk-radio-group">
                                <label class="mk-radio">
                                    <input type="radio" name="date" value="dd.mm.yyyy" checked />
                                    <span class="mk-radio__control"></span>
                                    ДД.ММ.ГГГГ
                                </label>
                                <label class="mk-radio">
                                    <input type="radio" name="date" value="mm/dd/yyyy" />
                                    <span class="mk-radio__control"></span>
                                    ММ/ДД/ГГГГ
                                </label>
                                <label class="mk-radio">
                                    <input type="radio" name="date" value="yyyy-mm-dd" />
                                    <span class="mk-radio__control"></span>
                                    ГГГГ-ММ-ДД
                                </label>
                            </div>
                        </div>

                        <div class="mk-form-actions">
                            <button class="mk-btn mk-btn--primary">Сохранить настройки</button>
                            <button class="mk-btn mk-btn--ghost">Отмена</button>
                        </div>
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

                        <!-- Двухфакторная аутентификация -->
                        <div class="mk-form-group" style="margin-top:8px;">
                            <label>Двухфакторная аутентификация</label>
                            <div class="mk-toggle-row" style="border-bottom:none;padding:8px 0;">
                                <div>
                                    <span class="mk-toggle-row__label">Включить 2FA</span>
                                    <span class="mk-toggle-row__desc">Дополнительная защита аккаунта</span>
                                </div>
                                <label class="mk-toggle">
                                    <input type="checkbox" />
                                    <span class="mk-toggle__slider"></span>
                                </label>
                            </div>
                        </div>

                        <div class="mk-form-actions">
                            <button class="mk-btn mk-btn--primary">Изменить пароль</button>
                        </div>

                        <hr class="mk-divider" />

                        <div class="mk-form-group">
                            <label>Активные сессии</label>
                            <div class="mk-session-list">
                                <div class="mk-session-item">
                                    <div class="mk-session-item__info">
                                        <i class="bi bi-laptop"></i>
                                        <div>
                                            <span class="mk-session-item__device">Chrome на Windows</span>
                                            <span class="mk-session-item__location">Москва, Россия</span>
                                        </div>
                                    </div>
                                    <span class="mk-session-item__status active">Активен</span>
                                </div>
                                <div class="mk-session-item">
                                    <div class="mk-session-item__info">
                                        <i class="bi bi-phone"></i>
                                        <div>
                                            <span class="mk-session-item__device">Safari на iPhone</span>
                                            <span class="mk-session-item__location">Москва, Россия</span>
                                        </div>
                                    </div>
                                    <span class="mk-session-item__status">Вчера</span>
                                </div>
                                <div class="mk-session-item">
                                    <div class="mk-session-item__info">
                                        <i class="bi bi-browser-edge"></i>
                                        <div>
                                            <span class="mk-session-item__device">Edge на Windows</span>
                                            <span class="mk-session-item__location">Санкт-Петербург, Россия</span>
                                        </div>
                                    </div>
                                    <span class="mk-session-item__status">3 дня назад</span>
                                </div>
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
