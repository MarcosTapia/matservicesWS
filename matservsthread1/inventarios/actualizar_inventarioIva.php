<?php
/**
 * Actualiza un producto especificado por su identificador
 */

require 'Inventarios.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Actualizar usuario
    $retorno = Inventarios::updateIva(
        $body['ivaAnt'],
        $body['ivaNvo'],
        $body['opcionCambio']);

    if ($retorno) {
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Actualizacion correcta"));
        echo $json_string;
    } else {
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se actualizo el registro"));
	echo $json_string;
    }
}
?>
