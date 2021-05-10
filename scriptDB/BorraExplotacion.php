<?php 
        require_once "../config/configDB.php";//Incluimos el archivo confDBPDO.php para poder acceder al valor de las constantes de los distintos valores de la conexión 
        
            try {
                $miDB = new PDO(DNS,USER,PASSWORD);//Instanciamos un objeto PDO y establecemos la conexión
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Configuramos las excepciones
                
                $sql = <<<EOD
                        DROP TABLE T02_Departamento;
                        DROP TABLE T01_Usuario;
EOD;
                
                $miDB->exec($sql);
                
                echo "<h3> <span style='color: green;'>"."Tablas borrada</span></h3>";//Si no se ha producido ningun error nos mostrara� "Conexion establecida con exito"
            }
            catch (PDOException $excepcion) {//Codigo que se ejecutará si se produce alguna excepcion
                $errorExcepcion = $excepcion->getCode();//Almacenamos el código del error de la excepción en la variable $errorExcepcion
                $mensajeExcepcion = $excepcion->getMessage();//Almacenamos el mensaje de la excepcion en la variable $mensajeExcepcion
                
                echo "<span style='color: red;'>Error: </span>".$mensajeExcepcion."<br>";//Mostramos el mensaje de la excepcion
                echo "<span style='color: red;'>Codigo del error: </span>".$errorExcepcion;//Mostramos el codigo de la excepcion
            } finally {
                unset($miDB);
            }
?>
