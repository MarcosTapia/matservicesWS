<?php
/**
 * Obtiene todas los registros de temporalvtacompra de la base de datos
 */

require 'Compras.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petici�n GET
    $temporalVtaCompras = Compras::getAllTemporalVtaCompra();

    if ($temporalVtaCompras) {
        $datos["estado"] = 1;
        $datos["temporalVtaCompras"] = $temporalVtaCompras;
        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

