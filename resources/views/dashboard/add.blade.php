<!DOCTYPE html>
<html lang="ru">
<head>
    @include('layouts.landing-head')
</head>
<body>

<!-- ======== СКРИМ ======== -->
<div class="mk-scrim" aria-hidden="true"></div>

<!-- ======== САЙДБАР ======== -->
<aside class="mk-sidebar" role="navigation" aria-label="Главное меню">
    <div class="mk-sidebar__brand">
        <a href="/" class="mk-logo" aria-label="MOTORKEEP — на главную">
            <span class="mk-logo__mark"><i class="bi bi-car-front-fill"></i></span>
            <span class="mk-logo__text">MOTOR<span class="mk-logo__text-accent">KEEP</span></span>
        </a>
    </div>
    <nav class="mk-sidebar__nav">
        <div class="mk-navlabel">Меню</div>
        <a href="garage.html" class="mk-navitem" data-tip="Гараж">
            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            <span class="lbl">Гараж</span>
        </a>
        <a href="#" class="mk-navitem mk-navitem--active" data-tip="Автомобили">
            <svg viewBox="0 0 24 24"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="8" cy="18" r="2"/><circle cx="16" cy="18" r="2"/><path d="M2 10h20"/></svg>
            <span class="lbl">Автомобили</span>
        </a>
        <a href="#" class="mk-navitem" data-tip="Статистика">
            <svg viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
            <span class="lbl">Статистика</span>
        </a>
        <div class="mk-navlabel">Гараж</div>
        <a href="#" class="mk-navitem" data-tip="Напоминания">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span class="lbl">Напоминания</span>
            <span class="pill">3</span>
        </a>
        <a href="#" class="mk-navitem" data-tip="Расходы">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
            <span class="lbl">Расходы</span>
        </a>
    </nav>
    <div class="mk-sidebar__foot">
        <a href="#" class="mk-navitem" data-tip="Настройки">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
            <span class="lbl">Настройки</span>
        </a>
        <button class="mk-collapse" aria-label="Свернуть сайдбар">
            <svg viewBox="0 0 24 24" width="20" height="20"><polyline points="15 18 9 12 15 6"/></svg>
            <span>Свернуть</span>
        </button>
        <button class="mk-navitem mk-logout" data-tip="Выйти">
            <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            <span class="lbl">Выйти</span>
        </button>
    </div>
</aside>

