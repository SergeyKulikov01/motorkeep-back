import { fetchJson, formatRub, showToast } from './app.js';

// Отрисовывает "+X.X%" / "−X.X%" и красный/зелёный цвет для карточки
// (up — расходы выросли, ok — упали или не изменились)
function renderChange(type, diff) {
    const el = document.querySelector(`[data-changetype="${type}"]`);
    if (!el) return;

    el.classList.remove('up', 'ok');

    if (diff > 0) {
        el.classList.add('up');
        el.textContent = `+${diff.toFixed(1)}%`;
    } else if (diff < 0) {
        el.classList.add('ok');
        el.textContent = `−${Math.abs(diff).toFixed(1)}%`;
    } else {
        el.classList.add('ok');
        el.textContent = '0.0%';
    }
}

function getExpenses(period = 'all'){
    const params = new URLSearchParams({ period: period });
    fetchJson(`/api/stats?${params}`)
        .then(function (result) {
            let total = document.querySelector('[data-spendtype="total"]');
            total.textContent = formatRub(result.data.allPay);
            let fuel = document.querySelector('[data-spendtype="fuel"]');
            fuel.textContent = formatRub(result.data.fuel);
            let service = document.querySelector('[data-spendtype="service"]');
            service.textContent = formatRub(result.data.service);
            let buy = document.querySelector('[data-spendtype="buy"]');
            buy.textContent = formatRub(result.data.buy);

            renderChange('total', result.data.allPayDiff);
            renderChange('fuel', result.data.fuelDiff);
            renderChange('service', result.data.serviceDiff);
            renderChange('buy', result.data.buyDiff);
        })
        .catch(function () {
            showToast('Не удалось получить затраты. Попробуйте позже.', 'error');
        });
}
// ===== ПЕРИОД =====
function initPeriodSelector() {
    document.querySelectorAll('.mk-period-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.mk-period-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            getExpenses(this.dataset.period);
        });
    });
}

export function initStatsPage() {
    if (!document.getElementById('cost-chart')) return;

    initPeriodSelector();
}

document.addEventListener('DOMContentLoaded', function () {
    initStatsPage();
    getExpenses();
});
