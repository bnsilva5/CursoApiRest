<?php

    /**
     * Bases para crear un servicio REST
     * 
    */

    /**
     * Acces Tokens (Muy segura)
     */
    
    /**if (!array_key_exists('HTTP_X_TOKEN', $_SERVER)) {
        http_response_code(400);
        die;
    }

    $url = 'http://localhost:8001';

    $ch = curl_init($url);

    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        [
            "X-Token: {$_SERVER['HTTP_X_TOKEN']}"
        ]
        );
    curl_setopt(
        $ch,
        CURLOPT_RETURNTRANSFER,
        true
        );

    $ret = curl_exec($ch);

    if ($ret !== 'true') {
        die;
    }
    */
    /**
     * Tipos de recursos disponibles
     */
    $allowedResourceTypes = [
        'band',
        'song',
        'genere'
    ];

    /**
     * Se obtiene el recurso
     */
    $resourceType = $_GET['resource_type'];

    /**
     * Se valida si el recurso esta disponible
     */
    if (!in_array($resourceType, $allowedResourceTypes)) {
        http_response_code(400);
        die;
    };

    /**
     * Se definen los recursos
     */
    $bands = [
        1 => [
            'band' => 'Caifanes',
            'id_song' => 2,
            'id_genere' => 2
        ],

        2 => [
            'band' => 'Los Tres',
            'id_song' => 1,
            'id_genere' => 1
        ],

        3 => [
            'band' => 'Jaguares',
            'id_song' => 3,
            'id_genere' => 3
        ]
    ];
    
    header('Content-Type: application/json');

    /**
     * Se valida el id del recurso buscado
     */
    $resourceId = array_key_exists('resource_id', $_GET) ? $_GET['resource_id'] : '';

    /**
     * Genera respuesta asumiendo que el recurso es correcto
     */
    switch (strtoupper($_SERVER['REQUEST_METHOD'])) {
        case 'GET':
            if(empty($resourceId)) {
                echo json_encode($bands);
            } else {
                if(array_key_exists($resourceId, $bands)) {
                    echo json_encode($bands[$resourceId]);
                } else {
                    /**
                     * Manejo errores servidor
                     */
                    http_response_code(404);
                }
            }
            break;
        case 'POST':
            /**
             * Permite a otras aplicaciones que
             * creen nuevos recursos al servidor propio
             * através de una apiREST
             */
            $json = file_get_contents('php://input');

            // Se obtiene el JSON, 
            // Y se agrega a un nuevo elemento del array
            $bands[] = json_decode($json, true);

            // Se envia hacia la ultima parte del arreglo
            echo array_keys($bands)[count($bands) - 1];
            break;
        case 'PUT':
            /**
             * Permitir que otras aplicaciones
             * modifiquen recursos que hay en el servidor
             * PUT / Reemplazo
             */
            // Se valida que el recurso exista
            if(!empty($resourceId) && array_key_exists($resourceId, $bands)) {
                // Se toma la entrada
                $json = file_get_contents('php://input');

                // Se agrega el JSON recibido a un nuevo elemento del array
                $bands[$resourceId] = json_decode($json, true);

                // Se retorna la coleccion modificada en formato JSON
                echo json_encode($bands);
            }
            break;
        case 'DELETE':
            // Se valida que el recurso exista
            if(!empty($resourceId) && array_key_exists($resourceId, $bands)) {
                // Elimina el recurso
                unset($bands[$resourceId]);
            }

            echo json_encode($bands);
            break;
    }

?>