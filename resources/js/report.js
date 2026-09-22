import { showStaticToast as showToast } from './app.js';

(function () {
    'use strict';

    // ===== ПЕЧАТЬ / PDF =====
    document.getElementById('printBtn')?.addEventListener('click', () => {
        showToast('Открываю диалог печати');
        setTimeout(() => window.print(), 200);
    });

    // ===== ПОДЕЛИТЬСЯ =====
    const shareOverlay = document.getElementById('mkShareModalOverlay');
    const shareLinkInput = document.getElementById('shareLink');
    const shareCopyBtn = document.getElementById('shareCopyBtn');
    const shareTelegram = document.getElementById('shareTelegram');
    const shareWhatsapp = document.getElementById('shareWhatsapp');
    const shareEmail = document.getElementById('shareEmail');
    const shareNative = document.getElementById('shareNative');
    const shareRevoke = document.getElementById('shareRevoke');

    function openShareModal() {
        if (!shareOverlay) return;
        shareOverlay.classList.add('open');
        document.body.style.overflow = 'hidden';
        updateShareTargets();
    }
    function closeShareModal() {
        shareOverlay?.classList.remove('open');
        document.body.style.overflow = '';
    }
    function getShareUrl() {
        return shareLinkInput?.value || window.location.href;
    }
    function updateShareTargets() {
        const url = encodeURIComponent(getShareUrl());
        const text = encodeURIComponent('Отчёт по BMW 320i — MOTORKEEP');
        if (shareTelegram) shareTelegram.href = `https://t.me/share/url?url=${url}&text=${text}`;
        if (shareWhatsapp) shareWhatsapp.href = `https://wa.me/?text=${text}%20${url}`;
        if (shareEmail) shareEmail.href = `mailto:?subject=${text}&body=${url}`;
    }

    document.getElementById('shareBtn')?.addEventListener('click', openShareModal);
    document.getElementById('mkShareClose')?.addEventListener('click', closeShareModal);
    document.getElementById('mkShareCancel')?.addEventListener('click', closeShareModal);
    shareOverlay?.addEventListener('click', (e) => {
        if (e.target === shareOverlay) closeShareModal();
    });

    shareCopyBtn?.addEventListener('click', async () => {
        const url = getShareUrl();
        try {
            if (navigator.clipboard) {
                await navigator.clipboard.writeText(url);
                showToast('Ссылка скопирована');
            } else {
                shareLinkInput?.select();
                document.execCommand('copy');
                showToast('Ссылка скопирована');
            }
        } catch (_) {
            showToast('Не удалось скопировать — выделите вручную');
        }
    });

    shareNative?.addEventListener('click', async () => {
        if (navigator.share) {
            try {
                await navigator.share({
                    title: 'MOTORKEEP — Отчёт по BMW 320i',
                    text: 'Отчёт об автомобиле',
                    url: getShareUrl(),
                });
            } catch (_) {}
        } else {
            showToast('Системный шаринг недоступен');
        }
    });

    document.querySelectorAll('input[name="shareAccess"]').forEach((radio) => {
        radio.addEventListener('change', function () {
            if (this.checked) {
                const label = this.value === 'public' ? 'Видно по ссылке' : 'Только по авторизации';
                showToast(`Доступ: ${label}`);
            }
        });
    });

    shareRevoke?.addEventListener('click', () => {
        if (confirm('Отозвать ссылку? Ранее отправленные ссылки перестанут работать.')) {
            if (shareLinkInput) {
                const id = Math.random().toString(36).slice(2, 6);
                shareLinkInput.value = `https://motorkeep.app/r/320i-2026-09-16-${id}`;
            }
            updateShareTargets();
            showToast('Старая ссылка отозвана');
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && shareOverlay?.classList.contains('open')) {
            closeShareModal();
        }
    });

    // ===== ЭКСПОРТ CSV =====
    document.getElementById('exportBtn')?.addEventListener('click', () => {
        const rows = [
            ['Категория', 'Сумма, ₽', 'Доля, %', 'Записей'],
            ['ТО и обслуживание', '128400', '46.7', '14'],
            ['Ремонт и поломки', '96200', '35.0', '9'],
            ['Покупки', '35900', '13.1', '7'],
            ['Прочее', '14400', '5.2', '4'],
            ['Итого', '274900', '100', '34'],
        ];
        const csv = rows
            .map((r) => r.map((c) => `"${String(c).replace(/"/g, '""')}"`).join(','))
            .join('\n');
        const blob = new Blob(['\ufeff' + csv], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'motorkeep-bmw320i-2026-09-16.csv';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
        showToast('CSV-файл сохранён');
    });

    // ===== ФИЛЬТР ИСТОРИИ =====
    const chips = document.querySelectorAll('.mk-chips .mk-chip');
    const records = document.querySelectorAll('#historyFeed .mk-record');
    chips.forEach((chip) => {
        chip.addEventListener('click', () => {
            chips.forEach((c) => c.classList.remove('active'));
            chip.classList.add('active');
            const filter = chip.dataset.filter || 'all';
            records.forEach((rec) => {
                const match = filter === 'all' || rec.dataset.type === filter;
                rec.style.display = match ? '' : 'none';
            });
            updateVisibleCount();
        });
    });

    const historyTitleCount = document.querySelector('.mk-section-head__title .count');
    function updateVisibleCount() {
        if (!historyTitleCount) return;
        const visible = Array.from(records).filter((r) => r.style.display !== 'none').length;
        historyTitleCount.textContent = String(visible);
    }
    updateVisibleCount();

    // ===== ПОКАЗАТЬ / СКРЫТЬ ИСТОРИЮ =====
    const toggleBtn = document.getElementById('toggleHistory');
    const toggleLabel = document.getElementById('toggleHistoryLabel');
    const feed = document.getElementById('historyFeed');
    let historyExpanded = true;

    function setHistoryExpanded(expanded) {
        historyExpanded = expanded;
        const visibleByType = Array.from(records).filter((r) => r.style.display !== 'none');
        if (expanded) {
            visibleByType.forEach((r) => { r.style.display = ''; });
            if (toggleLabel) toggleLabel.textContent = 'Свернуть';
            if (toggleBtn) toggleBtn.querySelector('svg').style.transform = 'rotate(180deg)';
        } else {
            visibleByType.forEach((r, i) => {
                r.style.display = i < 3 ? '' : 'none';
            });
            if (toggleLabel) toggleLabel.textContent = 'Показать все';
            if (toggleBtn) toggleBtn.querySelector('svg').style.transform = '';
        }
        updateVisibleCount();
    }

    if (feed) setHistoryExpanded(true);

    toggleBtn?.addEventListener('click', () => {
        setHistoryExpanded(!historyExpanded);
    });

    // ===== ПОКАЗАТЬ ЕЩЁ =====
    const loadMore = document.getElementById('loadMore');
    loadMore?.addEventListener('click', () => {
        showToast('Подгрузка следующих записей…');
        setTimeout(() => {
            loadMore.textContent = 'Все записи загружены';
            loadMore.disabled = true;
            loadMore.style.opacity = '.5';
            loadMore.style.cursor = 'default';
        }, 800);
    });

    // ===== АВТО-ПОДПИСЬ =====
    const signHash = document.querySelector('.mk-report-sign__hash');
    if (signHash) {
        const now = new Date();
        const y = now.getFullYear();
        const m = String(now.getMonth() + 1).padStart(2, '0');
        const d = String(now.getDate()).padStart(2, '0');
        signHash.textContent = `ID: MK-320I-${y}-${m}-${d}-A7F3`;
    }

    // ===== ХОТКЕЙ ПЕЧАТИ =====
    document.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'p') {
            showToast('Открываю диалог печати');
        }
    });

    console.log('MOTORKEEP: отчёт с посещениями сервисов загружен');
})();
