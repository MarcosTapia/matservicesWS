<?php
/**
 * Obtiene todas las ventas de la base de datos
 */

require 'Ventas.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petici�n GET
    $ventas = Ventas::getVtasGral();

    if ($ventas) {

        $datos["estado"] = 1;
        $datos["ventas"] = $ventas;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

