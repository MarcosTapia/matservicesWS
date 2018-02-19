<?php
/**
 * Insertar un nuevo registro de detalle compra en la base de datos
 */

require 'DetalleCompras.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
//    echo "<script language='javascript'>alert('dssdsa');</script>";
//    echo "dssdsa albanene";
    // Insertar Detalle Compra
    $retorno = DetalleCompras::insert(
        $body['idCompra'],
        $body['idArticulo'],
        $body['precio'],
        $body['cantidad'],
        $body['descuento']
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