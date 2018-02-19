<?php
/**
 * Insertar un nueva categoria en la base de datos
 */

require 'Movimientos.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Insertar Usuarios
    $retorno = Movimientos::insert(
        $body['idArticulo'],
        $body['idUsuario'],
        $body['tipoOperacion'],
        $body['cantidad'],
        $body['fechaOperacion']
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