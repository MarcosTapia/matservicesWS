<?php

/**
 * Representa el la estructura de las Sucursales
 * almacenadas en la base de datos
 */
require '../db/Database.php';

class Sucursales
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'Sucursales'
     *
     * @param $idSucursal Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM sucursales";
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
     * Obtiene los campos de una Sucursal con un identificador
     * determinado
     *
     * @param $idSucursal Identificador de la sucursal
     * @return mixed
     */
    public static function getById($idSucursal)
    {
        // Consulta de la tabla Sucursales
        $consulta = "SELECT *
                             FROM sucursales
                             WHERE idSucursal = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idSucursal));
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
     * @param $idSucursal      identificador
     * @param $descripcionSucursal      nueva descripcion
     
     */
    public static function update(
        $idSucursal,
        $descripcionSucursal
    )
    {  
        // Creando consulta UPDATE
        $consulta = "UPDATE sucursales SET descripcionSucursal=? WHERE idSucursal=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($descripcionSucursal,$idSucursal));

        return $cmd;
    }

    /**
     * Insertar un nueva Sucursal
     *
     * @param $descripcionSucursal      nombre del nuevo registro
     * @return PDOStatement
     */
    public static function insert($descripcionSucursal){
        // Sentencia INSERT
        $comando = "INSERT INTO sucursales (descripcionSucursal) VALUES(?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $descripcionSucursal)
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idSucursal identificador de la tabla sucursales
     * @return bool Respuesta de la eliminacion
     */
    public static function delete($idSucursal)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM sucursales WHERE idSucursal=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idSucursal));
    }
    
}

?>