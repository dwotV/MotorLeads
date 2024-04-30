document.addEventListener('DOMContentLoaded', function() {
    prueba();
});

function DataG(months, labels, purchasePrices, salePrices, mediumPrices) {
    const data = {
        labels: labels,
        datasets: [{
            label: 'Valor a la Compra',
            backgroundColor: 'blue',
            borderColor: 'blue',
            data: purchasePrices,
        }, {
            label: 'Valor a la Venta',
            backgroundColor: 'green',
            borderColor: 'green',
            data: salePrices,
        }, {
            label: 'Valor Medio',
            backgroundColor: 'orange',
            borderColor: 'orange',
            data: mediumPrices,
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    };

    if (window.myChart) {
        window.myChart.destroy();
    }
    
    var ctx = document.getElementById('mygra').getContext('2d');
    window.myChart = new Chart(ctx, config);
}

window.onload = function() {
    let labels = " + JSON.stringify($labels) + ";
    let purchasePrices = " + JSON.stringify($purchasePrices) + ";
    let salePrices = " + JSON.stringify($salePrices) + ";
    let mediumPrices = " + JSON.stringify($mediumPrices) + ";

    DataG(" + $months + ", labels, purchasePrices, salePrices, mediumPrices);
};

function prueba(){
    document.getElementById('userName').textContent = 'Daniel';
    document.getElementById('userPhoto').src = 'imagenes/user.png';}

function toggleLineVisibility(index) {
    const chart = window.myChart;
    const datasets = chart.data.datasets;

    // Invierte la visibilidad del conjunto de datos específico según el índice
    datasets[index].hidden = !datasets[index].hidden;

    // Actualiza el gráfico
    chart.update();
}
