@include('layouts.public.landing-head')
<body>
@include('layouts.public.landing-header')
<style>
    /* Локальные стили для страницы контактов */
    .mk-contacts {
        max-width: 1160px;
        margin: 0 auto;
        padding: 40px var(--mk-gutter) 60px;
        background: var(--mk-bg);
    }
    .mk-contacts h1 {
        font-family: var(--mk-font-display);
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .mk-contacts__sub {
        color: var(--mk-ink-2);
        font-size: 16px;
        margin-bottom: 40px;
        border-bottom: 1px solid var(--mk-border);
        padding-bottom: 16px;
    }
    .mk-contacts__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }
    .mk-contacts__info h2 {
        font-family: var(--mk-font-display);
        font-size: 20px;
        font-weight: 600;
        margin-top: 24px;
        margin-bottom: 12px;
    }
    .mk-contacts__info h2:first-of-type {
        margin-top: 0;
    }
    .mk-contacts__info p {
        color: var(--mk-ink-2);
        line-height: 1.7;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .mk-contacts__info p i {
        font-size: 20px;
        color: var(--mk-primary);
        width: 24px;
        text-align: center;
    }
    .mk-contacts__info a {
        color: var(--mk-primary);
        text-decoration: none;
    }
    .mk-contacts__info a:hover {
        text-decoration: underline;
    }
    .mk-contacts__social {
        display: flex;
        gap: 16px;
        margin-top: 16px;
    }
    .mk-contacts__social a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: var(--mk-r-pill);
        background: var(--mk-surface-2);
        color: var(--mk-ink-2);
        font-size: 22px;
        transition: all 0.15s ease;
    }
    .mk-contacts__social a:hover {
        background: var(--mk-primary);
        color: #fff;
        transform: translateY(-2px);
    }

    /* Форма обратной связи */
    .mk-contacts__form {
        background: var(--mk-surface);
        border-radius: var(--mk-r-lg);
        padding: 32px;
        box-shadow: var(--mk-shadow-sm);
    }
    .mk-contacts__form h2 {
        font-family: var(--mk-font-display);
        font-size: 22px;
        font-weight: 600;
        margin-top: 0;
        margin-bottom: 16px;
    }
    .mk-contacts__form .form-group {
        margin-bottom: 16px;
    }
    .mk-contacts__form label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: var(--mk-ink-2);
        margin-bottom: 4px;
    }
    .mk-contacts__form input,
    .mk-contacts__form textarea {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid var(--mk-border);
        border-radius: var(--mk-r-sm);
        font-family: var(--mk-font-body);
        font-size: 15px;
        background: var(--mk-bg);
        color: var(--mk-ink);
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .mk-contacts__form input:focus,
    .mk-contacts__form textarea:focus {
        outline: none;
        border-color: var(--mk-primary);
        box-shadow: var(--mk-ring);
    }
    .mk-contacts__form textarea {
        resize: vertical;
        min-height: 120px;
    }
    .mk-contacts__form .mk-btn {
        width: 100%;
        justify-content: center;
    }

    /* Адаптив */
    @media (max-width: 860px) {
        .mk-contacts__grid {
            grid-template-columns: 1fr;
            gap: 32px;
        }
        .mk-contacts__form {
            order: -1;
        }
    }
    @media (max-width: 680px) {
        .mk-contacts h1 { font-size: 26px; }
        .mk-contacts { padding: 24px var(--mk-gutter) 40px; }
        .mk-contacts__form { padding: 20px; }
    }
</style>
<main>
    <section class="mk-contacts" aria-label="Контактная информация">
        <h1>Контакты</h1>
        <p class="mk-contacts__sub">Мы всегда на связи. Напишите или позвоните — ответим в ближайшее время.</p>

        <div class="mk-contacts__grid">

            <!-- Левая колонка: контакты -->
            <div class="mk-contacts__info">
                <h2>Свяжитесь с нами</h2>
                <p><i class="bi bi-envelope"></i> <a href="mailto:support@motorkeep.ru">support@motorkeep.ru</a></p>
                <p><i class="bi bi-telephone"></i> <a href="tel:+74951234567">+7 (495) 123-45-67</a></p>
                <p><i class="bi bi-geo-alt"></i> 125009, Москва, ул. Тверская, д. 1</p>

                <h2>Часы работы поддержки</h2>
                <p><i class="bi bi-clock"></i> Пн–Пт: 10:00 – 20:00 (МСК)</p>
                <p><i class="bi bi-clock"></i> Сб–Вс: выходной</p>

                <h2>Мы в соцсетях</h2>
                <div class="mk-contacts__social">
                    <a href="#" aria-label="Telegram"><i class="bi bi-telegram"></i></a>
                    <a href="#" aria-label="ВКонтакте"><i class="bi bi-vk"></i></a>
                    <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                </div>
            </div>

            <!-- Правая колонка: форма обратной связи -->
            <div class="mk-contacts__form">
                <h2>Написать нам</h2>
                <form id="contacts-form" novalidate>
                    <div class="form-group">
                        <label for="name">Ваше имя</label>
                        <input type="text" id="name" placeholder="Иван Иванов" required />
                    </div>
                    <div class="form-group">
                        <label for="email">Электронная почта</label>
                        <input type="email" id="email" placeholder="ivan@example.ru" required />
                    </div>
                    <div class="form-group">
                        <label for="message">Сообщение</label>
                        <textarea id="message" placeholder="Опишите ваш вопрос..." required></textarea>
                    </div>
                    <button type="submit" class="mk-btn mk-btn--primary">Отправить сообщение</button>
                </form>
                <p style="margin-top:16px;font-size:13px;color:var(--mk-ink-3);">
                    Нажимая «Отправить», вы соглашаетесь с <a href="/privacy.html" style="color:var(--mk-primary);">политикой конфиденциальности</a>.
                </p>
            </div>

        </div>
    </section>
</main>
<script>
    (function() {
        const form = document.getElementById('contacts-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const name = document.getElementById('name').value.trim();
                const email = document.getElementById('email').value.trim();
                const message = document.getElementById('message').value.trim();
                if (!name || !email || !message) {
                    alert('Пожалуйста, заполните все поля.');
                    return;
                }
                if (!email.includes('@') || !email.includes('.')) {
                    alert('Введите корректный email.');
                    return;
                }
                alert('Сообщение отправлено (демо). Мы свяжемся с вами в ближайшее время.');
                form.reset();
            });
        }
    })();
</script>
@include('layouts.public.landing-footer')

</body>
</html>
