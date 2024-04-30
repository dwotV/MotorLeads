<?php
if(isset($_GET['url'])) {
    $API_URL = $_GET['url'];

    $ch = curl_init($API_URL);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);

    $data = json_decode($result, true);

    curl_close($ch);

    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo "Error: URL no proporcionada";
}