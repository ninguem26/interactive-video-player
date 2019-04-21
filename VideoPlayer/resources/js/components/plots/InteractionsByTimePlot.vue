<template>
    <div class="card">
        <div class="card-body">
            <canvas id="interactionsByTime"></canvas>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        name: "InteractionsByTimePlot",
        props: ['data'],
        mounted() {
            var ctx = document.getElementById('interactionsByTime');
            console.log(this.data.labels);
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: this.data.labels,
                    datasets: [{
                        label: '# de interações',
                        data: this.data.data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)'
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Interações Através do Tempo'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Tempo(s)'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Quantidade'
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