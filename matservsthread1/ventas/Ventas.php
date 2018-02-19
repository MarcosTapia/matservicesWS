<?php

/**
 * Representa el la estructura de las Ventas
 * almacenadas en la base de datos
 */
require '../db/Database.php';

class Ventas
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'Ventas'
     *
     * @param $idVenta Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM ventas";
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
     * Retorna en la fila especificada de la tabla 'Ventas'
     *
     * @param $fIni,$fFin Identificador del registro
     * @return array Datos del registro
     */
    public static function obtieneVentasPorFechas($fIni,$fFin)
    {
//        printf("******** %s, ********%s",$fIni,$fFin);
//        $consulta = "SELECT v.*,c.nombre as nom,u.* c.apellidos,u.* FROM ventas as v inner join clientas as c on v.idCliente = c.idCliente where DATE(v.fecha) BETWEEN ? AND ? ";
        $consulta = "SELECT v.*,c.nombre as nom, c.apellidos,u.* FROM ventas as v inner join clientes as c on v.idCliente = c.idCliente inner join usuarios as u on v.idUsuario = u.idUsuario WHERE DATE(v.fecha) BETWEEN ? AND ? ";
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
     * Retorna en la fila especificada de la tabla 'Ventas'
     * unida con otras tablas para consulta explicita
     * @param $idVenta Identificador del registro
     * @return array Datos del registro
     */
    public static function getVtasGral()
    {
//        $consulta = "SELECT v.*, c.* FROM ventas as v inner join clientas as "
//                . "c on v.idCliente = c.idCliente";
        $consulta = "SELECT v.*,c.nombre as nom, c.apellidos,u.* FROM ventas as v inner join clientes as c on v.idCliente = c.idCliente inner join usuarios as u on v.idUsuario = u.idUsuario";
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
     * Obtiene los campos de una venta con un identificador
     * determinado
     *
     * @param $idVenta Identificador de la venta
     * @return mixed
     */
    public static function getById($idVenta)
    {
        // Consulta de la tabla Ventas
        $consulta = "SELECT *
                             FROM ventas
                             WHERE idVenta = ?";

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
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idVenta      identificador, etc
     
     */
    public static function update(
        $idVenta, 
        $fecha,
        $idCliente,
        $observaciones
    )
    {  
        // Creando consulta UPDATE
        $consulta = "UPDATE ventas SET fecha=?, idCliente=?, observaciones=?  WHERE idVenta=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($fecha,$idCliente,$observaciones,$idVenta));
        return $cmd;
    }

    /**
     * Insertar una nueva Venta
     *
     * @param $fecha, $idCliente,etc      parametros del nuevo registro
     * @return PDOStatement
     */
    public static function insert($fecha,$idCliente,$observaciones,$idUsuario){
        // Sentencia INSERT
        $comando = "INSERT INTO ventas (fecha,idCliente,observaciones,idUsuario) VALUES(?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $fecha,$idCliente,$observaciones,$idUsuario)
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idVenta identificador de la tabla ventas
     * @return bool Respuesta de la eliminacion
     */
    public static function delete($idVenta)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM ventas WHERE idVenta=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idVenta));
    }
    
    /**
     * Retorna en la fila especificada de la tabla 'ventas'
     *
     * @return array Datos del registro
     */
    public static function getMaxId()
    {
        $consulta = "SELECT * FROM ventas ORDER BY idVenta DESC LIMIT 1";
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
     * Retorna en la fila especificada de la tabla 'Pedidos'
     * unida con otras tablas para consulta explicita
     * @param $idPedido Identificador del registro
     * @return array Datos del registro
     */
    public static function getPedidosGral()
    {
        $consulta = "SELECT p.*,c.nombre as nom, c.apellidos,u.* FROM pedidos as p inner join clientes as c on p.idCliente = c.idCliente inner join usuarios as u on p.idUsuario = u.idUsuario";
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
     * Obtiene los campos de un registro de detalle de Pedidos con un identificador
     * determinado
     *
     * @param $idPedido Identificador del detalle de pedido
     * @return mixed
     */
    public static function getByIdPedido($idPedido) {
        $consulta = "SELECT dp.*,inv.* FROM detallepedidos as dp inner join inventario as inv on dp.idArticulo = inv.idArticulo where idPedido = ? ";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idPedido));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Insertar un nuevo Pedido
     *
     * @param $fecha, $idCliente,etc      parametros del nuevo registro
     * @return PDOStatement
     */
    public static function insertaPedido($fecha,$idCliente,$observaciones,$idUsuario){
        // Sentencia INSERT
        $comando = "INSERT INTO pedidos (fecha,idCliente,observaciones,idUsuario) VALUES(?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $fecha,$idCliente,$observaciones,$idUsuario)
        );

    }
  
    /**
     * Retorna en la fila especificada de la tabla 'pedidos'
     *
     * @return array Datos del registro
     */
    public static function getMaxIdPedidos()
    {
        $consulta = "SELECT * FROM pedidos ORDER BY idPedido DESC LIMIT 1";
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
     * Eliminar el registro con el identificador especificado
     *
     * @param $idPedido identificador de la tabla pedidos
     * @return bool Respuesta de la eliminacion
     */
    public static function deletePedido($idPedido)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM pedidos WHERE idPedido=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idPedido));
    }


    /** 
     * Obtiene los campos de un pedido con un identificador
     * determinado
     *
     * @param $idPedido Identificador del pedido
     * @return mixed
     */
    public static function getPedidoById($idPedido)
    {
        // Consulta de la tabla Pedidos
        $consulta = "SELECT *
                             FROM pedidos
                             WHERE idPedido = ?";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idPedido));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            // Aqu� puedes clasificar el error dependiendo de la excepci�n
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
    
}

?>