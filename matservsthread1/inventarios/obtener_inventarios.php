<?php
/**
 * Obtiene todas los articulos/productos/servicios de la base de datos
 */

require 'Inventarios.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petici�n GET
    $inventarios = Inventarios::getAll();

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
}

