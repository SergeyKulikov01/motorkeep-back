
(function () {
    'use strict';

    function getElements() {
        return {
            colorSelect: document.getElementById('car-color'),
            colorPreview: document.getElementById('color-preview'),
            form: document.getElementById('add-car-form'),
            brand: document.getElementById('car-brand'),
            brandId: document.getElementById('car-brand-id'),
            model: document.getElementById('car-model'),
            modelId: document.getElementById('car-model-id'),
            year: document.getElementById('car-year'),
            bodyType: document.getElementById('car-body'),
            color: document.getElementById('car-color'),
            engineVol: document.getElementById('car-engine-vol'),
            transmission: document.getElementById('car-transmission'),
            vin: document.getElementById('car-vin'),
            plate: document.getElementById('car-plate'),
            plateRegion: document.getElementById('car-plate-region'),
            mileage: document.getElementById('car-mileage'),
            comment: document.getElementById('car-comment'),
            errorElements: {
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
            }
        };
    }

    // ---------- ВАЛИДАТОРЫ ----------
    function isNotEmpty(val) {
        return val.trim().length > 0;
    }

    // Марка/модель валидны, только если реально выбраны из списка БД
    // (т.е. заполнено скрытое поле с id), а не просто напечатан текст.
    function isSelected(hiddenInput) {
        return function () {
            return hiddenInput.value.trim().length > 0;
        };
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

    function buildFieldsConfig(els) {
        return [
            { input: els.brand, error: els.errorElements.brand, validator: isSelected(els.brandId), msg: 'Выберите марку из списка' },
            { input: els.model, error: els.errorElements.model, validator: isSelected(els.modelId), msg: 'Выберите модель из списка' },
            { input: els.year, error: els.errorElements.year, validator: isValidYear, msg: 'Год должен быть от 1980 до 2026' },
            { input: els.mileage, error: els.errorElements.mileage, validator: isValidMileage, msg: 'Введите неотрицательное число' },
            { input: els.vin, error: els.errorElements.vin, validator: isValidVIN, msg: 'VIN должен содержать 17 символов (буквы и цифры)' },
            { input: els.plate, error: els.errorElements.plate, validator: isValidPlate, msg: 'Некорректный номер (буквы и цифры)' },
            { input: els.plateRegion, error: els.errorElements.plateRegion, validator: isValidPlateRegion, msg: 'Регион — только цифры (1-3)' }
        ];
    }

    // ---------- ЦВЕТОВОЙ ПРЕВЬЮ ----------
    function initColorPreview(colorSelect, colorPreview) {
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
    }

    // ---------- КОМБОБОКС С ПОИСКОМ (МАРКА / МОДЕЛЬ) ----------
    function debounce(fn, delay) {
        let timer = null;
        return function (...args) {
            clearTimeout(timer);
            timer = setTimeout(() => fn.apply(this, args), delay);
        };
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    // Оборачивает совпавшую часть названия в <mark>, остальное экранирует
    function highlightMatch(name, query) {
        const q = query.trim();
        if (!q) return escapeHtml(name);

        const idx = name.toLowerCase().indexOf(q.toLowerCase());
        if (idx === -1) return escapeHtml(name);

        const before = name.slice(0, idx);
        const match = name.slice(idx, idx + q.length);
        const after = name.slice(idx + q.length);
        return escapeHtml(before) + '<mark>' + escapeHtml(match) + '</mark>' + escapeHtml(after);
    }

    // Создаёт кастомный выпадающий список с AJAX-поиском.
    // wrapper/input/hiddenInput/list — элементы разметки;
    // fetchItems(query) — функция, возвращающая Promise<Array<{id, name}>>;
    // onSelect/onClear — колбэки при выборе варианта и при сбросе выбора.
    function createCombobox({ wrapper, input, hiddenInput, list, minChars, fetchItems, onSelect, onClear }) {
        let items = [];
        let activeIndex = -1;
        let currentQuery = '';
        let requestToken = 0;

        function open() {
            list.classList.add('mk-combobox__list--open');
            input.setAttribute('aria-expanded', 'true');
        }

        function close() {
            list.classList.remove('mk-combobox__list--open');
            input.setAttribute('aria-expanded', 'false');
            activeIndex = -1;
        }

        function renderMessage(text, className) {
            list.innerHTML = '';
            const li = document.createElement('li');
            li.className = className;
            li.textContent = text;
            list.appendChild(li);
            open();
        }

        function setActive(index) {
            const options = list.querySelectorAll('.mk-combobox__option');
            options.forEach(o => {
                o.classList.remove('mk-combobox__option--active');
                o.setAttribute('aria-selected', 'false');
            });
            if (index >= 0 && index < options.length) {
                options[index].classList.add('mk-combobox__option--active');
                options[index].setAttribute('aria-selected', 'true');
                options[index].scrollIntoView({ block: 'nearest' });
            }
            activeIndex = index;
        }

        function select(item) {
            input.value = item.name;
            hiddenInput.value = item.id;
            close();
            if (onSelect) onSelect(item);
        }

        function clearSelection() {
            if (!hiddenInput.value) return;
            hiddenInput.value = '';
            if (onClear) onClear();
        }

        function renderItems(results, query) {
            items = results;
            activeIndex = -1;
            list.innerHTML = '';

            if (!results.length) {
                renderMessage('Ничего не найдено', 'mk-combobox__empty');
                return;
            }

            results.forEach((item, index) => {
                const li = document.createElement('li');
                li.className = 'mk-combobox__option';
                li.setAttribute('role', 'option');
                li.setAttribute('aria-selected', 'false');
                li.dataset.index = String(index);
                li.innerHTML = highlightMatch(item.name, query);
                li.addEventListener('mousedown', function (e) {
                    // mousedown вместо click — чтобы сработать раньше blur
                    // и не потерять список из-за скрытия по потере фокуса
                    e.preventDefault();
                    select(item);
                });
                list.appendChild(li);
            });

            open();
        }

        const runSearch = debounce(function (query) {
            const token = ++requestToken;
            renderMessage('Поиск…', 'mk-combobox__loading');

            fetchItems(query)
                .then(results => {
                    if (token !== requestToken) return; // ответ устарел — игнорируем
                    renderItems(results, query);
                })
                .catch(() => {
                    if (token !== requestToken) return;
                    renderMessage('Не удалось загрузить список', 'mk-combobox__empty');
                });
        }, 300);

        input.addEventListener('input', function () {
            currentQuery = this.value.trim();
            clearSelection();

            if (currentQuery.length < minChars) {
                close();
                return;
            }
            runSearch(currentQuery);
        });

        input.addEventListener('focus', function () {
            if (this.disabled || currentQuery.length < minChars) return;
            runSearch(currentQuery);
        });

        input.addEventListener('blur', close);

        input.addEventListener('keydown', function (e) {
            const isOpen = list.classList.contains('mk-combobox__list--open');

            if (!isOpen && (e.key === 'ArrowDown' || e.key === 'ArrowUp') && currentQuery.length >= minChars) {
                runSearch(currentQuery);
                return;
            }
            if (!isOpen) return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                setActive(Math.min(activeIndex + 1, items.length - 1));
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                setActive(Math.max(activeIndex - 1, 0));
            } else if (e.key === 'Enter') {
                if (activeIndex >= 0 && items[activeIndex]) {
                    e.preventDefault();
                    select(items[activeIndex]);
                }
            } else if (e.key === 'Escape') {
                close();
            }
        });

        document.addEventListener('click', function (e) {
            if (!wrapper.contains(e.target)) {
                close();
            }
        });

        return {
            reset() {
                input.value = '';
                hiddenInput.value = '';
                currentQuery = '';
                items = [];
                close();
            },
            disable() {
                input.disabled = true;
                input.value = '';
                hiddenInput.value = '';
                currentQuery = '';
                close();
            },
            enable() {
                input.disabled = false;
            }
        };
    }

    function fetchJson(url) {
        return fetch(url, { credentials: 'same-origin' }).then(res => {
            if (!res.ok) return Promise.reject(new Error('request failed'));
            return res.json();
        });
    }

    function initBrandModelComboboxes(els) {
        let selectedBrandId = null;

        const modelCombobox = createCombobox({
            wrapper: document.getElementById('model-combobox'),
            input: els.model,
            hiddenInput: els.modelId,
            list: document.getElementById('model-combobox-list'),
            minChars: 0,
            fetchItems(query) {
                const params = new URLSearchParams({ brand_id: selectedBrandId, name: query });
                return fetchJson(`/api/getModels?${params}`);
            }
        });

        const brandCombobox = createCombobox({
            wrapper: document.getElementById('brand-combobox'),
            input: els.brand,
            hiddenInput: els.brandId,
            list: document.getElementById('brand-combobox-list'),
            minChars: 1,
            fetchItems(query) {
                const params = new URLSearchParams({ brand: query });
                return fetchJson(`/api/getBrands?${params}`);
            },
            onSelect(item) {
                selectedBrandId = item.id;
                modelCombobox.reset();
                modelCombobox.enable();
                els.model.focus();
            },
            onClear() {
                selectedBrandId = null;
                modelCombobox.reset();
                modelCombobox.disable();
            }
        });

        modelCombobox.disable();
    }

    // ---------- ВАЛИДАЦИЯ ПОЛЕЙ ПРИ ВВОДЕ ----------
    function initFieldValidation(fields) {
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
    }

    function validateForm(fields) {
        let valid = true;
        fields.forEach(f => {
            if (!validateField(f.input, f.error, f.validator, f.msg)) {
                valid = false;
            }
        });
        return valid;
    }

    function collectCarData(els) {
        return {
            brandId: parseInt(els.brandId.value),
            brandName: els.brand.value.trim(),
            modelId: parseInt(els.modelId.value),
            modelName: els.model.value.trim(),
            year: parseInt(els.year.value),
            bodyType: els.bodyType.value,
            color: els.color.value,
            engine: els.engineVol.value,
            transmission: els.transmission.value,
            vin: els.vin.value.trim(),
            plate: els.plate.value.trim(),
            region: els.plateRegion.value.trim(),
            mileage: parseInt(els.mileage.value),
            comment: els.comment.value.trim()
        };
    }

    function submitCarData(form, carData) {
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
    }

    // ---------- ОТПРАВКА ФОРМЫ ----------
    function initFormSubmit(els, fields) {
        els.form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (!validateForm(fields)) {
                if (typeof window.showToast === 'function') {
                    window.showToast('Пожалуйста, исправьте ошибки в форме', 'error');
                }
                return;
            }

            submitCarData(els.form, collectCarData(els));
        });
    }

    // Тосты показываются через общую window.showToast из app.js.

    // ---------- ИНИЦИАЛИЗАЦИЯ ----------
    function init() {
        const els = getElements();

        // Скрипт грузится на всех страницах через общий app.js —
        // выполняем логику только там, где есть форма добавления авто.
        if (!els.colorSelect || !els.form) {
            return;
        }

        initColorPreview(els.colorSelect, els.colorPreview);
        initBrandModelComboboxes(els);

        const fields = buildFieldsConfig(els);
        initFieldValidation(fields);
        initFormSubmit(els, fields);

        console.log('Страница добавления авто инициализирована');
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();