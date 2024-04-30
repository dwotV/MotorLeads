<?php
    include ('utilerias.php');
    $id = $_GET["version"];
    $months = 6;
    

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
    if(isset($_GET['kilometraje']) && isset($_GET['color'])) {
        $km = $_GET['kilometraje']." km";
        $color = ucfirst($_GET['color']);

    }
   
    // if(isset($_POST['hn'])) {
    //     $hn = $_POST['hn'];
    //     $fsale = '$' . number_format($historic[$hn]['sale_price']);
    //     $fmedium = '$' . number_format($historic[$hn]['medium_price']);
    //     $fpurch = '$' . number_format($historic[$hn]['purchase_price']);
    // }

// $fsale = '$' . number_format($historic[1]['sale_price']);
// $fmedium = '$' . number_format($historic[1]['medium_price']);
// $fpurch = '$' . number_format($historic[1]['purchase_price']);
$hn = isset($_POST['hn']) ? $_POST['hn'] : 1;

// Calcular los nuevos valores de fsale, fmedium y fpurch
if(isset($historic[$hn])) {
    // Si 'hn' está definido y el índice es válido en $historic, calcular los nuevos valores
    $fsale = '$' . number_format($historic[$hn]['sale_price']);
    $fmedium = '$' . number_format($historic[$hn]['medium_price']);
    $fpurch = '$' . number_format($historic[$hn]['purchase_price']);
} else {
    // Si 'hn' no está definido o el índice no es válido, asignar valores predeterminados
    $fsale = '$0';
    $fmedium = '$0';
    $fpurch = '$0';
}

$vsales = isset($version['sale_price_variation']) ? '$'.number_format($version['sale_price_variation']).'('.$version['sale_price_percentage_variation'].'%)' : '';
$vpurch = isset($version['purchase_price_variation']) ? '$'.number_format($version['purchase_price_variation']).'('.$version['purchase_price_percentage_variation'].'%)' : '';
$vhalf = isset($version['medium_price_variation']) ? '$'.number_format($version['medium_price_variation']).'('.$version['medium_price_percentage_variation'].'%)' : '';

