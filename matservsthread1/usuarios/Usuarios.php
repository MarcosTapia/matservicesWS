<?php

/**
 * Representa el la estructura de las Usuarios
 * almacenadas en la base de datos
 */
require '../db/Database.php';

class Usuarios
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'Alumnos'
     *
     * @param $idAlumno Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM usuarios inner join sucursales on usuarios.idSucursal = sucursales.idSucursal";
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
     * Obtiene los campos de un Usuario con un identificador
     * determinado
     *
     * @param $idAlumno Identificador del alumno
     * @return mixed
     */
    public static function getById($idAlumno)
    {
        // Consulta de la tabla Alumnos
        $consulta = "SELECT *
                             FROM usuarios
                             WHERE idUsuario = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idAlumno));
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
     * @param $idAlumno      identificador
     * @param $nombre      nuevo nombre
     * @param $direccion nueva direccion
     
     */
    public static function update(
        $idUsuario,
        $usuario,
        $clave,
        $permisos,
        $nombre,
        $apellidoPaterno,
        $apellidoMaterno,
        $telefonoCasa,
        $telefonoCelular,
        $idSucursal
    )
    {  
        if ($clave == "") {
            // Creando consulta UPDATE
            $consulta = "UPDATE usuarios" .
                " SET usuario=?, permisos=?, nombre=?,".
                " apellido_paterno=?, apellido_materno=?, telefono_casa=?, telefono_celular=?, idSucursal=? " .
                "WHERE idUsuario=?";
            // Preparar la sentencia
            $cmd = Database::getInstance()->getDb()->prepare($consulta);
            // Relacionar y ejecutar la sentencia
            $cmd->execute(array($usuario, $permisos
                    , $nombre, $apellidoPaterno,$apellidoMaterno
                    , $telefonoCasa, $telefonoCelular,$idSucursal,$idUsuario));
        } else {
            // Creando consulta UPDATE
            $consulta = "UPDATE usuarios" .
                " SET usuario=?, clave=?, permisos=?, nombre=?,".
                " apellido_paterno=?, apellido_materno=?, telefono_casa=?, telefono_celular=?, idSucursal=? " .
                "WHERE idUsuario=?";
            // Preparar la sentencia
            $cmd = Database::getInstance()->getDb()->prepare($consulta);
            // Relacionar y ejecutar la sentencia
            $cmd->execute(array($usuario, $clave, $permisos
                    , $telefonoCasa, $telefonoCelular,$idSucursal,$idUsuario));
        }
        return $cmd;
    }

    /**
     * Insertar un nuevo Usuario
     *
     * @param $nombre      nombre del nuevo registro
     * @return PDOStatement
     */
    public static function insert(
        $usuario,
        $clave,
        $permisos,
        $nombre,
        $apellidoPaterno,
        $apellidoMaterno,
        $telefonoCasa,
        $telefonoCelular,
        $idSucursal    
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO usuarios ( " .
            "usuario," .
            "clave," .
            "permisos," .
            "nombre," .
            "apellido_paterno," .
            "apellido_materno," .
            "telefono_casa," .
            " telefono_celular," .
            " idSucursal)" .
            " VALUES( ?,?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $usuario,
                $clave,
                $permisos,
                $nombre,
                $apellidoPaterno,
                $apellidoMaterno,
                $telefonoCasa,
                $telefonoCelular,
                $idSucursal
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idAlumno identificador de la tabla Alumnos
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($idUsuario)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM usuarios WHERE idUsuario=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idUsuario));
    }
    
    
    /**
     * Obtiene los campos de un Usuario con un identificador
     * determinado
     *
     * @param $idAlumno Identificador del alumno
     * @return mixed
     */
    public static function verificaUsuario($usuario, $clave)
    {
        // Consulta de la tabla Alumnos
        $consulta = "SELECT *
                             FROM usuarios
                             WHERE usuario = ? and clave=?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($usuario,  md5($clave)));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            // Aqu� puedes clasificar el error dependiendo de la excepci�n
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
    
    /** nuevo
     * Obtiene los campos de un Usuario con un identificador
     * determinado
     *
     * @param $idAlumno Identificador del alumno
     * @return mixed
     */
    public static function getByIdBusq($idUsuario)
    {
        // Consulta de la tabla Alumnos
        $consulta = "select * from usuarios where idUsuario like '"
                .$idUsuario."%'";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
//            return $comando->fetchAll(PDO::FETCH_ASSOC);
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    /** nuevo
     * Obtiene los campos de un Usuario con un identificador
     * determinado
     *
     * @param $idAlumno Identificador del alumno
     * @return mixed
     */
    public static function getByNombreBusq($nombre)
    {
        // Consulta de la tabla Alumnos
        $consulta = "select * from usuarios where concat(nombre,' ',apellido_paterno,' ',apellido_materno) like '"
                .$nombre."%'";
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