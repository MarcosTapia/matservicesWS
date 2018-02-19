<?php
/**
 * Obtiene todas las sucursales de la base de datos
 */

require 'Sucursales.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar peticion GET
    $sucursales = Sucursales::getAll();

    if ($sucursales) {

        $datos["estado"] = 1;
        $datos["sucursales"] = $sucursales;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

