<?php
/**
 * Obtiene todas los Movimientos de la base de datos
 */

require 'Movimientos.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petici�n GET
    $movimientos = Movimientos::getMovimientosExplicito();

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
}

