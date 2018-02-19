<?php
/**
 * Obtiene todas los articulos/productos/servicios de la base de datos por busqueda
 */
require 'Inventarios.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['query'])) {
        // Obtener par�metro idalumno
        $parametro = $_GET['query'];
        // Manejar petici�n GET
        $inventarios = Inventarios::getAllByCodigoDescripcion($parametro);
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
}



//    if (isset($_GET['idArticulo'])) {
//        // Obtener par�metro idalumno
//        $parametro = $_GET['idArticulo'];
//        // Tratar retorno
//        $retorno = Inventarios::getById($parametro);
//        if ($retorno) {
//            $inventario["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
//            $inventario["inventario"] = $retorno;
//            // Enviar objeto json del alumno
//            print json_encode($inventario);
//        } else {
//            // Enviar respuesta de error general
//            print json_encode(
//                array(
//                    'estado' => '2',
//                    'mensaje' => 'No se obtuvo el registro'
//                )
//            );
//        }
//    } else {
//        // Enviar respuesta de error
//        print json_encode(
//            array(
//                'estado' => '3',
//                'mensaje' => 'Se necesita un identificador'
//            )
//        );
//    }
