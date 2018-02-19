<?php
/**
 * Obtiene el detalle de una venta especificado por
 * su identificador "idVenta"
 */

require 'DetalleVentas.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $parametro = $_GET['idVenta'];
    // Manejar petici�n GET
    $detalleVentas = DetalleVentas::getByIdVenta($parametro);
    if ($detalleVentas) {
        $datos["estado"] = 1;
        $datos["detalleVentas"] = $detalleVentas;
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