$kmMin = number_format($version["km_minimum"]);
$kmMax = number_format($version["km_maximum"]);
$kmAvg = number_format($version["km_average"]);

    echo "
    <!DOCTYPE html>
    <html>
    <head> 
        <title>MotorLeads</title>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' type='text/css' href='results.css'>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap' rel='stylesheet'/>

        <title>Detalle del vehìculo</title>
        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>

        <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
        <script src='grafica.js'></script>
        <style>
            canvas {
                max-width: 100%;
                max-height: 30%;
                margin-left: 25%;
            }
        </style>
    </head>
    <body>
    <table class='navbar' width='100%'>
    <tr>
        <td>
            <table class='logo'>
                <tr>
                    <td>
                        <h2>MotorLeads</h2>
                    </td>
                </tr>
            </table>
        </td>
        <td>
            <table class='user'>
                <tr>
                    <td class='userimg'><img id='userPhoto'></td>
                    <td style='color: white;'><p><span id='userName'></span></p></td>
                </tr>
            </table>
        </td>
    </tr>
    </table>

        <div id='vehicle'>
            <br>
            <br>
            
            <table class='vehicle-table' width='30%'>
                <tr>
                <td class='imp' rowspan='2'>";
                    if(isset($version['make'])) {
                        $make_name = $version['make'];
                        $image_path = "makes/".$make_name . ".png";
                        echo "<img src='$image_path' id='makesLogo'>";
                    }
                echo "</td>";

                echo"
                    <td class='imp combined-cell' colspan='2'>
                        <span id='makes'>".(isset($version['make']) ? $version['make']: '')."</span>
                        <span class='cell-space'></span> 
                        <span id='model'>". (isset($version['model']) ? $version['model'] : '')."</span>
                    </td>
                </tr>
                <tr>
                    <td class='char' colspan='3'> 
                        <span id='year'>".$historic[1]['year']."<span class='middot-space'></span>&middot;<span class='middot-space'></span><span id='color'>".$color."</span><span class='middot-space'></span>&middot;<span class='middot-space'></span><span id='version'>". (isset($version['vehicle_version']) ? $version['vehicle_version'] : '')."</span><span class='middot-space'></span>&middot;<span class='middot-space'></span><span id='mileage'>".$km."</span>
                    </td>
                </tr>
            </table>  
        </div>

        <div class='boton-container' style='text-align: right; margin-right: 150px;'>
            <a href='http://localhost/MotorLeads-main/form.html' class='styled-button' >
                + Cotizar Nuevo Auto
            </a>
        </div>
        
        <div id='prices'>
            <br>
            <br>
            <table class='prices-table' width='50%'>
                <tr>
                    <td>Valor a la <b>Venta</b><span class='dot1'></span></td>
                    <td>Valor <b>Medio</b><span class='dot2'></span></td>
                    <td>Valor a la <b>Compra</b><span class='dot3'></span></td>
                </tr>
                <tr>
                    <span id='historyNumber'></span>
                    <td style='height: 70px'><span class='imp' id='sales'>".$fsale."</span></td>
                    <td style='height: 70px'><span class='imp' id='half'>".$fmedium."</span></td>
                    <td style='height: 70px'><span class='imp' id='purch'>".$fpurch."</span></td>
                </tr>
                <tr>
                    <td>Cambio de 1 Año</td>
                    <td>Cambio de 1 Año</td>
                    <td>Cambio de 1 Año</td>
                </tr>
                <tr>
                    <td><span class='char' id='chSales'>".$vsales."</span></td>
                    <td><span class='char' id='chHalf'>".$vhalf."</span></td>
                    <td><span class='char' id='chPurch'>".$vpurch."</span></td>
                </tr>
                <tr>
                    <td>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br>
                    </td>
                </tr>
                <tr>
                <tr>
                    <td colspan='5' align='right'> 
                        <form method='post' action='' class='button-container'>
                            <button class='button' name='three'>3M</button>
                            <button class='button' name='six'>6M</button>
                            <button class='button' name='twelve'>1A </button>
                            <button class='button' name='twenty_four'>2A</button>
                            <button class='button' name='all'>Máx</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan='5' align='right'> 
                        <button class='button' style='background-color: rgba(0, 128, 0, 0.8); color: white; border: none;' onclick='toggleLineVisibility(1)'>Venta</button>
                        <button class='button' style='background-color: rgba(255, 165, 0, 0.8); color: white; border: none;' onclick='toggleLineVisibility(2)'>Medio</button>
                        <button class='button' style='background-color: rgba(0, 0, 255, 0.8); color: white; border: none;' onclick='toggleLineVisibility(0)'>Compra</button>
                    </td>
                </tr>
            </table>
        </div>

        <canvas id='mygra'></canvas>
        <table class='prices-table' width='50%'>
        <tr>
            <td>
                <br>
            </td>
        </tr>
        <tr>
            <td>
                <br>
            </td>
        </tr>
        <tr>
                <td>Kilometraje esperado</td>
                <td>Kilometraje promedio</td>
        </tr>
        <tr>
            <td><span class='char' id='kmExpec'>".$kmMin." - ".$kmMax." km</span></td>
            <td><span class='char' id='kmAvg'>".$kmAvg." km</span></td>
        </tr>
        </tr>
        <tr>
            <td>
                <br>
            </td>
        </tr>
        </table>

        <script>
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
                    },
                    onClick: function(event, chartElement) {
                        if (chartElement.length > 0) {
                            const index = chartElement[0].index;
                            const year = labels[index];
                            console.log('Hovered over index:', index);
                            console.log('Year:', year);

                            $.ajax({
                                type: 'POST',
                                url: 'grafica.php', 
                                data: { hn: index }, 
                                success: function(response) {
                                    console.log('Respuesta del servidor:', response);
                                    $('#sales').text(response.fsale);
                                    $('#half').text(response.fmedium);
                                    $('#purch').text(response.fpurch);
                                }
                            });
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
                let labels = " . json_encode($labels) . ";
                let purchasePrices = " . json_encode($purchasePrices) . ";
                let salePrices = " . json_encode($salePrices) . ";
                let mediumPrices = " . json_encode($mediumPrices) . ";

                DataG(" . $months . ", labels, purchasePrices, salePrices, mediumPrices);
            };
        </script>
        
    </body>
    </html>";
