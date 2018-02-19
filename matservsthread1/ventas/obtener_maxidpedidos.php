<?php
/**
 * Obtiene el max id de los pedidos de la base de datos
 */

require 'Ventas.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar peticion GET
    $pedidos = Ventas::getMaxIdPedidos();

    if ($pedidos) {

        $datos["estado"] = 1;
        $datos["pedidos"] = $pedidos;
        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

