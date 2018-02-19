<?php
/**
 * Obtiene el detalle de una venta especificado por
 * su identificador "idVenta"
 */

require 'Ventas.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $parametro = $_GET['idPedido'];
    // Manejar petici�n GET
    $detallePedidos = Ventas::getByIdPedido($parametro);
    if ($detallePedidos) {
        $datos["estado"] = 1;
        $datos["detallePedidos"] = $detallePedidos;
        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
} else {
    // Enviar respuesta de error
    print json_encode(
        array(
            'estado' => '3',
            'mensaje' => 'Se necesita un identificador'
        )
    );
}

