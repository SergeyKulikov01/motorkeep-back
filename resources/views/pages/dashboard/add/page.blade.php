<!DOCTYPE html>
<html lang="ru">
<head>
    @include('layouts.public.landing-head')
</head>
<body>

<!-- ======== СКРИМ ======== -->
<div class="mk-scrim" aria-hidden="true"></div>

<!-- ======== САЙДБАР ======== -->
@include('layouts.private.sidebar')

<div class="mk-shell">
    <header class="mk-header" role="banner">
        <div class="mk-header__inner">
            <button class="mk-burger" aria-label="Открыть меню">
                <span></span><span></span><span></span>
            </button>
            <div class="mk-header__title">
                Добавить авто
                <span class="mk-header__crumb">/ новый автомобиль</span>
            </div>
            <div class="mk-header__right">
                <button class="mk-iconbtn" aria-label="Уведомления">
                    <svg viewBox="0 0 24 24">
                        <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 01-3.46 0"/>
                    </svg>
                    <span class="dot" aria-hidden="true"></span>
                </button>
                <button class="mk-userchip" aria-label="Профиль пользователя">
                    <span class="mk-userchip__avatar">{{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}</span>
                    <span class="mk-userchip__name">{{ Auth::user()->name }}</span>
                </button>
            </div>
        </div>
    </header>
    <main class="mk-main" role="main">
        <div class="mk-container mk-container--form">
            <div class="mk-form-card">
                <div class="mk-form-card__head">
                    <h1 class="mk-form-card__title">Новый автомобиль</h1>
                    <p class="mk-form-card__sub">Заполните данные — и машина появится в вашем гараже</p>
                </div>
                <form class="mk-form" id="add-car-form" novalidate>

                    <!-- Секция 1: Основная информация -->
                    <div class="mk-form-section">
                        <h2 class="mk-form-section__title">Основная информация</h2>
                        <div class="mk-form__grid">
                            <div class="mk-field">
                                <label for="car-brand" class="mk-field__label">Марка *</label>
                                <div class="mk-combobox" id="brand-combobox">
                                    <input type="text" id="car-brand" class="mk-field__input mk-combobox__input"
                                           placeholder="Начните вводить марку" autocomplete="off"
                                           role="combobox" aria-expanded="false" aria-autocomplete="list"
                                           aria-controls="brand-combobox-list" required/>
                                    <input type="hidden" id="car-brand-id" name="car-brand-id">
                                    <ul class="mk-combobox__list" id="brand-combobox-list" role="listbox"></ul>
                                </div>
                                <div class="mk-field__error" id="car-brand-error"></div>
                            </div>
                            <div class="mk-field">
                                <label for="car-model" class="mk-field__label">Модель *</label>
                                <div class="mk-combobox" id="model-combobox">
                                    <input type="text" id="car-model" class="mk-field__input mk-combobox__input"
                                           placeholder="Сначала выберите марку" autocomplete="off" disabled
                                           role="combobox" aria-expanded="false" aria-autocomplete="list"
                                           aria-controls="model-combobox-list" required/>
                                    <input type="hidden" id="car-model-id" name="car-model-id">
                                    <ul class="mk-combobox__list" id="model-combobox-list" role="listbox"></ul>
                                </div>
                                <div class="mk-field__error" id="car-model-error"></div>
                            </div>
                        </div>
                        <div class="mk-form__grid">
                            <div class="mk-field">
                                <label for="car-year" class="mk-field__label">Год выпуска *</label>
                                <input type="number" id="car-year" class="mk-field__input mk-field__input--numeric"
                                       placeholder="2026" min="1980" max="2026" required/>
                                <div class="mk-field__error" id="car-year-error"></div>
                            </div>
                            <div class="mk-field">
                                <label for="car-body" class="mk-field__label">Тип кузова</label>
                                <select id="car-body" class="mk-field__input">
                                    <option value="">Выберите тип</option>
                                    <option value="sedan">Седан</option>
                                    <option value="hatchback">Хэтчбек</option>
                                    <option value="suv">Внедорожник</option>
                                    <option value="coupe">Купе</option>
                                    <option value="wagon">Универсал</option>
                                    <option value="minivan">Минивэн</option>
                                    <option value="pickup">Пикап</option>
                                </select>
                                <div class="mk-field__error" id="car-body-error"></div>
                            </div>
                        </div>
                        <div class="mk-form__grid">
                            <div class="mk-field">
                                <label for="car-color" class="mk-field__label">Цвет</label>
                                <div class="mk-color-select">
                                    <select id="car-color" class="mk-field__input">
                                        <option value="">Выберите цвет</option>
                                        <option value="#FFFFFF">Белый</option>
                                        <option value="#000000">Чёрный</option>
                                        <option value="#C0C0C0">Серебристый</option>
                                        <option value="#808080">Серый</option>
                                        <option value="#0000FF">Синий</option>
                                        <option value="#FF0000">Красный</option>
                                        <option value="#008000">Зелёный</option>
                                        <option value="#FFD700">Жёлтый</option>
                                        <option value="#FFA500">Оранжевый</option>
                                        <option value="#8B4513">Коричневый</option>
                                        <option value="#800080">Фиолетовый</option>
                                        <option value="#FFC0CB">Розовый</option>
                                        <option value="#FFD700">Золотой</option>
                                        <option value="#F5DEB3">Бежевый</option>
                                    </select>
                                    <span class="mk-color-preview" id="color-preview" style="background:#ccc;"></span>
                                </div>
                                <div class="mk-field__error" id="car-color-error"></div>
                            </div>
                            <div class="mk-field"></div> <!-- пусто для выравнивания -->
                        </div>
                    </div>

                    <!-- Секция 2: Технические характеристики -->
                    <div class="mk-form-section">
                        <h2 class="mk-form-section__title">Технические характеристики</h2>
                        <div class="mk-form__grid">
                            <div class="mk-field">
                                <label for="car-engine-vol" class="mk-field__label">Объём двигателя (л)</label>
                                <select id="car-engine-vol" class="mk-field__input">
                                    <option value="">Выберите объём</option>
                                    <option value="0.8">0.8</option>
                                    <option value="1.0">1.0</option>
                                    <option value="1.2">1.2</option>
                                    <option value="1.4">1.4</option>
                                    <option value="1.5">1.5</option>
                                    <option value="1.6">1.6</option>
                                    <option value="1.8">1.8</option>
                                    <option value="2.0">2.0</option>
                                    <option value="2.2">2.2</option>
                                    <option value="2.4">2.4</option>
                                    <option value="2.5">2.5</option>
                                    <option value="2.8">2.8</option>
                                    <option value="3.0">3.0</option>
                                    <option value="3.2">3.2</option>
                                    <option value="3.5">3.5</option>
                                    <option value="4.0">4.0</option>
                                    <option value="4.4">4.4</option>
                                    <option value="5.0">5.0</option>
                                    <option value="5.5">5.5</option>
                                    <option value="6.0">6.0</option>
                                </select>
                                <div class="mk-field__error" id="car-engine-vol-error"></div>
                            </div>
                            <div class="mk-field">
                                <label for="car-transmission" class="mk-field__label">Тип КПП</label>
                                <select id="car-transmission" class="mk-field__input">
                                    <option value="">Выберите КПП</option>
                                    <option value="manual">Механика</option>
                                    <option value="automatic">Автомат</option>
                                    <option value="robot">Робот</option>
                                    <option value="cvt">Вариатор</option>
                                </select>
                                <div class="mk-field__error" id="car-transmission-error"></div>
                            </div>
                        </div>
                        <div class="mk-form__grid">
                            <div class="mk-field">
                                <label for="car-vin" class="mk-field__label">VIN-номер</label>
                                <input type="text" id="car-vin" class="mk-field__input mk-field__input--mono"
                                       placeholder="WBA... (17 символов)" maxlength="17"/>
                                <div class="mk-field__error" id="car-vin-error"></div>
                            </div>
                            <div class="mk-field"></div>
                        </div>
                    </div>

                    <!-- Секция 3: Регистрационные данные -->
                    <div class="mk-form-section">
                        <h2 class="mk-form-section__title">Регистрационные данные</h2>
                        <div class="mk-form__grid">
                            <div class="mk-field">
                                <label for="car-plate" class="mk-field__label">Государственный номер</label>
                                <input type="text" id="car-plate" class="mk-field__input mk-field__input--mono"
                                       placeholder="А000АА (буквы и цифры)"/>
                                <div class="mk-field__error" id="car-plate-error"></div>
                            </div>
                            <div class="mk-field">
                                <label for="car-plate-region" class="mk-field__label">Регион</label>
                                <input type="text" id="car-plate-region" class="mk-field__input mk-field__input--mono"
                                       placeholder="116" maxlength="3"/>
                                <div class="mk-field__error" id="car-plate-region-error"></div>
                            </div>
                        </div>
                        <div class="mk-form__grid">
                            <div class="mk-field">
                                <label for="car-mileage" class="mk-field__label">Текущий пробег (км) *</label>
                                <input type="number" id="car-mileage" class="mk-field__input mk-field__input--numeric"
                                       placeholder="0" min="0" required/>
                                <div class="mk-field__error" id="car-mileage-error"></div>
                            </div>
                            <div class="mk-field"></div>
                        </div>
                    </div>

                    <!-- Секция 4: Дополнительно -->
                    <div class="mk-form-section">
                        <h2 class="mk-form-section__title">Дополнительно</h2>
                        <div class="mk-field mk-field--full">
                            <label for="car-comment" class="mk-field__label">Комментарий</label>
                            <textarea id="car-comment" class="mk-field__input mk-field__input--textarea" rows="3"
                                      placeholder="Дополнительная информация об автомобиле..."></textarea>
                            <div class="mk-field__error" id="car-comment-error"></div>
                        </div>
                    </div>

                    <!-- Кнопки -->
                    <div class="mk-form__actions">
                        <a href="garage.html" class="mk-btn mk-btn--ghost mk-btn--lg">Отмена</a>
                        <button type="submit" class="mk-btn mk-btn--primary mk-btn--lg">Сохранить авто</button>
                    </div>
                </form>
            </div>

        </div>
    </main>

    @include('layouts.private.footer')

</div> <!-- /.mk-shell -->

<!-- ======== ТОСТЫ ======== -->
<div class="mk-toast-container" aria-live="polite"></div>

</body>
</html>
