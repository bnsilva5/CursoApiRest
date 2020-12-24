<?php

    /**
     * Reescritura de url
     * Exponer un recurso individual atraves de http GET
     */

    /**
     *Arreglo para las coincidencias 
     */
    $matches = [];

    /**
     * Expresiones regulares a buscar
     */
    $patron1 = '/\/([^\/]+)\/([^\/]+)/';
    $patron2 = '/\/([^\/]+)\/?/';

    /**
     * Se valida que la url contenga la expresion regular patron1
     */
    if (preg_match($patron1, $_SERVER['REQUEST_URI'], $matches)) {
        //--- Recurso en particular
        $_GET['resource_type'] = $matches[1];
        $_GET['resource_id'] = $matches[2];

        error_log(print_r($matches, 1));

        //----Se delega el control a server.php
        require 'server.php';
    } elseif (preg_match($patron2, $_SERVER['REQUEST_URI'], $matches)) {
        //--- Coleccion
        $_GET['resource_type'] = $matches[1];
        error_log(print_r($matches, 1));

        require 'server.php';
    } else {
        //--- Si no encuentra ninguna de las anteriores
        error_log('No matches');
        http_response_code(404);
    }

?>