<?php

    /**
     * Variable que obtiene el contenido de la url
     */
    $json = file_get_contents('https://reqres.in/api/users?page=2');

    /**
     * Variable que convierte el link a JSON
     */
    $data = json_decode($json, true);

    /**
     * Se muestra un atributo del JSON obtenido
     */
    echo $data['page'].PHP_EOL;

?>