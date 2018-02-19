<?php
/**
 * Obtiene movimientos de un articulo especificado por
 * su identificador "idArticulo"
 */

require 'Movimientos.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $parametro = $_GET['idArticulo'];
    // Manejar petici�n GET
    $movimientos = Movimientos::getMovByIdArticulo($parametro);
    if ($movimientos) {
        $datos["estado"] = 1;
        $datos["movimientos"] = $movimientos;
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

