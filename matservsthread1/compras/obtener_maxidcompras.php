<?php
/**
 * Obtiene el max id de las compras de la base de datos
 */

require 'Compras.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar peticion GET
    $compras = Compras::getMaxId();

    if ($compras) {

        $datos["estado"] = 1;
        $datos["compras"] = $compras;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

