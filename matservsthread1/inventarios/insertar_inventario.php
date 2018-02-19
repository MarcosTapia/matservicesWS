<?php
/**
 * Insertar un nuevo producto en la base de datos
 */

require 'Inventarios.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Insertar Inventario(Producto)
    $retorno = Inventarios::insert(
        $body['codigo'],
        $body['descripcion'],
        $body['precioCosto'],
        $body['precioUnitario'],
        $body['porcentajeImpuesto'],
        $body['existencia'],
        $body['existenciaMinima'],
        $body['ubicacion'],
        $body['fechaIngreso'],
        $body['proveedor'],
        $body['categoria'],
        $body['sucursal'],
        $body['nombre_img'],
        $body['observaciones']
            );
//            echo $body['codigo']."->".$body['descripcion']."->".$body['precioCosto']."->".
//            $body['precioUnitario']."->".$body['porcentajeImpuesto']."->".$body['existencia']."->".
//            $body['existenciaMinima']."->".$body['ubicacion']."->".$body['fechaIngreso']
//            ."->".$body['proveedor']."->".$body['categoria']."->".$body['observaciones']."->".$body['nombre_img'];

    if ($retorno) {
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Creacion correcta"));
        echo $json_string;
    } else {
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se creo el registro"));
	echo $json_string;
    }
}

?>