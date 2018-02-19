<?php
/**
 * Obtiene el detalle de una categoria especificado por
 * su identificador "idCategoria"
 */

require 'Categorias.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idCategoria'])) {

        // Obtener par�metro idCategoria
        $parametro = $_GET['idCategoria'];

        // Tratar retorno
        $retorno = Categorias::getById($parametro);


        if ($retorno) {

            $categoria["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $categoria["categoria"] = $retorno;
            // Enviar objeto json de la categoria
            print json_encode($categoria);
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

