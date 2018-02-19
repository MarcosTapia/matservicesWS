<?php
/**
 * Insertar un nuevo registro de detalle compra en la base de datos
 */

require 'Compras.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
//    echo "<script language='javascript'>alert('dssdsa');</script>";
//    echo "dssdsa albanene";
    // Insertar Detalle Compra
    $retorno = Compras::insertarTemporalVtaCompra(
        $body['idArticulo'],
        $body['codigo'],
        $body['precio'],
        $body['cantidad'],
        $body['descuento'],
        $body['total']
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