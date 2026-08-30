import { fetchJson } from './app.js';

function getExpenses(period = 'all'){
    const params = new URLSearchParams({ period: period });
    fetchJson(`/api/stats?${params}`)
        .then(function (result) {

        })
        .catch(function () {
            showDetailToast('Не удалось получить затраты. Попробуйте позже.');
        });
}
// ===== ПЕРИОД =====
function initPeriodSelector() {
    document.querySelectorAll('.mk-period-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.mk-period-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
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
