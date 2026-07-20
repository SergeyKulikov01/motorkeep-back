import './login.js';
import './dashboard.js';
import './add.js';
import './detail.js';
import './forgot-pass.js';
import './pass-reset.js';

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

// ---------- ФИЛЬТРЫ (чипы) ----------
export function initFilterChips() {
    document.querySelectorAll('.mk-chips').forEach(chipContainer => {
        const chips = chipContainer.querySelectorAll('.mk-chip');
        chips.forEach(chip => {
            chip.addEventListener('click', function () {
                // Снять активный класс со всех в этом контейнере
                chips.forEach(c => c.classList.remove('mk-chip--active'));
                this.classList.add('mk-chip--active');
                // Здесь можно добавить логику фильтрации (пока заглушка)
                console.log('Фильтр выбран:', this.textContent.trim());
            });
        });

        // По умолчанию активировать первый, если нет активного
        if (!chipContainer.querySelector('.mk-chip--active') && chips.length) {
            chips[0].classList.add('mk-chip--active');
        }
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
    initFilterChips();
    initSearch();
    initSearchHotkey();
    initModalOverlays();

    console.log('MOTORKEEP инициализирован');
});