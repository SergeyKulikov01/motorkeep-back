<header class="mk-header" role="banner">
    <div class="mk-header__inner">
        <button class="mk-burger" aria-label="Открыть меню">
            <span></span><span></span><span></span>
        </button>
        <div class="mk-header__title">
            Мой гараж
            <span class="mk-header__crumb">/ список авто</span>
        </div>
        <div class="mk-header__right">
            <!-- КОЛОКОЛЬЧИК с popover -->
            <div class="mk-popover-wrapper">
                <button class="mk-iconbtn js-notifications" aria-label="Уведомления" id="notif-btn">
                    <svg viewBox="0 0 24 24">
                        <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 01-3.46 0"/>
                    </svg>
                    <span class="dot" aria-hidden="true"></span>
                </button>
                <div class="mk-popover mk-popover--notifications" id="notif-popover">
                    <div class="mk-popover__header">
                        <span>Уведомления</span>
                        <span class="mk-popover__badge">3 новых</span>
                    </div>
                    <ul class="mk-popover__list">
                        <li class="mk-notif-item mk-notif-item--new">
                            <span class="mk-notif-item__icon">🔧</span>
                            <div class="mk-notif-item__content">
                                <span class="mk-notif-item__title">Замена масла</span>
                                <span class="mk-notif-item__desc">BMW 320i · через 3 дня</span>
                            </div>
                            <span class="mk-notif-item__time">5 мин</span>
                        </li>
                        <li class="mk-notif-item mk-notif-item--new">
                            <span class="mk-notif-item__icon">📄</span>
                            <div class="mk-notif-item__content">
                                <span class="mk-notif-item__title">ОСАГО истекает</span>
                                <span class="mk-notif-item__desc">Toyota Camry · до 15.08.2026</span>
                            </div>
                            <span class="mk-notif-item__time">2 часа</span>
                        </li>
                        <li class="mk-notif-item">
                            <span class="mk-notif-item__icon">⛽</span>
                            <div class="mk-notif-item__content">
                                <span class="mk-notif-item__title">Добавлена заправка</span>
                                <span class="mk-notif-item__desc">Lada Vesta · +40 л</span>
                            </div>
                            <span class="mk-notif-item__time">вчера</span>
                        </li>
                        <li class="mk-notif-item">
                            <span class="mk-notif-item__icon">📝</span>
                            <div class="mk-notif-item__content">
                                <span class="mk-notif-item__title">Новая заметка</span>
                                <span class="mk-notif-item__desc">BMW 320i · «Проверить свечи»</span>
                            </div>
                            <span class="mk-notif-item__time">2 дня</span>
                        </li>
                    </ul>
                    <div class="mk-popover__footer">
                        <a href="#all-notifications">Все уведомления →</a>
                    </div>
                </div>
            </div>

            <!-- АВАТАР с popover -->
            <div class="mk-popover-wrapper">
                <button class="mk-userchip" aria-label="Профиль пользователя" id="profile-btn">
                    <span class="mk-userchip__avatar">{{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}</span>
                    <span class="mk-userchip__name">{{ Auth::user()->name }}</span>
                </button>
                <div class="mk-popover mk-popover--profile" id="profile-popover">
                    <div class="mk-popover__profile-header">
                        <div class="mk-popover__avatar">{{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}</div>
                        <div>
                            <div class="mk-popover__profile-name">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</div>
                            <div class="mk-popover__profile-email">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <ul class="mk-popover__list">
                        <li><a href="#profile">Мой профиль</a></li>
                        <li><a href="#settings">Настройки</a></li>
                        <li><a href="#billing">Платежи</a></li>
                        <li class="mk-popover__divider"></li>
                        <li><a href="#logout" style="color: var(--mk-danger);">Выйти</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
