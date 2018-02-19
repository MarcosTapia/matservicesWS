<?php
/**
 * Insertar un nuevo alumno en la base de datos
 */

require 'Usuarios.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Insertar Usuarios
    $retorno = Usuarios::insert(
        $body['usuario'],
        $body['clave'],
        $body['permisos'],
        $body['nombre'],
        $body['apellido_paterno'],
        $body['apellido_materno'],
        $body['telefono_casa'],
        $body['telefono_celular'],
        $body['idSucursal']
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