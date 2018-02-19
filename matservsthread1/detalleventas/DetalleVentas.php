<?php

/**
 * Representa el la estructura del detalle de las ventas
 * almacenadas en la base de datos
 */
require '../db/Database.php';

class DetalleVentas
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'detalleVentas'
     *
     * @param $idDetalleVenta Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM detalleventas";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene los campos de un registro de detalle de Venta con un identificador
     * determinado
     *
     * @param $idVenta Identificador del detalle de la venta
     * @return mixed
     */
    public static function getById($idDetalleVenta)
    {
        // Consulta de la tabla detalleventas
        $consulta = "SELECT *
                             FROM detalleventas
                             WHERE idDetalleVenta = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idVenta));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqu� puedes clasificar el error dependiendo de la excepci�n
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Obtiene los campos de un registro de detalle de Venta con un identificador
     * determinado
     *
     * @param $idVenta Identificador del detalle de la venta
     * @return mixed
     */
    public static function getByIdVenta($idVenta)
    {
        $consulta = "SELECT dv.*,inv.* FROM detalleventas as dv inner join inventario as inv on dv.idArticulo = inv.idArticulo where idVenta = ? ";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idVenta));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idDetalleVenta      identificador
     */
    public static function update(
        $idDetalleVenta,
        $descripcionCategoria
    )
    {  
        // Creando consulta UPDATE
        $consulta = "UPDATE categorias SET descripcionCategoria=? WHERE idCategoria=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($descripcionCategoria,$idCategoria));

        return $cmd;
    }

    /**
     * Insertar un nuevo Categoria
     *
     * @param $descripcioncategoria      nombre del nuevo registro
     * @return PDOStatement
     */
    public static function insert($idVenta,$idArticulo,$precio,$cantidad,$descuento){
        // Sentencia INSERT
        $comando = "INSERT INTO detalleventas (idVenta,idArticulo,precio,cantidad,descuento) VALUES(?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $idVenta,$idArticulo,$precio,$cantidad,$descuento)
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idDetalleVenta identificador de la tabla detalleventas
     * @return bool Respuesta de la eliminacion
     */
    public static function delete($idDetalleVenta)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM detalleventas WHERE idDetalleVenta=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idDetalleVenta));
    }
    
    /**
     * Insertar un nuevo detalle de pedido
     * @return PDOStatement
     */
    public static function insertaDetallePedido($idPedido,$idArticulo,$precio,$cantidad,$descuento){
        // Sentencia INSERT
        $comando = "INSERT INTO detallepedidos (idPedido,idArticulo,precio,cantidad,descuento) VALUES(?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $idPedido,$idArticulo,$precio,$cantidad,$descuento)
        );

    }
    
    
}

?>