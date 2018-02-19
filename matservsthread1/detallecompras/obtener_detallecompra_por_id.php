<?php
/**
 * Obtiene el detalle de una compra especificado por
 * su identificador "idCompra"
 */

require 'DetalleCompras.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $parametro = $_GET['idCompra'];
    // Manejar petici�n GET
    $detalleCompras = DetalleCompras::getByIdCompra($parametro);
    if ($detalleCompras) {
        $datos["estado"] = 1;
        $datos["detalleCompras"] = $detalleCompras;
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
