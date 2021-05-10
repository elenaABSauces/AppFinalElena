<?php  
        require_once "../config/configDB.php";//Incluimos el archivo confDBPDO.php para poder acceder al valor de las constantes de los distintos valores de la conexiÃ³n 
        
            try {
                $miDB = new PDO(DNS,USER,PASSWORD);//Instanciamos un objeto PDO y establecemos la conexion
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Configuramos las excepciones
                
                $sql = <<<EOD
                        CREATE TABLE IF NOT EXISTS T02_Departamento(
                            T02_CodDepartamento VARCHAR(3) PRIMARY KEY,
                            T02_DescDepartamento VARCHAR(255) NOT NULL,
                            T02_FechaCreacionDepartamento INT NOT NULL,
                            T02_VolumenNegocio FLOAT NOT NULL,
                            T02_FechaBajaDepartamento INT DEFAULT NULL
                        )ENGINE=INNODB;

                        CREATE TABLE IF NOT EXISTS T01_Usuario(
                            T01_CodUsuario VARCHAR(10) PRIMARY KEY,
                            T01_Password VARCHAR(64) NOT NULL,
                            T01_DescUsuario VARCHAR(255) NOT NULL,
                            T01_NumConexiones INT DEFAULT 0,
                            T01_FechaHoraUltimaConexion INT,
                            T01_Perfil enum('administrador', 'usuario') DEFAULT 'usuario',
                            T01_ImagenUsuario mediumblob NULL
                        )ENGINE=INNODB;
EOD;
                
                $miDB->exec($sql);
                
                echo "<h3> <span style='color: green;'>"."Tablas creadas correctamente</span></h3>";//Si no se ha producido ningun error nos mostrara¡ "Conexion establecida con Exito"
            }
            catch (PDOException $excepcion) {//Codigo que se ejecutara si se produce alguna excepcion
                $errorExcepcion = $excepcion->getCode();//Almacenamos el codigo del error de la excepcion en la variable $errorExcepcion
                $mensajeExcepcion = $excepcion->getMessage();//Almacenamos el mensaje de la excepcion en la variable $mensajeExcepcion
                
                echo "<span style='color: red;'>Error: </span>".$mensajeExcepcion."<br>";//Mostramos el mensaje de la excepcion
                echo "<span style='color: red;'>Codigo del error: </span>".$errorExcepcion;//Mostramos el codigo de la excepcion
            } finally {
                unset($miDB);
            }
?>