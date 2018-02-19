<?php
/**
 * Obtiene todas las categorias de la base de datos
 */

require 'Categorias.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petici�n GET
    $categorias = Categorias::getAll();

    if ($categorias) {

        $datos["estado"] = 1;
        $datos["categorias"] = $categorias;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

