import Chart from 'chart.js/auto';

document.addEventListener('livewire:navigated', () => {
    document.querySelectorAll('[data-chart]').forEach((canvas) => {
        if (canvas._chart) canvas._chart.destroy();
        const config = JSON.parse(canvas.dataset.chart);
        canvas._chart = new Chart(canvas, config);
    });
});
