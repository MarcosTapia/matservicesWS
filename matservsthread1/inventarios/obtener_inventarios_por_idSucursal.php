<?php
/**
 * Obtiene el detalle de una venta especificado por
 * su identificador "idVenta"
 */

require 'Inventarios.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $parametro = $_GET['idSucursal'];
    // Manejar petici�n GET
    $inventarios = Inventarios::getByIdSucursal($parametro);
    if ($inventarios) {
        $datos["estado"] = 1;
        $datos["inventarios"] = $inventarios;
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

