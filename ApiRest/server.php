<?php

    /**
     * Bases para crear un servicio REST
     * 
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
        die;
    };

    /**
     * SE definen los recursos
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
     * Genera respuesta asumiendo que el recurso es correcto
     */
    switch (strtoupper($_SERVER['REQUEST_METHOD'])) {
        case 'GET':
            echo json_encode($bands);
            break;
        case 'POST':
            break;
        case 'PUT':
            break;
        case 'DELETE':
            break;
    }

?>