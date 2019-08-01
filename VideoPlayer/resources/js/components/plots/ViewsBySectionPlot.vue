<template>
    <div class="card">
        <div class="card-body">
            <canvas id="viewsBySection"></canvas>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        name: "ViewsBySectionPlot",
        props: ['data'],
        mounted() {
            var ctx = document.getElementById('viewsBySection');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.data.labels,
                    datasets: [{
                        label: '# de visualizações por seção',
                        data: this.data.data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 218, 43, 1)',
                            'rgba(232, 142, 39, 1)',
                            'rgba(255, 81, 56, 1)',
                            'rgba(232, 39, 214, 1)',
                            'rgba(124, 66, 255, 1)',
                            'rgba(54, 93, 255, 1)',
                            'rgba(49, 217, 232, 1)',
                            'rgba(67, 255, 127, 1)',
                            'rgba(152, 232, 49, 1)',
                            'rgba(255, 228, 77, 1)',
                            'rgba(255, 140, 112, 1)',
                            'rgba(232, 102, 194, 1)',
                            'rgba(180, 125, 255, 1)',
                            'rgba(102, 143, 232, 1)',
                            'rgba(135, 255, 250, 1)',
                            'rgba(230, 255, 104, 1)'
                        ]
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Visualização de Cada Seção'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
    }
</script>

<style scoped>

</style>