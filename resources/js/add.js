
(function () {
    'use strict';

    // ---------- САЙДБАР ----------
    const sidebar = document.querySelector('.mk-sidebar');
    const collapseBtn = document.querySelector('.mk-collapse');
    const body = document.body;

    const savedCollapsed = localStorage.getItem('mk-collapsed');
    if (savedCollapsed === 'true' && sidebar) {
        body.classList.add('is-collapsed');
    }

    if (collapseBtn) {
        collapseBtn.addEventListener('click', function () {
            const isCollapsed = body.classList.toggle('is-collapsed');
            localStorage.setItem('mk-collapsed', isCollapsed);
        });
    }

    // Мобильный бургер
    const burger = document.querySelector('.mk-burger');
    const scrim = document.querySelector('.mk-scrim');

    function openNav() {
        body.classList.add('nav-open');
        document.addEventListener('keydown', handleEsc);
    }
    function closeNav() {
        body.classList.remove('nav-open');
        document.removeEventListener('keydown', handleEsc);
    }
    function handleEsc(e) {
        if (e.key === 'Escape') closeNav();
    }

    if (burger) {
        burger.addEventListener('click', function () {
            if (body.classList.contains('nav-open')) closeNav();
            else openNav();
        });
    }
    if (scrim) scrim.addEventListener('click', closeNav);

    document.querySelectorAll('.mk-sidebar .mk-navitem').forEach(item => {
        item.addEventListener('click', function () {
            if (window.innerWidth <= 900) closeNav();
        });
    });

    // ---------- ЦВЕТОВОЙ ПРЕВЬЮ ----------
    const colorSelect = document.getElementById('car-color');
    const colorPreview = document.getElementById('color-preview');

    colorSelect.addEventListener('change', function () {
        const val = this.value;
        if (val) {
            colorPreview.style.background = val;
            colorPreview.style.borderColor = val;
        } else {
            colorPreview.style.background = '#ccc';
            colorPreview.style.borderColor = 'var(--mk-border)';
        }
    });

    // ---------- ФОРМА ----------
    const form = document.getElementById('add-car-form');

    // Поля
    const brand = document.getElementById('car-brand');
    const model = document.getElementById('car-model');
    const year = document.getElementById('car-year');
    const bodyType = document.getElementById('car-body');
    const color = document.getElementById('car-color');
    const engineVol = document.getElementById('car-engine-vol');
    const transmission = document.getElementById('car-transmission');
    const vin = document.getElementById('car-vin');
    const plate = document.getElementById('car-plate');
    const plateRegion = document.getElementById('car-plate-region');
    const mileage = document.getElementById('car-mileage');
    const comment = document.getElementById('car-comment');

    // Элементы ошибок
    const errorElements = {
        brand: document.getElementById('car-brand-error'),
        model: document.getElementById('car-model-error'),
        year: document.getElementById('car-year-error'),
        body: document.getElementById('car-body-error'),
        color: document.getElementById('car-color-error'),
        engine: document.getElementById('car-engine-vol-error'),
        transmission: document.getElementById('car-transmission-error'),
        vin: document.getElementById('car-vin-error'),
        plate: document.getElementById('car-plate-error'),
        plateRegion: document.getElementById('car-plate-region-error'),
        mileage: document.getElementById('car-mileage-error'),
        comment: document.getElementById('car-comment-error')
    };

    // Валидаторы
    function isNotEmpty(val) {
        return val.trim().length > 0;
    }

    function isValidYear(val) {
        const num = parseInt(val);
        return !isNaN(num) && num >= 1980 && num <= new Date().getFullYear() + 1;
    }

    function isValidMileage(val) {
        const num = parseInt(val);
        return !isNaN(num) && num >= 0;
    }

    function isValidVIN(val) {
        return val.length === 0 || (val.length === 17 && /^[A-HJ-NPR-Z0-9]{17}$/i.test(val));
    }

    function isValidPlate(val) {
        // Простая проверка: буквы и цифры, длина от 4 до 9 символов
        return val.length === 0 || /^[А-ЯA-Z0-9]{4,9}$/i.test(val);
    }

    function isValidPlateRegion(val) {
        return val.length === 0 || /^[0-9]{1,3}$/.test(val);
    }

    // Валидация поля
    function validateField(input, errorEl, validator, message) {
        if (validator(input.value)) {
            errorEl.textContent = '';
            input.closest('.mk-field').classList.remove('mk-field--error');
            return true;
        } else {
            errorEl.textContent = message;
            input.closest('.mk-field').classList.add('mk-field--error');
            return false;
        }
    }

    // Навешиваем проверки на blur
    const fields = [
        { input: brand, error: errorElements.brand, validator: isNotEmpty, msg: 'Введите марку' },
        { input: model, error: errorElements.model, validator: isNotEmpty, msg: 'Введите модель' },
        { input: year, error: errorElements.year, validator: isValidYear, msg: 'Год должен быть от 1980 до 2026' },
        { input: mileage, error: errorElements.mileage, validator: isValidMileage, msg: 'Введите неотрицательное число' },
        { input: vin, error: errorElements.vin, validator: isValidVIN, msg: 'VIN должен содержать 17 символов (буквы и цифры)' },
        { input: plate, error: errorElements.plate, validator: isValidPlate, msg: 'Некорректный номер (буквы и цифры)' },
        { input: plateRegion, error: errorElements.plateRegion, validator: isValidPlateRegion, msg: 'Регион — только цифры (1-3)' }
    ];

    fields.forEach(f => {
        f.input.addEventListener('blur', function () {
            validateField(this, f.error, f.validator, f.msg);
        });
        f.input.addEventListener('input', function () {
            if (this.closest('.mk-field').classList.contains('mk-field--error')) {
                validateField(this, f.error, f.validator, f.msg);
            }
        });
    });

    // Отправка формы
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        let valid = true;

        // Обязательные
        if (!validateField(brand, errorElements.brand, isNotEmpty, 'Введите марку')) valid = false;
        if (!validateField(model, errorElements.model, isNotEmpty, 'Введите модель')) valid = false;
        if (!validateField(year, errorElements.year, isValidYear, 'Год должен быть от 1980 до 2026')) valid = false;
        if (!validateField(mileage, errorElements.mileage, isValidMileage, 'Введите неотрицательное число')) valid = false;

        // Необязательные
        if (!validateField(vin, errorElements.vin, isValidVIN, 'VIN должен содержать 17 символов')) valid = false;
        if (!validateField(plate, errorElements.plate, isValidPlate, 'Некорректный номер (буквы и цифры)')) valid = false;
        if (!validateField(plateRegion, errorElements.plateRegion, isValidPlateRegion, 'Регион — только цифры (1-3)')) valid = false;

        if (!valid) {
            if (typeof window.showToast === 'function') {
                window.showToast('Пожалуйста, исправьте ошибки в форме', 'error');
            }
            return;
        }

        // Сбор данных
        const carData = {
            brand: brand.value.trim(),
            model: model.value.trim(),
            year: parseInt(year.value),
            bodyType: bodyType.value,
            color: color.value,
            engine: engineVol.value,
            transmission: transmission.value,
            vin: vin.value.trim(),
            plate: plate.value.trim(),
            region: plateRegion.value.trim(),
            mileage: parseInt(mileage.value),
            comment: comment.value.trim()
        };

        console.log('Отправка данных:', carData);

        // Имитация отправки
        const btn = form.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.textContent = 'Сохранение...';

        setTimeout(() => {
            if (typeof window.showToast === 'function') {
                window.showToast('Автомобиль успешно добавлен!', 'success');
            }
            setTimeout(() => {
                window.location.href = 'garage.html';
            }, 1500);
        }, 1500);
    });

    // ---------- ТОСТЫ ----------
    if (typeof window.showToast !== 'function') {
        window.showToast = function (message, type) {
            const container = document.querySelector('.mk-toast-container');
            if (!container) return;
            const toast = document.createElement('div');
            toast.className = 'mk-toast';
            const dot = document.createElement('span');
            dot.className = 'mk-toast__dot';
            const colors = { success: 'var(--mk-success)', error: 'var(--mk-danger)', warning: 'var(--mk-warning)', info: 'var(--mk-primary)' };
            dot.style.background = colors[type] || colors.info;
            toast.appendChild(dot);
            toast.appendChild(document.createTextNode(message));
            container.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(20px)';
                toast.style.transition = 'opacity 300ms, transform 300ms';
                setTimeout(() => toast.remove(), 300);
            }, 3500);
        };
    }

    console.log('Страница добавления авто инициализирована');
})();
