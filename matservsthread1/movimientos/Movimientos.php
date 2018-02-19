<?php

/**
 * Representa el la estructura de los Movimientos
 * almacenadas en la base de datos
 */
require '../db/Database.php';

class Movimientos
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'movimientos'
     *
     * @param $idMovimiento Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM movimientos";
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
     * Retorna en la fila especificada de la tabla 'movimientos' con sus atributos
     * relacionados con todas las columnas de las otras tablas
     *
     * @param $idMovimiento Identificador del registro
     * @return array Datos del registro
     */
    public static function getMovimientosExplicito()
    {
        $consulta = "SELECT mov.*, inv.*, u.* FROM movimientos as mov inner join inventario as "
                . "inv on mov.idArticulo = inv.idArticulo inner join usuarios as u on mov.idUsuario = u.idUsuario";
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
     * Obtiene los campos de un movimiento con un identificador
     * determinado
     *
     * @param $idMovimiento Identificador del movimiento
     * @return mixed
     */
    public static function getById($idMovimiento)
    {
        // Consulta de la tabla Movimientos
        $consulta = "SELECT *
                             FROM movimientos
                             WHERE idMovimiento = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idMovimiento));
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
     * @param $idMovimiento      identificador
     
     */
    public static function update(
        $idMovimiento,
        $descripcionCategoria
    )
    {  
        // Creando consulta UPDATE
        $consulta = "UPDATE movimientos SET descripcionCategoria=? WHERE idCategoria=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($descripcionCategoria,$idCategoria));

        return $cmd;
    }

    /**
     * Insertar un nuevo Movimiento
     *
     * @return PDOStatement
     */
    public static function insert($idArticulo,$idUsuario,$tipoOperacion,$cantidad,$fechaOperacion){
        // Sentencia INSERT
        $comando = "INSERT INTO movimientos (idArticulo,idUsuario,tipoOperacion,cantidad,fechaOperacion) VALUES(?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $idArticulo,$idUsuario,$tipoOperacion,$cantidad,$fechaOperacion)
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idMovimiento identificador de la tabla movimientos
     * @return bool Respuesta de la eliminacion
     */
    public static function delete($idMovimiento)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM movimientos WHERE idMovimiento=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idMovimiento));
    }
    
    /**
     * Obtiene los campos de un registro de movimientos con un identificador
     * determinado
     *
     * @param $idArticulo Identificador del articulo
     * @return mixed
     */
    public static function getMovByIdArticulo($idArticulo)
    {
//        $consulta = "SELECT * from movimientos where idArticulo = ?";
        $consulta = "SELECT mov.*, inv.*, u.* FROM movimientos as mov inner join inventario as "
                . "inv on mov.idArticulo = inv.idArticulo inner join usuarios as u on mov.idUsuario = u.idUsuario where mov.idArticulo = ?";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idArticulo));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    
}

?>