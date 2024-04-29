<?php
    include ('utilerias.php');
    $id = $_GET["version"];
    $months = 3;
    

    if(isset($_POST['three'])) {
        $months = 3;
    }
    if(isset($_POST['six'])) {
        $months = 6;
    }
    if(isset($_POST['twelve'])) {
        $months = 12;
    }
    if(isset($_POST['twenty_four'])) {
        $months = 24;
    }
    if(isset($_POST['all'])) {
        $months = 1000;
    }
    
    $url = 'https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1/vehicles/'.$id.'/pricings?filter[since]='.$months;
     

    $version = getData($url);

    $historic = $version['historic'];
    $labels= [];
    $purchasePrices= [];
    $salePrices= [];
    $mediumPrices= [];

    for ($i = 0; $i < count($historic); $i++){
        $labels[] = $historic[$i]['month_name'].' '.substr($historic[$i]['year'], -2).'\'';
        $purchasePrices[] = $historic[$i]['purchase_price'];
        $salePrices[] = $historic[$i]['sale_price'];
        $mediumPrices[] = $historic[$i]['medium_price'];
    }

    $labels = array_reverse($labels);
    $purchasePrices = array_reverse($purchasePrices);
    $salePrices =  array_reverse($salePrices);
    $mediumPrices = array_reverse($mediumPrices);

    if ($months !== 0) {
        $labels = array_slice($labels, -$months);
        $purchasePrices = array_slice($purchasePrices, -$months);
        $salePrices = array_slice($salePrices, -$months);
        $mediumPrices = array_slice($mediumPrices, -$months);
    }

    echo "
    <!DOCTYPE html>
    <html>
    <head> 
        <title>MotorLeads Graph</title>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Gráfica</title>

        <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
        <script src='grafica.js'></script>
        <style>
            canvas {
                max-width: 75%;
                max-height: 80%;
            }
        </style>
    </head>
    <body>
        <h1>" . (isset($version['make']) ? $version['make'] : '') . " " . (isset($version['model']) ? $version['model'] : '') . "</h1>
        <div>
            <form method='post' action=''>
                <button name='three'>3 meses</button>
                <button name='six'>6 meses</button>
                <button name='twelve'>1 año</button>
                <button name='twenty_four'>2 años</button>
                <button name='all'>Todo</button>
            </form>
        </div>
        <canvas id='mygra'></canvas>

        <script>
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
                let labels = " . json_encode($labels) . ";
                let purchasePrices = " . json_encode($purchasePrices) . ";
                let salePrices = " . json_encode($salePrices) . ";
                let mediumPrices = " . json_encode($mediumPrices) . ";

                DataG(" . $months . ", labels, purchasePrices, salePrices, mediumPrices);
            };
        </script>
        
    </body>
    </html>";

?>