<?php
/**
 * Actualiza un cliente especificado por su identificador
 */

require 'Clientes.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Actualizar Cliente
    $retorno = Clientes::update(
        $body['idCliente'],
        $body['empresa'],
        $body['nombre'],
        $body['apellidos'],
        $body['telefono_casa'],
        $body['telefono_celular'],
        $body['direccion1'],
        $body['direccion2'],
        $body['rfc'],
        $body['email'],
        $body['ciudad'],
        $body['estado'],
        $body['cp'],
        $body['pais'],
        $body['comentarios'],
        $body['noCuenta']);

    if ($retorno) {
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Actualizacion correcta"));
		//echo $json_string;
    } else {
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se actualizo el registro"));
		//echo $json_string;
    }
}
?>
