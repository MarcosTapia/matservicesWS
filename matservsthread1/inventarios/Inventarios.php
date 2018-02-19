<?php

/**
 * Representa el la estructura de las Inventarios
 * almacenadas en la base de datos
 */
require '../db/Database.php';

class Inventarios
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'inventarios'
     *
     * @param $idArticulo Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM inventario inv inner join proveedores prov on inv.idProveedor = prov.idProveedor inner join
            categorias cat on inv.idCategoria = cat.idCategoria inner join
            sucursales suc on inv.idSucursal = suc.idSucursal";
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
     * Retorna productos por busqueda de la tabla 'inventarios'
     *
     * @param $codigo, descripcion Identificador del registro
     * @return array Datos del registro
     */
    public static function getAllByCodigoDescripcion($query)
    {
        $consulta = "SELECT codigo,descripcion FROM inventario WHERE codigo LIKE '%{$query}%' OR descripcion LIKE '%{$query}%'";
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
     * Retorna en la fila especificada de la tabla 'inventarios'
     *
     * @return array Datos del registro
     */
    public static function getMaxId()
    {
        $consulta = "SELECT * FROM inventario ORDER BY idArticulo DESC LIMIT 1";
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
     * Obtiene los campos de un Producto con un identificador
     * determinado
     *
     * @param $idArticulo Identificador del producto
     * @return mixed
     */
    public static function getById($idArticulo)
    {
        // Consulta de la tabla Alumnos
        $consulta = "SELECT *
                             FROM inventario
                             WHERE idArticulo = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idArticulo));
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
     * @param $idArticulo  identificador etc, etc
     */
    public static function update($idArticulo,$codigo,$descripcion,$precioCosto,
      $precioUnitario,$porcentajeImpuesto,$existencia,$existenciaMinima,
      $ubicacion,$fechaIngreso,$proveedor,$categoria,$sucursal,$nombre_img,$observaciones)
    {  
        //echo "<script>alert('->".$nombre_img."<-');</script>";
        if ($nombre_img=="") {
            // Creando consulta UPDATE
            $consulta = "UPDATE inventario" .
                " SET codigo=?, descripcion=?, precioCosto=?, precioUnitario=?,".
                " porcentajeImpuesto=?, existencia=?, existenciaMinima=?, ubicacion=?, " .
                " fechaIngreso=?, idProveedor=?,idCategoria=?,idSucursal=?,observaciones=? " .
                "WHERE idArticulo=?";
            // Preparar la sentencia
            $cmd = Database::getInstance()->getDb()->prepare($consulta);
            // Relacionar y ejecutar la sentencia
            $cmd->execute(array($codigo,$descripcion,$precioCosto,$precioUnitario,
                $porcentajeImpuesto,$existencia,$existenciaMinima,$ubicacion,
                $fechaIngreso,$proveedor,$categoria,$sucursal,
                $observaciones,$idArticulo));
        } else {
            // Creando consulta UPDATE
            $consulta = "UPDATE inventario" .
                " SET codigo=?, descripcion=?, precioCosto=?, precioUnitario=?,".
                " porcentajeImpuesto=?, existencia=?, existenciaMinima=?, ubicacion=?, " .
                " fechaIngreso=?, idProveedor=?,idCategoria=?,idSucursal=?,fotoProducto=?,observaciones=? " .
                "WHERE idArticulo=?";
            // Preparar la sentencia
            $cmd = Database::getInstance()->getDb()->prepare($consulta);
            // Relacionar y ejecutar la sentencia
            $cmd->execute(array($codigo,$descripcion,$precioCosto,$precioUnitario,
                $porcentajeImpuesto,$existencia,$existenciaMinima,$ubicacion,
                $fechaIngreso,$proveedor,$categoria,$sucursal,$nombre_img,
                $observaciones,$idArticulo));
        }
        return $cmd;
    }
    
    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idArticulo  identificador etc, etc
     */
    public static function ajustaInv($idArticulo,$existencia)
    {  
        //echo "<script>alert('->".$nombre_img."<-');</script>";
            // Creando consulta UPDATE
            $consulta = "UPDATE inventario" .
                " SET existencia=? " .
                "WHERE idArticulo=?";
            // Preparar la sentencia
            $cmd = Database::getInstance()->getDb()->prepare($consulta);
            // Relacionar y ejecutar la sentencia
            $cmd->execute(array($existencia,$idArticulo));
        return $cmd;
    }
    
    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idArticulo  identificador etc, etc
     */
    public static function ajustaInvFromCompras($idArticulo,$existencia,$precioCosto,$porcentajeImpuesto,$precioUnitario)
    {  
        //echo "<script>alert('->".$nombre_img."<-');</script>";
            // Creando consulta UPDATE
            $consulta = "UPDATE inventario" .
                " SET existencia=?, precioCosto=?,porcentajeImpuesto=?, precioUnitario=?" .
                "WHERE idArticulo=?";
            // Preparar la sentencia
            $cmd = Database::getInstance()->getDb()->prepare($consulta);
            // Relacionar y ejecutar la sentencia
            $cmd->execute(array($existencia,$precioCosto,$porcentajeImpuesto,$precioUnitario,$idArticulo));
        return $cmd;
    }
    
    /**
     * Insertar un nuevo Producto
     *
     * @param $codigo   codigo del nuevo registro etc etc
     * @return PDOStatement
     */
    public static function insert($codigo,$descripcion,$precioCosto,
      $precioUnitario,$porcentajeImpuesto,$existencia,$existenciaMinima,
      $ubicacion,$fechaIngreso,$proveedor,$categoria,$sucursal,$nombre_img,$observaciones)
    {
//            echo $codigo."->".$descripcion."->".$precioCosto."->".
//            $precioUnitario."->".$porcentajeImpuesto."->".$existencia."->".
//            $existenciaMinima."->".$ubicacion."->".$fechaIngreso
//            ."->".$proveedor."->".$categoria."->".$observaciones."->".$nombre_img;
        
        // Sentencia INSERT
        $comando = "INSERT INTO inventario ( " .
            "codigo," .
            "descripcion," .
            "precioCosto," .
            "precioUnitario," .
            "porcentajeImpuesto," .
            "existencia," .
            "existenciaMinima," .
            "ubicacion," .
            "observaciones," .
            "fechaIngreso,".
            "idProveedor," .
            "idCategoria," .
            "idSucursal," .
            "fotoProducto)" .
            " VALUES( ?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
//        echo "<script>alert('".$fechaIngreso."')</script>";
//        $timestamp = strtotime($fechaIngreso);
//        $fechaIngreso2 = date("Y-m-d H:i:s", $timestamp);        
//        echo "<script>alert('".$fechaIngreso2."')</script>";
//        $fechaIngreso = "&".$fechaIngreso."&";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(
            array(
                $codigo,
                $descripcion,
                $precioCosto,
                $precioUnitario,
                $porcentajeImpuesto,
                $existencia,
                $existenciaMinima,
                $ubicacion,
                $observaciones,
                $fechaIngreso,
                $proveedor,
                $categoria,
                $sucursal,
                $nombre_img
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idArticulo identificador de la tabla Inventarios
     * @return bool Respuesta de la eliminacion
     */
    public static function delete($idArticulo)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM inventario WHERE idArticulo=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idArticulo));
    }
    
    /**
     * Obtiene el inventario por su sucursal con un identificador
     * determinado
     *
     * @param $idSucursal Identificador de la sucursal
     * @return mixed
     */
    public static function getByIdSucursal($idSucursal) {
        $consulta = "SELECT * FROM inventario where idSucursal = ? ";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idSucursal));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
  
    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con iva y precios
     *
     * @param $idArticulo  identificador etc, etc
     */
    public static function updateIva($ivaAnt,$ivaNvo,$opcionCambio)
    {  
        //echo "<script>alert('->".$nombre_img."<-');</script>";
        if ($opcionCambio==1) {
            // Creando consulta UPDATE
            $consulta = "update inventario set porcentajeImpuesto=?, precioUnitario=(precioCosto*porcentajeImpuesto/100)+precioCosto where porcentajeImpuesto=?";
            // Preparar la sentencia
            $cmd = Database::getInstance()->getDb()->prepare($consulta);
            // Relacionar y ejecutar la sentencia
            $cmd->execute(array($ivaNvo,$ivaAnt));
        } else {
            // Creando consulta UPDATE
            $consulta = "update inventario set porcentajeImpuesto=?, precioUnitario=(precioCosto*porcentajeImpuesto/100)+precioCosto";
            // Preparar la sentencia
            $cmd = Database::getInstance()->getDb()->prepare($consulta);
            // Relacionar y ejecutar la sentencia
            $cmd->execute(array($ivaNvo));
        }
        return $cmd;
    }
    
    
}

?>