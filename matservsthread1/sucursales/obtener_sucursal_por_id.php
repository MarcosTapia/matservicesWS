<?php
/**
 * Obtiene el detalle de una sucursal especificado por
 * su identificador "idSucursal"
 */

require 'Sucursales.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idSucursal'])) {

        // Obtener parametro idSucursal
        $parametro = $_GET['idSucursal'];

        // Tratar retorno
        $retorno = Sucursales::getById($parametro);


        if ($retorno) {

            $sucursal["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $sucursal["sucursal"] = $retorno;
            // Enviar objeto json de la categoria
            print json_encode($sucursal);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
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
}

