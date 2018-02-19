<?php
/**
 * Obtiene las compras por fecha especificado por
 * su identificador "idCompra"
 */

require 'Compras.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar peticion GET
    $parametro1 = $_GET['fIni'];
    $parametro2 = $_GET['fFin'];
    $compras = Compras::obtieneComprasPorFechas($parametro1,$parametro2);
    if ($compras) {
        $datos["estado"] = 1;
        $datos["compras"] = $compras;
        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

