<?php

/**
 * Representa el la estructura del detalle de las compras
 * almacenadas en la base de datos
 */
require '../db/Database.php';

class DetalleCompras
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'detalleCompras'
     *
     * @param $idDetalleCompra Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM detallecompras";
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
     * Obtiene los campos de un registro de detalle de Compra con un identificador
     * determinado
     *
     * @param $idDetalleCompra Identificador del detalle de la compra
     * @return mixed
     */
    public static function getById($idDetalleCompra)
    {
        // Consulta de la tabla detallecompras
        $consulta = "SELECT *
                             FROM detallecompras
                             WHERE idDetalleCompra = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idDetalleCompra));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqu� puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Obtiene los campos de un registro de detalle de Compra con un identificador
     * determinado
     *
     * @param $idVenta Identificador del detalle de la compra
     * @return mixed
     */
    public static function getByIdCompra($idCompra)
    {
        $consulta = "SELECT dc.*,inv.* FROM detallecompras as dc inner join inventario as inv on dc.idArticulo = inv.idArticulo where idCompra = ? ";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idCompra));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idDetalleCompra      identificador
     */
    public static function update(
        $idDetalleCompra,
        $descripcionCategoria
    )
    {  
        // Creando consulta UPDATE
        $consulta = "UPDATE detallecompras SET descripcionCategoria=? WHERE idCategoria=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($descripcionCategoria,$idCategoria));

        return $cmd;
    }

    /**
     * Insertar un nuevo detalle de Compra
     *
     * @param $idCompra      nombre del id de compra
     * @return PDOStatement
     */
    public static function insert($idCompra,$idArticulo,$precio,$cantidad,$descuento){
        // Sentencia INSERT
        $comando = "INSERT INTO detallecompras (idCompra,idArticulo,precio,cantidad,descuento) VALUES(?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $idCompra,$idArticulo,$precio,$cantidad,$descuento)
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idDetalleCompra identificador de la tabla detallecompras
     * @return bool Respuesta de la eliminacion
     */
    public static function delete($idDetalleCompra)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM detallecompras WHERE idDetalleCompra=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idDetalleCompra));
    }
    
}

?>