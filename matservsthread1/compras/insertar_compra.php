<?php
/**
 * Insertar un nueva compra en la base de datos
 */

require 'Compras.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Insertar Ventas
    $retorno = Compras::insert(
        $body['fecha'],
        $body['codigoProveedor'],
        $body['observaciones'],
        $body['idUsuario']
            );
    
    if ($retorno) {
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Creacion correcta"));
		//echo $json_string;
    } else {
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se creo el registro"));
		//echo $json_string;
    }
}

?>