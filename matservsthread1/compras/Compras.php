<?php

/**
 * Representa el la estructura de las Compras
 * almacenadas en la base de datos
 */
require '../db/Database.php';

class Compras
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'Compras'
     *
     * @param $idCompra Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM compras";
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
     * Retorna en la fila especificada de la tabla 'Compras'
     * unida con otras tablas para consulta explicita
     * @param $idCompra Identificador del registro
     * @return array Datos del registro
     */
    public static function getComprasGral()
    {
        $consulta = "SELECT co.*,p.nombre as nom, p.apellidos,u.* FROM compras as co inner join proveedores as p on co.idProveedor = p.idProveedor inner join usuarios as u on co.idUsuario = u.idUsuario";
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
     * Retorna en la fila especificada de la tabla 'Compras'
     *
     * @param $fIni,$fFin Identificador del registro
     * @return array Datos del registro
     */
    public static function obtieneComprasPorFechas($fIni,$fFin)
    {
        $consulta = "SELECT co.*,p.nombre as nom,p.apellidos,u.* FROM compras as co inner join proveedores as p on co.idProveedor = p.idProveedor inner join usuarios as u on co.idUsuario = u.idUsuario WHERE DATE(co.fecha) BETWEEN ? AND ? ";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($fIni,$fFin));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Obtiene los campos de una compra con un identificador
     * determinado
     *
     * @param $idCompra Identificador de la compra
     * @return mixed
     */
    public static function getById($idCompra)
    {
        // Consulta de la tabla Ventas
        $consulta = "SELECT *
                             FROM compras
                             WHERE idCompra = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idCompra));
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
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idCompra      identificador, etc
     
     */
    public static function update(
        $idCompra, 
        $fecha,
        $idCliente,
        $observaciones
    )
    {  
        // Creando consulta UPDATE
        $consulta = "UPDATE compras SET fecha=?, idCliente=?, observaciones=?  WHERE idCompra=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($fecha,$idCliente,$observaciones,$idCompra));
        return $cmd;
    }

    /**
     * Insertar una nueva Compra
     *
     * @param $fecha, $idCompra,etc      parametros del nuevo registro
     * @return PDOStatement
     */
    public static function insert($fecha,$idProveedor,$observaciones,$idUsuario){
        // Sentencia INSERT
        $comando = "INSERT INTO compras (fecha,idProveedor,observaciones,idUsuario) VALUES(?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $fecha,$idProveedor,$observaciones,$idUsuario)
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idCompra identificador de la tabla compras
     * @return bool Respuesta de la eliminacion
     */
    public static function delete($idCompra)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM compras WHERE idCompra=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idVenta));
    }
    
    /**
     * Retorna en la fila especificada de la tabla 'compras'
     *
     * @return array Datos del registro
     */
    public static function getMaxId()
    {
        $consulta = "SELECT * FROM compras ORDER BY idCompra DESC LIMIT 1";
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
     * Borra tabla temporal de compraVenta
     * @return bool Respuesta de la eliminacion
     */
    public static function borraTemporalVtaCompra($idCompra)
    {
        // Sentencia DELETE
        $comando = "truncate table temporalVtaCompra";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idCompra));
    }
    
    /**
     * Insertar un nuevo detalle en temporalVtaCompra
     *
     * @return PDOStatement
     */
    public static function insertarTemporalVtaCompra($idArticulo,$codigo,$precio,$cantidad,$descuento,$total){
        // Sentencia INSERT
        $comando = "INSERT INTO temporalVtaCompra (idArticulo,codigo,precio,cantidad,descuento,total) VALUES(?,?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $idArticulo,$codigo,$precio,$cantidad,$descuento,$total)
        );

    }
    
    
    /**
     * Retorna en la fila especificada de la tabla 'temporalvtacompra'
     *
     * @return array Datos del registro
     */
    public static function getAllTemporalVtaCompra()
    {
        $consulta = "SELECT * FROM temporalvtacompra";
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
}

?>