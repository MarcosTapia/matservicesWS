<?php

/**
 * Representa el la estructura de los Proveedores
 * almacenadas en la base de datos
 */
require '../db/Database.php';

class Proveedores
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'Proveedores'
     *
     * @param $idProveedor Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM proveedores";
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
     * Obtiene los campos de un Proveedor con un identificador
     * determinado
     *
     * @param $idProveedor Identificador del alumno
     * @return mixed
     */
    public static function getById($idProveedor)
    {
        // Consulta de la tabla Proveedores
        $consulta = "SELECT *
                             FROM proveedores
                             WHERE idProveedor = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idProveedor));
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
     * @param $idProveedor      identificador etc etc
     */
    public static function update(
        $idProveedor,
        $empresa,
        $nombre,
        $apellidos,
        $telefono_casa,
        $telefono_celular,
        $direccion1,
        $direccion2,
        $rfc,
        $email,
        $ciudad,
        $estado,
        $cp,
        $pais,
        $comentarios,
        $noCuenta
    )
    {  
        // Creando consulta UPDATE
        $consulta = "UPDATE proveedores" .
            " SET empresa=?, nombre=?, apellidos=?, telefono_casa=?,".
            " telefono_celular=?, direccion1=?, direccion2=?, "
            . "rfc=?, email=?, ciudad=?, estado=?, "
            . "cp=?, pais=?, comentarios=?, noCuenta=? " .
            "WHERE idProveedor=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($empresa,
            $nombre,$apellidos,$telefono_casa,
            $telefono_celular,$direccion1,$direccion2,
            $rfc,$email,$ciudad,$estado,
            $cp,$pais,$comentarios,$noCuenta,$idProveedor));

        return $cmd;
    }

    /**
     * Insertar un nuevo Proveedor
     *
     * @return PDOStatement
     */
    public static function insert(
        $empresa,
        $nombre,
        $apellidos,
        $telefono_casa,
        $telefono_celular,
        $direccion1,
        $direccion2,
        $rfc,
        $email,
        $ciudad,
        $estado,
        $cp,
        $pais,
        $comentarios,
        $noCuenta
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO proveedores ( " .
            "empresa," .
            "nombre," .
            "apellidos," .
            "telefono_casa," .
            "telefono_celular," .
            "direccion1," .
            "direccion2," .
            "rfc," .
            "email," .
            "ciudad," .
            "estado," .
            "cp," .
            "pais," .
            "comentarios," .
            "noCuenta)" .
            " VALUES( ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $empresa,
                $nombre,
                $apellidos,
                $telefono_casa,
                $telefono_celular,
                $direccion1,
                $direccion2,
                $rfc,
                $email,
                $ciudad,
                $estado,
                $cp,
                $pais,
                $comentarios,
                $noCuenta
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idProveedor identificador de la tabla Proveedores
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($idProveedor)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM proveedores WHERE idProveedor=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idProveedor));
    }
    
}

?>