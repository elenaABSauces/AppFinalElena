<?php

/**
 * Class DBPDO
 *
 * Clase cuyo metodo permite establecer una conexion con la base de datos 
 * 
 * @author Cristina Nuñez y Javier Nieto
 * @since 1.0
 * @copyright 2020-2021 Cristina Nuñez y Javier Nieto
 * @version 1.0
 */

class DBPDO
{

    /**
     * Metodo ejecutarConsulta()
     * 
     * Metodo que nos permite ejecutar una consulta sql a la base de datos
     * 
     * @param string $sentenciaSQL sentencia sql que queremos ejecutar
     * @param array $parametros parametros que necesita la consulta
     * @return null|PDOStatement resultado que devolverá la consulta
     */
    public static function ejecutarConsulta($sentenciaSQL, $parametros)
    {
        try {
            $miDB = new PDO(DNS, USER, PASSWORD);
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $consulta = $miDB->prepare($sentenciaSQL); //Preparamos la consulta.
            $consulta->execute($parametros); //Ejecutamos la consulta.
        } catch (PDOException $exception) {
            $consulta = null; //Destruimos la consulta.
            echo $exception->getMessage();
            unset($miDB);
        }
        return $consulta;
    }
}