<!-- ======== ОСНОВНАЯ ОБОЛОЧКА ======== -->
<div class="mk-shell">

    <!-- ======== ХЕДЕР ======== -->
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
                    <svg viewBox="0 0 24 24"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
                    <span class="dot" aria-hidden="true"></span>
                </button>
                <button class="mk-userchip" aria-label="Профиль пользователя">
                    <span class="mk-userchip__avatar">И</span>
                    <span class="mk-userchip__name">Иван</span>
                </button>
            </div>
        </div>
    </header>

    <!-- ======== ОСНОВНОЙ КОНТЕНТ ======== -->
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
                                <input type="text" id="car-brand" class="mk-field__input" list="brand-list" placeholder="Начните вводить марку" autocomplete="off" required />
                                <datalist id="brand-list">
                                    <option value="Acura"><option value="Alfa Romeo"><option value="Aston Martin">
                                    <option value="Audi"><option value="Bentley"><option value="BMW">
                                    <option value="Bugatti"><option value="Cadillac"><option value="Chevrolet">
                                    <option value="Chrysler"><option value="Citroën"><option value="Dodge">
                                    <option value="Ferrari"><option value="Fiat"><option value="Ford">
                                    <option value="Honda"><option value="Hyundai"><option value="Infiniti">
                                    <option value="Jaguar"><option value="Jeep"><option value="Kia">
                                    <option value="Lamborghini"><option value="Land Rover"><option value="Lexus">
                                    <option value="Maserati"><option value="Mazda"><option value="McLaren">
                                    <option value="Mercedes-Benz"><option value="Mini"><option value="Mitsubishi">
                                    <option value="Nissan"><option value="Opel"><option value="Peugeot">
                                    <option value="Porsche"><option value="Renault"><option value="Rolls-Royce">
                                    <option value="Saab"><option value="Seat"><option value="Skoda">
                                    <option value="Smart"><option value="Subaru"><option value="Suzuki">
                                    <option value="Tesla"><option value="Toyota"><option value="Volkswagen">
                                    <option value="Volvo"><option value="Lada"><option value="ГАЗ"><option value="УАЗ"><option value="ВАЗ">
                                </datalist>
                                <div class="mk-field__error" id="car-brand-error"></div>
                            </div>
                            <div class="mk-field">
                                <label for="car-model" class="mk-field__label">Модель *</label>
                                <input type="text" id="car-model" class="mk-field__input" list="model-list" placeholder="Например: 320i" autocomplete="off" required />
                                <datalist id="model-list">
                                    <option value="1 серия"><option value="2 серия"><option value="3 серия">
                                    <option value="4 серия"><option value="5 серия"><option value="6 серия">
                                    <option value="7 серия"><option value="8 серия"><option value="X1"><option value="X2">
                                    <option value="X3"><option value="X4"><option value="X5"><option value="X6"><option value="X7">
                                    <option value="i3"><option value="i4"><option value="i5"><option value="i7"><option value="iX">
                                    <option value="A1"><option value="A2"><option value="A3"><option value="A4"><option value="A5">
                                    <option value="A6"><option value="A7"><option value="A8"><option value="Q2"><option value="Q3">
                                    <option value="Q4"><option value="Q5"><option value="Q6"><option value="Q7"><option value="Q8">
                                    <option value="e-tron"><option value="e-tron GT">
                                    <option value="Corolla"><option value="Camry"><option value="Prius"><option value="RAV4">
                                    <option value="Highlander"><option value="Land Cruiser"><option value="Hilux">
                                    <option value="C-HR"><option value="Yaris"><option value="Auris">
                                    <option value="Civic"><option value="Accord"><option value="CR-V"><option value="HR-V">
                                    <option value="Pilot"><option value="Odyssey"><option value="Fit">
                                    <option value="Focus"><option value="Fiesta"><option value="Mondeo"><option value="Kuga">
                                    <option value="Mustang"><option value="Explorer"><option value="Ranger">
                                    <option value="Golf"><option value="Passat"><option value="Tiguan"><option value="Touareg">
                                    <option value="Polo"><option value="Jetta"><option value="Arteon"><option value="ID.3"><option value="ID.4">
                                    <option value="Octavia"><option value="Superb"><option value="Kodiaq"><option value="Fabia">
                                    <option value="Rio"><option value="Sportage"><option value="Ceed"><option value="Sorento">
                                    <option value="Solaris"><option value="Elantra"><option value="Tucson"><option value="Santa Fe">
                                    <option value="Granta"><option value="Vesta"><option value="Priora"><option value="Niva">
                                    <option value="Patriot"><option value="Hunter"><option value="Bukhanka">
                                </datalist>
                                <div class="mk-field__error" id="car-model-error"></div>
                            </div>
                        </div>
                        <div class="mk-form__grid">
                            <div class="mk-field">
                                <label for="car-year" class="mk-field__label">Год выпуска *</label>
                                <input type="number" id="car-year" class="mk-field__input mk-field__input--numeric" placeholder="2026" min="1980" max="2026" required />
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
                                    <option value="0.8">0.8</option><option value="1.0">1.0</option>
                                    <option value="1.2">1.2</option><option value="1.4">1.4</option>
                                    <option value="1.5">1.5</option><option value="1.6">1.6</option>
                                    <option value="1.8">1.8</option><option value="2.0">2.0</option>
                                    <option value="2.2">2.2</option><option value="2.4">2.4</option>
                                    <option value="2.5">2.5</option><option value="2.8">2.8</option>
                                    <option value="3.0">3.0</option><option value="3.2">3.2</option>
                                    <option value="3.5">3.5</option><option value="4.0">4.0</option>
                                    <option value="4.4">4.4</option><option value="5.0">5.0</option>
                                    <option value="5.5">5.5</option><option value="6.0">6.0</option>
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
                                <input type="text" id="car-vin" class="mk-field__input mk-field__input--mono" placeholder="WBA... (17 символов)" maxlength="17" />
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
                                <input type="text" id="car-plate" class="mk-field__input mk-field__input--mono" placeholder="А000АА (буквы и цифры)" />
                                <div class="mk-field__error" id="car-plate-error"></div>
                            </div>
                            <div class="mk-field">
                                <label for="car-plate-region" class="mk-field__label">Регион</label>
                                <input type="text" id="car-plate-region" class="mk-field__input mk-field__input--mono" placeholder="116" maxlength="3" />
                                <div class="mk-field__error" id="car-plate-region-error"></div>
                            </div>
                        </div>
                        <div class="mk-form__grid">
                            <div class="mk-field">
                                <label for="car-mileage" class="mk-field__label">Текущий пробег (км) *</label>
                                <input type="number" id="car-mileage" class="mk-field__input mk-field__input--numeric" placeholder="0" min="0" required />
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
                            <textarea id="car-comment" class="mk-field__input mk-field__input--textarea" rows="3" placeholder="Дополнительная информация об автомобиле..."></textarea>
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

    <!-- ======== ФУТЕР ======== -->
    <footer class="mk-footer" role="contentinfo">
        <div class="mk-container">
            <div class="mk-footer__inner">
                <div class="mk-footer__brand">
                    <a href="/" class="mk-logo mk-logo--sm" aria-label="MOTORKEEP — на главную">
                        <span class="mk-logo__mark"><i class="bi bi-car-front-fill"></i></span>
                        <span class="mk-logo__text">MOTOR<span class="mk-logo__text-accent">KEEP</span></span>
                    </a>
                    <span class="mk-footer__copy">© 2026</span>
                </div>
                <nav class="mk-footer__links" aria-label="Нижняя навигация">
                    <a href="#help">Помощь</a>
                    <a href="#privacy">Конфиденциальность</a>
                    <a href="#contacts">Контакты</a>
                </nav>
            </div>
        </div>
    </footer>

</div> <!-- /.mk-shell -->

<!-- ======== ТОСТЫ ======== -->
<div class="mk-toast-container" aria-live="polite"></div>

<script src="add-car.js"></script>
</body>
</html>
