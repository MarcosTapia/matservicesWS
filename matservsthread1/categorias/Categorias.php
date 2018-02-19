<?php

/**
 * Representa el la estructura de las Categorias
 * almacenadas en la base de datos
 */
require '../db/Database.php';

class Categorias
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'Alumnos'
     *
     * @param $idCategoria Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM categorias";
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
     * Obtiene los campos de una Categoria con un identificador
     * determinado
     *
     * @param $idAlumno Identificador de la categoria
     * @return mixed
     */
    public static function getById($idCategoria)
    {
        // Consulta de la tabla Alumnos
        $consulta = "SELECT *
                             FROM categorias
                             WHERE idCategoria = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idCategoria));
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
     * @param $idCategoria      identificador
     * @param $descripcionCategoria      nueva descripcion
     
     */
    public static function update(
        $idCategoria,
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
    public static function insert($descripcionCategoria){
        // Sentencia INSERT
        $comando = "INSERT INTO categorias (descripcionCategoria) VALUES(?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $descripcionCategoria)
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idCategoria identificador de la tabla categorias
     * @return bool Respuesta de la eliminacion
     */
    public static function delete($idCategoria)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM categorias WHERE idCategoria=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idCategoria));
    }
    
}

?>