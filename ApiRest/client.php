<?php

    /**
     * Manejo de errors por parte de cliente
     */
    $ch = curl_init($argv[1]);

    curl_setopt(
        $ch,
        CURLOPT_RETURNTRANSFER,
        true
    );

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    switch ($httpCode) {
        case 200:
            echo "Todo nice";
            break;
        case 400:
            echo "Pedido Incorrecto";
            break;
        case 404: 
            echo "Not Found";
            break;
        case 500:
            echo "El servidor Falló";
            break;
    };

?>