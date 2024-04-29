function DataG(months, labels, purchasePrices, salePrices, mediumPrices) {
    const data = {
        labels: labels,
        datasets: [{
            label: 'Valor a la Compra',
            backgroundColor: 'rgb(0, 128, 255)',
            borderColor: 'rgb(0, 128, 255)',
            data: purchasePrices,
        }, {
            label: 'Valor a la Venta',
            backgroundColor: 'rgb(2, 253, 147)',
            borderColor: 'rgb(2, 253, 147)',
            data: salePrices,
        }, {
            label: 'Valor Medio',
            backgroundColor: 'rgb(239, 111, 16)',
            borderColor: 'rgb(239, 111, 16)',
            data: mediumPrices,
        }]
    };

    const config = {
        type: 'line',
        data: data,
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