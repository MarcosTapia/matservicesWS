<?php

/**
 * Representa el la estructura de los Clientes
 * almacenadas en la base de datos
 */
require '../db/Database.php';

class Clientes
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'clientes'
     *
     * @param $idCliente Identificador del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM clientes";
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
     * Obtiene los campos de un Cliente con un identificador
     * determinado
     *
     * @param $idCliente Identificador del cliente
     * @return mixed
     */
    public static function getById($idCliente)
    {
        // Consulta de la tabla clientes
        $consulta = "SELECT *
                             FROM clientes
                             WHERE idCliente = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idCliente));
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
     * @param $idCliente      identificador etc etc
     
     */
    public static function update(
        $idCliente,
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
        $consulta = "UPDATE clientes" .
            " SET empresa=?, nombre=?, apellidos=?, telefono_casa=?,".
            " telefono_celular=?, direccion1=?, direccion2=?, "
            . "rfc=?, email=?, ciudad=?, estado=?, "
            . "cp=?, pais=?, comentarios=?, noCuenta=? " .
            "WHERE idCliente=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($empresa,
            $nombre,$apellidos,$telefono_casa,
            $telefono_celular,$direccion1,$direccion2,
            $rfc,$email,$ciudad,$estado,
            $cp,$pais,$comentarios,$noCuenta,$idCliente));

        return $cmd;
    }

    /**
     * Insertar un nuevo Cliente
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
        $comando = "INSERT INTO clientes ( " .
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
     * @param $idCliente identificador de la tabla Clientes
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($idCliente)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM clientes WHERE idCliente=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idCliente));
    }
    
}

?>