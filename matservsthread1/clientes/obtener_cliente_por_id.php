<?php
/**
 * Obtiene el detalle de un cliente especificado por
 * su identificador "idCliente"
 */

require 'Clientes.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idCliente'])) {

        // Obtener par�metro idProveedor
        $parametro = $_GET['idCliente'];

        // Tratar retorno
        $retorno = Clientes::getById($parametro);


        if ($retorno) {

            $cliente["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $cliente["cliente"] = $retorno;
            // Enviar objeto json del Proveedor
            print json_encode($cliente);
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

