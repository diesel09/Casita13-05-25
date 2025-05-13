<?php
// process.php

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $data = [
        'sName' => $_POST['sName'],
        'sFlag' => $_POST['sFlag'],
        'sHost' => $_POST['sHost'],
        'sPort' => $_POST['sPort'],
        'sslPort' => $_POST['sslPort'],
        'rHost' => $_POST['rHost'],
        'rPort' => $_POST['rPort'],
        'user' => $_POST['user'],
        'pass' => $_POST['pass'],
        'sInfo' => $_POST['sInfo'],
        'sni' => $_POST['sni'],
        'pubkey' => $_POST['pubkey'],
        'ns' => $_POST['ns'],
        'dns' => $_POST['dns'],
        'cPayload' => $_POST['cPayload'],
        'useInject' => isset($_POST['useInject']) ? true : false,
        'useWSpayload' => isset($_POST['useWSpayload']) ? true : false,
        'mahina' => isset($_POST['mahina']) ? true : false,
        'useSSL' => isset($_POST['useSSL']) ? true : false,
        'useDirect' => isset($_POST['useDirect']) ? true : false
    ];
    

    // Convierte el array a JSON
    $json_data = json_encode($data);

    // Muestra el JSON en lugar de redirigir
    echo "<h1>Datos procesados:</h1>";
    echo "<pre>" . json_encode($data, JSON_PRETTY_PRINT) . "</pre>";
} else {
    // Si no se recibió una solicitud POST, redirige o muestra un error
    echo "No se recibieron datos válidos.";
}
?>
