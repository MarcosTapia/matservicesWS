<?php
/**
 * Obtiene todas las ventas de la base de datos
 */

require 'Ventas.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petici�n GET
    $pedidos = Ventas::getPedidosGral();
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

