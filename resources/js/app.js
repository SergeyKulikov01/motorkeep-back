import './login.js';
import './dashboard.js';
import './add.js';
import './detail.js';
import './forgot-pass.js';
import './pass-reset.js';
import './stats.js';
import './settings.js';

// ---------- CSRF / FETCH ----------
export function getCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.content : '';
}
// Форматирует целое число в "12 345 ₽" (разбиение по 3 знака + знак рубля)
export function formatRub(amount) {
    return `${new Intl.NumberFormat('ru-RU').format(amount)} ₽`;
}
// Единая обёртка над fetch: подставляет CSRF-заголовок, credentials
// и всегда безопасно разбирает JSON-ответ (даже если тело пустое).
// Общая для всех страниц — остальные файлы импортируют её из app.js
// вместо того, чтобы определять свою копию.
export function fetchJson(url, options = {}) {
    const { headers, ...rest } = options;
    return fetch(url, {
        credentials: 'same-origin',
        ...rest,
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
            ...headers,
        },
    }).then(function (res) {
        return res.json().catch(function () { return {}; }).then(function (json) {
            return { ok: res.ok, data: json };
        });
    });
}

// ---------- ФОРМАТИРОВАНИЕ ЧИСЕЛ ----------
// Общий формат для сумм и пробега (разряды через пробел, ru-RU).
export function formatNumber(num) {
    return new Intl.NumberFormat('ru-RU').format(num);
}

// ---------- ТОСТЫ ----------
// Единственная реализация на всё приложение — остальные файлы
// импортируют showToast из app.js вместо того, чтобы определять свою копию.
export function showToast(message, type) {
    const container = document.querySelector('.mk-toast-container');
    if (!container) return;

    const colors = {
        success: 'var(--mk-success)',
        error: 'var(--mk-danger)',
        warning: 'var(--mk-warning)',
        info: 'var(--mk-primary)'
    };

    const toast = document.createElement('div');
    toast.className = 'mk-toast';
    const dot = document.createElement('span');
    dot.className = 'mk-toast__dot';
    dot.style.background = colors[type] || colors.info;
    toast.appendChild(dot);
    toast.appendChild(document.createTextNode(message));

    container.appendChild(toast);

    // Автоматическое исчезновение через 3.5 сек
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(20px)';
        toast.style.transition = 'opacity 300ms, transform 300ms';
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 3500);
}

// ---------- САЙДБАР: СВЁРТКА ----------
export function initSidebarCollapse() {
    const sidebar = document.querySelector('.mk-sidebar');
    const collapseBtn = document.querySelector('.mk-collapse');
    const body = document.body;

    // Восстановить состояние из localStorage
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
}

// ---------- МОБИЛЬНЫЙ DRAWER (бургер) ----------
export function handleEsc(e) {
    if (e.key === 'Escape') {
        closeNav();
    }
}

export function openNav() {
    document.body.classList.add('nav-open');
    document.addEventListener('keydown', handleEsc);
}

export function closeNav() {
    document.body.classList.remove('nav-open');
    document.removeEventListener('keydown', handleEsc);
}

export function initMobileDrawer() {
    const burger = document.querySelector('.mk-burger');
    const scrim = document.querySelector('.mk-scrim');

    if (burger) {
        burger.addEventListener('click', function () {
            if (document.body.classList.contains('nav-open')) {
                closeNav();
            } else {
                openNav();
            }
        });
    }

    if (scrim) {
        scrim.addEventListener('click', closeNav);
    }

    // Закрывать по клику на пункт меню (навигация)
    document.querySelectorAll('.mk-sidebar .mk-navitem').forEach(item => {
        item.addEventListener('click', function () {
            if (window.innerWidth <= 900) {
                closeNav();
            }
        });
    });
}

// ---------- ЛЕНДИНГ: МОБИЛЬНОЕ МЕНЮ ----------
export function initLandingMobileMenu() {
    const landingBurger = document.querySelector('.mk-landing-burger');
    const mobileMenu = document.querySelector('.mk-landing-mobile-menu');

    if (!landingBurger || !mobileMenu) return;

    landingBurger.addEventListener('click', function () {
        mobileMenu.classList.toggle('open');
    });

    // Закрыть при клике на ссылку
    mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function () {
            mobileMenu.classList.remove('open');
        });
    });
}

// ---------- ПОИСК ----------
export function initSearch() {
    const searchInputs = document.querySelectorAll('.mk-search input');
    searchInputs.forEach(input => {
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                console.log('Поиск:', this.value);
                // Здесь можно запустить поиск
            }
        });
    });
}

// Глобальный хоткей ⌘K / Ctrl+K для фокуса на поиске
export function initSearchHotkey() {
    document.addEventListener('keydown', function (e) {
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
            e.preventDefault();
            const searchField = document.querySelector('.mk-search input');
            if (searchField) {
                searchField.focus();
            }
        }
    });
}

// ---------- ЗАКРЫТИЕ МОДАЛОК (оверлей) ----------
export function initModalOverlays() {
    document.querySelectorAll('.mk-overlay').forEach(overlay => {
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) {
                overlay.classList.remove('mk-overlay--open');
            }
        });
        // Кнопка закрытия
        overlay.querySelector('.mk-modal__close')?.addEventListener('click', function () {
            overlay.classList.remove('mk-overlay--open');
        });
        // Escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && overlay.classList.contains('mk-overlay--open')) {
                overlay.classList.remove('mk-overlay--open');
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
    initSidebarCollapse();
    initMobileDrawer();
    initLandingMobileMenu();
    initSearch();
    initSearchHotkey();
    initModalOverlays();

    console.log('MOTORKEEP инициализирован');
});
