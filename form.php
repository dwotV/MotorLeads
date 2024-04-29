<!DOCTYPE html>
<html>
    <head>
        <title>MotorLeads</title>
        <link href="formstyles.css" rel="stylesheet" type="text/css">
        <script src = "form.js" type="text/JavaScript"></script>
        <meta charset="utf-8">
    </head>
    <body><center>
<?php 

    $API_URL = "https://motorleads-api-d3e1b9991ce6.herokuapp.com/api/v1";
function console_log($output, $with_script_tags = true) {
$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
');';
if ($with_script_tags) {
$js_code = '<script>' . $js_code . '</script>';
}
echo $js_code;
}

function getData($url) {

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPGET, true);

    $response = curl_exec($curl);
    $data = json_decode($response, true);
    curl_close($curl);

    console_log($data);
    return $data;

}


function getMakes() {
global $API_URL;
$make_options = "";
$makes = getData($API_URL."/makes");


for ($i = 0; $i < count($makes)-1; $i++) {
    $make_options .= "<option value = '".$makes[$i]["id"]."' class ='options'>".$makes[$i]["name"]."</option>".PHP_EOL;
}

return $make_options;

}

function getModels() {
    global $API_URL;
    $model_options = "";
    if (isset($_GET["make_id"])) {
        $make = $_GET["make_id"];
        $model_url = $API_URL."/makes/".$make."/models";

        console_log($model_url);
        $models_data = getData($model_url);

        for ($i = 0; $i < count($models_data)-1; $i++) {
            $model_options .= "<option value = '".$models_data[$i]["id"]."' class ='options'>".$models_data[$i]["name"]."</option>".PHP_EOL;
        }
        
        return $model_options;
    } else { 
        return "<></>";
    }
}

function getYears() {
    global $API_URL;
    $year_options = "";
    if (isset($_GET["model_id"])) {
        $model = $_GET["model_id"];
        $year_url = $API_URL."/models/".$model."/years";

        console_log($year_url);
        $years_data = getData($year_url);

        for ($i = 0; $i < count($years_data)-1; $i++) {
            $year_options .= "<option value = '".$years_data[$i]["id"]."' class ='options'>".$years_data[$i]["name"]."</option>".PHP_EOL;
        }
        
        return $year_options;
    } else { 
        return "<></>";
    }
}

function getVersion() {
    global $API_URL;
    $version_options = "";
    if (isset($_GET["year_id"])) {
        $model = $_GET["model_id"];
        $year = $_GET["year_id"];
        $version_url = $API_URL."/models/".$model."/years/".$year."/vehicles";

        console_log($version_url);
        $version_data = getData($version_url);

        for ($i = 0; $i < count($version_data)-1; $i++) {
            $version_options .= "<option value = '".$version_data[$i]["id"]."' class ='options'>".$version_data[$i]["version"]."</option>".PHP_EOL;
        }
        
        return $version_options;
    } else { 
        return "<></>";
    }
}

echo "<!DOCTYPE html>
<html>
    <head>
        <title>MotorLeads</title>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' type='text/css' href='formStyles.css'>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap' rel='stylesheet'/>
    </head>

    <body>
        <form name = 'options_motorleads'>
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
                                <td>
                                    <img src='https://localhost/RETO/imagenes/user.png' class='userimg'>
                                </td>
                                <td>
                                    <p>Daniel</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table class='form' width='70%'>
                <tr>
                    <td>
                        <table class='selectores'>
                            <tr>
                                <td width='300' height='100'>
                                    <p>Selecciona una Marca</p>
                                    <select name = makes onchange = 'getMakeID()'>
                                        <option value = ''>Selecciona</option>
                                        ".getMakes()."
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td width='300' height='100'>
                                    <p>Selecciona un Modelo</p>
                                    <select name = 'model' onchange = 'getModelID()' disabled>
                                        <option value = ''>Selecciona</option>
                                        ".getModels()."
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td width='300' height='100'>
                                    <p>Selecciona un Año</p>
                                    <select name = 'year' onchange = 'getYearID()' disabled>
                                        <option value=''>Selecciona</option>
                                        ".getYears()."
                                    </select>
                                </td>
                            </tr>
                            <tr>
                            <td width='300' height='100'>
                                <p>Selecciona una Versión</p>
                                <select name = 'version' onchange = 'getVersionID()' disabled>
                                    <option value = ''>Selecciona</option>
                                    ".getVersion()."
                                </select>
                            </td>
                        </tr>
                            <tr>
                                <td width='300' height='100'>
                                    <p>Selecciona un Kilometraje</p>
                                    <input type='number' name='kilometraje'>
                                </td>
                            </tr>
                            <tr>
                                <td width='300' height='100'>
                                    <p>Selecciona un Color</p>
                                    <select name = 'color' disabled>
                                        <option value=''>Selecciona</option>
                                        <option value='red'>Rojo</option>
                                        <option value='blue'>Azul</option>
                                        <option value='yellow'>Amarillo</option>
                                        <option value='black'>Negro</option>
                                        <option value='white'>Blanco</option>
                                        <option value='silver'>Plateado</option>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type='submit' value='Buscar'>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>"
?>
</center></body>
</html>


