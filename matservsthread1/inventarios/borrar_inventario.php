<?php
/**
 * Elimina un producto de la base de datos
 * distinguido por su identificador
 */

require 'Inventarios.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    $retorno = Inventarios::delete($body['idArticulo']);
    if ($retorno) {
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Eliminacion exitosa"));
	echo $json_string;
    } else {
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se elimino el registro"));
	echo $json_string;
    }
}
?>