import { formatNumber } from './app.js';

// Сворачивание сайдбара, мобильный drawer и хоткей поиска уже обрабатываются
// общим app.js (он подключается на всех страницах, включая статистику) —
// здесь дублировать их не нужно.

// ===== ДАННЫЕ =====
const statsData = {
    totalCost: 257700,
    fuelCost: 89400,
    serviceCost: 112300,
    purchasesCost: 56000,
    monthlyCost: [18500, 19200, 17800, 21500, 23400, 25600, 27800, 25200, 23100, 19800, 17600, 14300],
    monthlyMileage: [980, 1100, 1200, 1350, 1420, 1580, 1720, 1650, 1480, 1300, 1150, 860],
    distribution: [
        { label: 'ТО', value: 35, color: '#2F6BFF' },
        { label: 'Ремонты', value: 25, color: '#F0463B' },
        { label: 'Заправки', value: 22, color: '#16B364' },
        { label: 'Покупки', value: 12, color: '#F59412' },
        { label: 'Прочее', value: 6, color: '#8B5CF6' }
    ],
    topRecords: [
        { name: 'Замена двигателя', cost: 45600, type: 'repair' },
        { name: 'Комплексное ТО', cost: 23400, type: 'service' },
        { name: 'Шины зимние', cost: 18200, type: 'buy' },
        { name: 'Ремонт КПП', cost: 15600, type: 'repair' },
        { name: 'Заправка (полный бак)', cost: 4800, type: 'fuel' }
    ],
    cars: [
        { name: 'BMW 320i', plate: 'А777МР116', records: 48, cost: 98400, mileage: 86420, fuel: 8.2 },
        { name: 'Toyota Camry', plate: 'К123ХХ177', records: 23, cost: 87600, mileage: 34200, fuel: 9.1 },
        { name: 'Volkswagen Golf', plate: 'В456СС99', records: 12, cost: 45600, mileage: 15300, fuel: 7.6 }
    ]
};

const months = ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'];

// ===== РЕНДЕР БАР-ЧАРТА =====
function renderBarChart(containerId, data, maxValue, unit, color) {
    const container = document.getElementById(containerId);
    if (!container) return;

    const max = maxValue || Math.max(...data) * 1.2;
    container.innerHTML = '';

    data.forEach((value, index) => {
        const height = max > 0 ? (value / max) * 100 : 0;
        const bar = document.createElement('div');
        bar.className = 'mk-bar';
        bar.style.height = `${Math.max(height, 8)}%`;
        bar.style.background = color || 'var(--mk-primary)';
        bar.style.opacity = '0';
        bar.innerHTML = `
            <span class="mk-bar__value">${formatNumber(value)}${unit || ''}</span>
            <span class="mk-bar__label">${months[index]}</span>
        `;

        // Анимация появления
        setTimeout(() => {
            bar.style.opacity = '1';
        }, 50 + index * 30);

        container.appendChild(bar);
    });
}

// ===== РЕНДЕР DONUT =====
function renderDonut() {
    const container = document.getElementById('donut-chart');
    const legendContainer = document.getElementById('donut-legend');
    if (!container || !legendContainer) return;

    const data = statsData.distribution;
    const total = data.reduce((sum, d) => sum + d.value, 0);
    const radius = 70;
    const circumference = 2 * Math.PI * radius;

    let currentAngle = 0;
    let svg = `<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <circle cx="100" cy="100" r="${radius}" fill="none" stroke="#F1F5FB" stroke-width="28" />
    `;

    data.forEach(item => {
        const percentage = item.value / total;
        const offset = percentage * circumference;
        const strokeDasharray = `${offset} ${circumference}`;
        const rotation = (currentAngle / circumference) * 360;

        svg += `
            <circle cx="100" cy="100" r="${radius}"
                fill="none"
                stroke="${item.color}"
                stroke-width="28"
                stroke-dasharray="${strokeDasharray}"
                stroke-dashoffset="0"
                transform="rotate(${rotation} 100 100)"
                style="transition: stroke-dasharray 0.8s ease;"
            />
        `;
        currentAngle += offset;
    });

    svg += `</svg>`;
    container.innerHTML = svg;

    // Легенда
    legendContainer.innerHTML = data.map(item => `
        <span class="mk-donut-legend-item">
            <span class="dot" style="background:${item.color}"></span>
            ${item.label} (${item.value}%)
        </span>
    `).join('');
}

