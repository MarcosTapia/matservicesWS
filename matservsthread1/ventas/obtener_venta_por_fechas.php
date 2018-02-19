<?php
/**
 * Obtiene las ventas por fecha especificado por
 * su identificador "idCategoria"
 */

require 'Ventas.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar peticion GET
    $parametro1 = $_GET['fIni'];
    $parametro2 = $_GET['fFin'];
    $ventas = Ventas::obtieneVentasPorFechas($parametro1,$parametro2);
    if ($ventas) {
        $datos["estado"] = 1;
        $datos["ventas"] = $ventas;
        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

