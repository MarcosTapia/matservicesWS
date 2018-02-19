<?php
/**
 * Obtiene todas los clientes de la base de datos
 */

require 'Clientes.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar peticion GET
    $clientes = Clientes::getAll();

    if ($clientes) {

        $datos["estado"] = 1;
        $datos["clientes"] = $clientes;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