// ===== РЕНДЕР ТОП-ЛИСТА =====
function renderTopRecords() {
    const container = document.getElementById('top-records');
    if (!container) return;

    const typeMap = {
        service: { label: 'ТО', color: 'var(--mk-c-service-soft)', textColor: 'var(--mk-c-service)' },
        repair: { label: 'Ремонт', color: 'var(--mk-c-repair-soft)', textColor: 'var(--mk-c-repair)' },
        buy: { label: 'Покупка', color: 'var(--mk-c-buy-soft)', textColor: 'var(--mk-c-buy)' },
        fuel: { label: 'Заправка', color: 'var(--mk-c-fuel-soft)', textColor: 'var(--mk-c-fuel)' }
    };

    container.innerHTML = statsData.topRecords.map(item => {
        const type = typeMap[item.type] || typeMap.service;
        return `
            <div class="mk-top-item">
                <div class="mk-top-item__info">
                    <span class="mk-top-item__tag" style="background:${type.color};color:${type.textColor}">
                        ${type.label}
                    </span>
                    <span class="mk-top-item__name">${item.name}</span>
                </div>
                <span class="mk-top-item__cost">${formatNumber(item.cost)} ₽</span>
            </div>
        `;
    }).join('');
}

// ===== РЕНДЕР СТАТИСТИКИ ПО АВТО =====
function renderCarStats() {
    const container = document.getElementById('car-stats');
    if (!container) return;

    container.innerHTML = statsData.cars.map(car => `
        <div class="mk-car-stat-card">
            <div class="mk-car-stat-card__header">
                <span class="mk-car-stat-card__name">${car.name}</span>
                <span class="mk-car-stat-card__plate">${car.plate}</span>
            </div>
            <div class="mk-car-stat-card__stats">
                <div class="mk-car-stat-card__stat">
                    <div class="mk-car-stat-card__stat-value">${formatNumber(car.mileage)}</div>
                    <div class="mk-car-stat-card__stat-label">км</div>
                </div>
                <div class="mk-car-stat-card__stat">
                    <div class="mk-car-stat-card__stat-value">${formatNumber(car.cost)} ₽</div>
                    <div class="mk-car-stat-card__stat-label">расходы</div>
                </div>
                <div class="mk-car-stat-card__stat">
                    <div class="mk-car-stat-card__stat-value">${car.records}</div>
                    <div class="mk-car-stat-card__stat-label">записей</div>
                </div>
                <div class="mk-car-stat-card__stat" style="grid-column: span 3; border-top: 1px solid var(--mk-border); padding-top: 8px;">
                    <div class="mk-car-stat-card__stat-value" style="font-size:16px;font-weight:500;color:var(--mk-ink-2);">
                        ${car.fuel} л / 100 км
                    </div>
                    <div class="mk-car-stat-card__stat-label">средний расход</div>
                </div>
            </div>
        </div>
    `).join('');
}

// ===== ПЕРИОД =====
function initPeriodSelector() {
    document.querySelectorAll('.mk-period-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.mk-period-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            // В реальном проекте здесь была бы перезагрузка данных.
            // Для демонстрации просто перерисовываем с небольшой задержкой.
            document.querySelectorAll('.mk-bar').forEach(bar => bar.style.opacity = '0');
            setTimeout(() => {
                const costData = statsData.monthlyCost.map(v => v * (0.8 + Math.random() * 0.4));
                const mileageData = statsData.monthlyMileage.map(v => v * (0.8 + Math.random() * 0.4));
                renderBarChart('cost-chart', costData, Math.max(...costData) * 1.2, ' ₽', '#2F6BFF');
                renderBarChart('mileage-chart', mileageData, Math.max(...mileageData) * 1.2, ' км', '#16B364');
            }, 200);
        });
    });
}

export function initStatsPage() {
    if (!document.getElementById('cost-chart')) return;

    initPeriodSelector();
    renderBarChart('cost-chart', statsData.monthlyCost, Math.max(...statsData.monthlyCost) * 1.2, ' ₽', '#2F6BFF');
    renderBarChart('mileage-chart', statsData.monthlyMileage, Math.max(...statsData.monthlyMileage) * 1.2, ' км', '#16B364');
    renderDonut();
    renderTopRecords();
    renderCarStats();
}

document.addEventListener('DOMContentLoaded', function () {
    initStatsPage();
});
