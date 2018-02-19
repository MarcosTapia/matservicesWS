<?php
/**
 * Insertar un nueva venta en la base de datos
 */

require 'Ventas.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Insertar Ventas
    $retorno = Ventas::insert(
        $body['fecha'],
        $body['codigoCliente'],
        $body['observaciones'],
        $body['idUsuario']
            );
    
    if ($retorno) {
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Creacion correcta"));
        echo $json_string;
    } else {
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se creo el registro"));
	echo $json_string;
    }
}

?>