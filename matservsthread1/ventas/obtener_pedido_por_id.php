<?php
/**
 * Obtiene el detalle de una categoria especificado por
 * su identificador "idCategoria"
 */

require 'Ventas.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idPedido'])) {

        // Obtener parametro idPedido
        $parametro = $_GET['idPedido'];

        // Tratar retorno
        $retorno = Ventas::getPedidoById($parametro);


        if ($retorno) {

            $pedido["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $pedido["pedido"] = $retorno;
            // Enviar objeto json de la categoria
            print json_encode($pedido);
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

