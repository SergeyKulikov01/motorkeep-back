<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сброс пароля MOTORKEEP</title>
    <!-- Медиа-запросы для адаптивности на мобильных (допустимо в письмах) -->
    <style>
        @media only screen and (max-width: 600px) {
            .mk-container {
                width: 100% !important;
                padding: 20px 16px !important;
            }
            .mk-btn {
                display: block !important;
                width: 100% !important;
                padding: 14px 20px !important;
                font-size: 16px !important;
            }
            .mk-text {
                font-size: 15px !important;
                line-height: 1.6 !important;
            }
            .mk-logo-text {
                font-size: 22px !important;
            }
            .mk-footer-text {
                font-size: 13px !important;
            }
        }
        /* Убираем лишние отступы у Outlook */
        body, table, td, p, a, div, span {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font-family: inherit;
            vertical-align: baseline;
        }
        body {
            background-color: #F6F8FC;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        .mk-container {
            background-color: #FFFFFF;
            border-radius: 16px;
            box-shadow: 0 8px 28px rgba(14, 23, 38, 0.10);
        }
        .mk-btn {
            display: inline-block;
            background-color: #2F6BFF;
            color: #FFFFFF !important;
            text-decoration: none;
            border-radius: 999px;
            padding: 10px 24px;
            font-weight: 500;
            font-size: 15px;
            border: 1px solid #2F6BFF;
            transition: background-color 0.15s ease;
            text-align: center;
        }
        .mk-btn:hover {
            background-color: #1B4DDB;
            border-color: #1B4DDB;
        }
        a {
            color: #2F6BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .mk-logo-text {
            font-family: "Space Grotesk", "Segoe UI", system-ui, sans-serif;
            font-weight: 700;
            font-size: 24px;
            color: #0E1726;
            letter-spacing: -0.02em;
        }
        .mk-logo-text span {
            color: #5B6B82;
        }
        .mk-divider {
            border-top: 1px solid #E5EAF2;
            margin: 24px 0;
        }
    </style>
</head>
<body style="margin:0;padding:20px 0;background-color:#F6F8FC;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;">

<!-- Основной контейнер -->
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#F6F8FC;padding:20px 16px;">
    <tr>
        <td align="center" style="padding:0;">
            <!-- Карточка письма -->
            <table class="mk-container" cellpadding="0" cellspacing="0" border="0" style="max-width:560px;width:100%;background-color:#FFFFFF;border-radius:16px;box-shadow:0 8px 28px rgba(14,23,38,0.10);padding:40px 36px;margin:0 auto;">
                <tr>
                    <td style="padding:0;">

                        <!-- Логотип -->
                        <div style="margin-bottom:24px;">
                                <span class="mk-logo-text" style="font-family:'Space Grotesk','Segoe UI',system-ui,sans-serif;font-weight:700;font-size:24px;color:#0E1726;letter-spacing:-0.02em;">
                                    MOTOR<span style="color:#5B6B82;">KEEP</span>
                                </span>
                        </div>

                        <!-- Приветствие -->
                        <p style="margin:0 0 8px 0;font-size:16px;font-weight:600;color:#0E1726;font-family:inherit;">
                            Здравствуйте!
                        </p>

                        <!-- Основной текст -->
                        <p class="mk-text" style="margin:16px 0 0 0;font-size:15px;line-height:1.6;color:#5B6B82;font-family:inherit;">
                            Вы запросили сброс пароля для учётной записи <strong style="color:#0E1726;">{{ $userEmail }}</strong>.
                            Чтобы установить новый пароль, нажмите на кнопку ниже.
                        </p>

                        <!-- Кнопка -->
                        <div style="margin:28px 0 24px 0;text-align:center;">
                            <a href="{{ $resetLink }}" class="mk-btn" style="display:inline-block;background-color:#2F6BFF;color:#FFFFFF;text-decoration:none;border-radius:999px;padding:10px 24px;font-weight:500;font-size:15px;border:1px solid #2F6BFF;text-align:center;font-family:inherit;">
                                Сбросить пароль
                            </a>
                        </div>

                        <!-- Предупреждение -->
                        <p class="mk-text" style="margin:0 0 16px 0;font-size:14px;line-height:1.6;color:#93A1B5;font-family:inherit;">
                            Если вы не запрашивали сброс пароля, просто проигнорируйте это письмо. Ваш пароль останется без изменений.
                        </p>

                        <!-- Разделитель -->
                        <div class="mk-divider" style="border-top:1px solid #E5EAF2;margin:24px 0;"></div>

                        <!-- Footer -->
                        <p class="mk-footer-text" style="margin:0;font-size:14px;color:#93A1B5;font-family:inherit;">
                            С уважением,<br>
                            команда <a href="https://motorkeep.ru" style="color:#2F6BFF;text-decoration:none;font-weight:500;">MOTORKEEP</a>
                        </p>
                        <p style="margin:16px 0 0 0;font-size:13px;color:#93A1B5;">
                            <a href="https://motorkeep.ru/help" style="color:#2F6BFF;text-decoration:none;">Помощь</a> &bull;
                            <a href="https://motorkeep.ru/privacy" style="color:#2F6BFF;text-decoration:none;">Конфиденциальность</a>
                        </p>
                        <p style="margin:8px 0 0 0;font-size:12px;color:#93A1B5;">
                            Это письмо отправлено автоматически, пожалуйста, не отвечайте на него.
                        </p>

                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
