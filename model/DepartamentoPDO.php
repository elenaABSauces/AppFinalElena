<?php

/**
 * Class DepartamentoPDO
 *
 * Clase cuyos metodos hacen consultas a la tabla T02_Departamento de la base de datos
 * 
 * @author Cristina Nuñez y Javier Nieto
 * @since 1.1
 * @copyright 2020-2021 Cristina Nuñez y Javier Nieto
 * @version 1.1
 */
class DepartamentoPDO
{

    /**
     * Metodo obtenerDatosDepartamento()
     * 
     * Metodo que obtiene los datos de un departamento cuyo codigo es el pasado como parametro
     *
     * @param  string $codDepartamento codigo del departamento del que queremos obtener los datos
     * @return null|\Departamento devuelve un objeto de tipo Departamento con los datos guardados en la base de datos y null si no se ha podido encontrar
     */
    public static function obtenerDatosDepartamento($codDepartamento)
    {
        $oDepartamento = null;

        $sentenciaSQL = "Select * FROM T02_Departamento where T02_CodDepartamento=?";
        $resultadoConsulta = DBPDO::ejecutarConsulta($sentenciaSQL, [$codDepartamento]); // almacenamos en la variable $resultadoConsulta el departamento obtenidos en la consulta

        if ($resultadoConsulta->rowCount() > 0) {
            $departamento = $resultadoConsulta->fetchObject();
            // Instanciamos un objeto Departamento con los datos devueltos por la consulta
            $oDepartamento = new Departamento($departamento->T02_CodDepartamento, $departamento->T02_DescDepartamento, $departamento->T02_FechaCreacionDepartamento, $departamento->T02_VolumenNegocio, $departamento->T02_FechaBajaDepartamento);
        }

        return $oDepartamento;
    }

    /**
     * Metodo buscaDepartamentosPorDescripcion()
     * 
     * Metodo que devuelve un array con los departamentos obtenidos en la busqueda de los departamentos por la descripcion y el criterio de búsqueda
     * y el numero de paginas totales para realizar la paginacion
     *
     * @param  string $descDepartamento descripcion del departamento
     * @param string $criterioBusqueda criterio de busqueda ('Todos', 'Baja', 'Alta')
     * @param  int $numPaginaActual numero de pagina actual
     * @param  int $numMaxDepartamentos numero de departamentos por pagina
     * @return mixed[] array con los departamentos y el numero de paginas totales para realizar la paginacion
     */
    public static function buscarDepartamentosPorDescripcion($descDepartamento,$criterioBusqueda, $numPaginaActual, $numMaxDepartamentos)
    {
        $aDepartamentos = []; // declaramos e inicializamos el array de departamentos
        $numPaginasTotal = 1; // declaramos e inicializamos el numero de paginas totales

        $filtroConsulta = null;

        if ($criterioBusqueda == "Baja"){
            $filtroConsulta = "and T02_FechaBajaDepartamento is not null";
        }else if ($criterioBusqueda == "Alta"){
            $filtroConsulta = "and T02_FechaBajaDepartamento is null";
        }

        $sentenciaSQL = "Select * FROM T02_Departamento where T02_DescDepartamento LIKE '%' ? '%' ". (($filtroConsulta != null)? $filtroConsulta : NULL). " LIMIT " . (($numPaginaActual - 1) * $numMaxDepartamentos) . ',' . $numMaxDepartamentos;
        $resultadoConsulta = DBPDO::ejecutarConsulta($sentenciaSQL, [$descDepartamento]); // almacenamos en la variable $resultadoConsulta los departamentos obtenidos en la consulta

        if ($resultadoConsulta->rowCount() > 0) { // si la consulta devuelve algun departamento
            $departamento = $resultadoConsulta->fetchObject(); // obtenemos el primer departmento de la consulta, lo almacenamos en la variable $departamento y avanzamos el puntero al siguiente departamento
            $numDepartamento = 0; // declaramos e inicializamos el numero del departamento del array equivalente a la posicion del array

            while ($departamento) { // mientras haya algun departamento
                // Instanciamos un objeto Departamento con los datos devueltos por la consulta
                $oDepartamento = new Departamento($departamento->T02_CodDepartamento, $departamento->T02_DescDepartamento, $departamento->T02_FechaCreacionDepartamento, $departamento->T02_VolumenNegocio, $departamento->T02_FechaBajaDepartamento);
                $aDepartamentos[$numDepartamento] = $oDepartamento; // añadimos el objeto departamento en la posicion del array correspondiente
                $numDepartamento++; // incrementamos el numero del departamento equivalente a la posicion el array
                $departamento = $resultadoConsulta->fetchObject(); // almacenamos el siguiente departamento devuelto por la consulta y avanzamos el puntero al siguiente departamento
            }
        }

        $sentenciaSQLNumDepartamentos = "Select count(*) FROM T02_Departamento where T02_DescDepartamento LIKE '%' ? '%' ". (($filtroConsulta != null)? $filtroConsulta : NULL);
        $resultadoConsultaNumDepartamentos = DBPDO::ejecutarConsulta($sentenciaSQLNumDepartamentos, [$descDepartamento]); // almacenamos en la variable $resultadoConsultaNumDepartamentos el resultado devuelto por la consulta
        $numDepartamentos = $resultadoConsultaNumDepartamentos->fetch(); // almacenamos el la variable $numDepartamentos el numero de departamentos devuelto por la consulta

        if ($numDepartamentos[0] % $numMaxDepartamentos == 0) { // si devuelve un numero par
            $numPaginasTotal = ($numDepartamentos[0] / $numMaxDepartamentos); // el numero de paginas totales sera el resultado obtenido de dividir el numero de departamentos devuelto por la consulta y el numero maximo de paginas
        } else { // si devuelve un numero impar
            $numPaginasTotal = (floor($numDepartamentos[0] / $numMaxDepartamentos) + 1); // el numero de paginas totales sera el resultado obtenido de dividir el numero de departamentos devuelto por la consulta y el numero maximo de paginas redondeado a la baja mas uno
        }

        settype($numPaginasTotal, "integer"); // convertimos el numero de paginas totales a integer para eliminar los decimales

        return [$aDepartamentos, $numPaginasTotal];
    }

    /**
     * Metodo altaDepartamento()
     * 
     * Metodo para añadir un nuevo departamento en la base de datos 
     * devolviendo true si se ha añadido con exito o false si no se ha podido incluir en la base de datos
     *
     * @param  string $codDepartamento codigo del departamento
     * @param  string $descDepartamento descripcion del departamento
     * @param  float $volumenNegocio volumen de negocio del departamento
     * @return boolean true si se ha añadido con exito o false si no se ha podido incluir en la base de datos
     */
    public static function altaDepartamento($codDepartamento, $descDepartamento, $volumenDeNegocio)
    {
        $altaDepartamento = false; // declaramos e inicializamos $altaDepartamento a false

        $sentenciaSQL = "Insert into T02_Departamento (T02_CodDepartamento, T02_DescDepartamento, T02_FechaCreacionDepartamento, T02_VolumenNegocio) values (?,?,?,?)";
        $resultadoConsulta = DBPDO::ejecutarConsulta($sentenciaSQL, [$codDepartamento, $descDepartamento, time(), $volumenDeNegocio]); // almacenamos en la variable $resultadoConsulta el resultado obtenido al ejecutar la consulta

        if ($resultadoConsulta) { // si la consulta se ha ejecutado correctamente
            $altaDepartamento = true; // cambiamos el valor de la variable $altaDepartamento a true
        }

        return $altaDepartamento;
    }

    /**
     * Metodo bajaFisicaDepartamento()
     * 
     * Metodo que elimina un departamento por completo de la base de datos cuyo codigo es el pasado como parametro
     *
     * @param  string $codDepartamento codigo del departamento que queremos eliminar
     * @return boolean true si se ha eliminado correctamente el departamento, false en caso contrario
     */
    public static function bajaFisicaDepartamento($codDepartamento)
    {
        $departamentoEliminado = false; // Inicializamos la variable departamentoEliminado a false

        $sentenciaSQL = "Delete from T02_Departamento where T02_CodDepartamento=?";
        $resultadoConsulta = DBPDO::ejecutarConsulta($sentenciaSQL, [$codDepartamento]); // Ejecutamos la consulta y almacenamos el resultado en la variable resultadoConsulta

        if ($resultadoConsulta) { // Si se ha realizado la consulta correctamente
            $departamentoEliminado = true; // Cambiamos el valor de la variable departamentoEliminado a true 
        }

        return $departamentoEliminado;
    }

    /**
     * Metodo bajaLogicaDepartamento()
     *
     * Metodo que da de baja logica un departamento cuyo codigo es pasado por parametro
     * 
     * @param  string $codDepartamento codigo del departamento que queremos dar de baja logica
     * @param  string $fechaBaja fecha de baja con el formato "dd/mm/aaaa"
     * @return boolean true si se ha dado de baja logica correctamente, false ne caso contrario
     */
    public static function bajaLogicaDepartamento($codDepartamento, $fechaBaja)
    {
        $bajaLogica = false; // Inicializamos la variable bajaLogica a false
        $dateTimeBaja = new DateTime($fechaBaja); // Inicializamos la variable $dateTimeBaja con un objeto de tipo DateTime de la fechaBaja pasada como parametro

        $sentenciaSQL = "Update T02_Departamento set T02_FechaBajaDepartamento=? WHERE T02_CodDepartamento=?";
        $resultadoConsulta = DBPDO::ejecutarConsulta($sentenciaSQL, [$dateTimeBaja->getTimestamp(), $codDepartamento]); // Ejecutamos la consulta y almacenamos el resultado en la variable resultadoConsulta

        if ($resultadoConsulta) { // Si se ha realizado la consulta correctamente
            $bajaLogica = true; // Cambiamos el valor de la variable bajaLogica a true
        }

        return $bajaLogica;
    }

    /**
     * Metodo modificarDepartamento()
     * 
     * Metodo para modificar los datos de un departamento en la base de datos
     * devolviendo true si se ha modificado con exito o false si no se ha podido modificar en la base de datos
     *
     * @param  string $codDepartamento codigo del departamento
     * @param  string $descDepartamento descripcion del departamento
     * @param  float $volumenNegocio volumen de negocio del departamento
     * @return boolean true si se ha modificado con exito o false si no se ha podido modificar en la base de datos
     */
    public static function modificarDepartamento($codDepartamento, $descDepartamento, $volumenDeNegocio)
    {
        $departamentoModificado = false; // declaramos e inicializamos $departamentoModificado a false

        $sentenciaSQL = "Update T02_Departamento set T02_DescDepartamento = ?, T02_VolumenNegocio = ? where T02_CodDepartamento = ?";
        $resultadoConsulta = DBPDO::ejecutarConsulta($sentenciaSQL, [$descDepartamento, $volumenDeNegocio, $codDepartamento]); // almacenamos en la variable $resultadoConsulta el resultado obtenido al ejecutar la consulta

        if ($resultadoConsulta) { // si la consulta se ha ejecutado correctamente
            $departamentoModificado = true; // cambiamos el valor de la variable $departamentoModificado a true
        }

        return $departamentoModificado;
    }

    /**
     * Metodo rehabilitacionDepartamento()
     *
     * Metodo que rehabilita un departamento poniendo su fehca de baja a null
     * 
     * @param  string $codDepartamento codigo del departamento que queremos rehabilitar
     * @return boolean true si se ha rehabilitado el departamento, false en caso contrario 
     */
    public static function rehabilitacionDepartamento($codDepartamento)
    {
        $rehabilitacion = false; // Inicializamos la variable rehabilitacion a false

        $sentenciaSQL = "Update T02_Departamento set T02_FechaBajaDepartamento=null WHERE T02_CodDepartamento=?";
        $resultadoConsulta = DBPDO::ejecutarConsulta($sentenciaSQL, [$codDepartamento]); // Ejecutamos la consulta y almacenamos el resultado en la variable resultadoConsulta

        if ($resultadoConsulta) { // Si se ha realizado la consulta correctamente
            $rehabilitacion = true; // Cambiamos el valor de la variable rehabilitacion a true
        }

        return $rehabilitacion;
    }

    /**
     * Metodo validarCodNoExiste()
     * 
     * Metodo que valida si un codigo de departamento ya se encuentra o no en la base de datos,
     * devolviendo true si el codigo introducido no existe o false si ya existe
     *
     * @param string $codDepartamento codigo del departamento
     * @return boolean true si el codigo introducido no existe o false si ya existe
     */
    public static function validarCodNoExiste($codDepartamento)
    {
        $codNoExiste = true; // declaramos e inicializamos $codNoExiste a true

        $sentenciaSQL = "Select T02_CodDepartamento from T02_Departamento where T02_CodDepartamento=?";
        $resultadoConsulta = DBPDO::ejecutarConsulta($sentenciaSQL, [$codDepartamento]); // almacenamos en la variable $resultadoConsulta el resultado obtenido al ejecutar la consulta

        if ($resultadoConsulta->rowCount() > 0) { // si el codigo de departamento se encuentra en la base de datos
            $codNoExiste = false; // cambiamos el valor de la variable $codNoExiste a false
        }

        return $codNoExiste;
    }
        
    /**
     * Metodo exportarDepartamentos()
     * 
     * Metodo que exporta los departamentos almacenados en la base de datos en distintos formatos,
     * estos formatos pueden ser xml o json
     *
     * @param  string $tipo tipo de archivo que se desea exportar (xml o json)
     * @return void
     */
    public static function exportarDepartamentos($tipo)
    {
        $sentenciaSQL = "Select * from T02_Departamento";
        $resultadoConsulta = DBPDO::ejecutarConsulta($sentenciaSQL, []);
        if (isset($resultadoConsulta)) {
            switch ($tipo) {
                case 'xml':

                    $archivoXML = new DOMDocument("1.0", "utf-8"); //Creamos un objeto DOMDocument con dos parámetros, la versión y la codificación del documento
                    $archivoXML->formatOutput = true; //Formateamos la salida

                    $nodoDepartamentos = $archivoXML->appendChild($archivoXML->createElement("Departamentos")); //Creamos el nodo departamentos
                    $registro = $resultadoConsulta->fetchObject();
                    while ($registro) {
                        $nodoDepartamento  = $nodoDepartamentos->appendChild($archivoXML->createElement("Departamento")); //Creamos un hijo dentro del nodo departamentos llamado departamento
                        $nodoDepartamento->appendChild($archivoXML->createElement("CodDepartamento", $registro->T02_CodDepartamento)); //Creamos un hijo dentro del nodo departamento llamado CodDepartamento y le asignamos el valor correspondiente
                        $nodoDepartamento->appendChild($archivoXML->createElement("DescDepartamento", $registro->T02_DescDepartamento)); //Creamos un hijo dentro del nodo departamento llamado DescDepartamento y le asignamos el valor correspondiente
                        $nodoDepartamento->appendChild($archivoXML->createElement("FechaCreacionDepartamento", $registro->T02_FechaCreacionDepartamento)); //Creamos un hijo dentro del nodo departamento llamado FechaCreacion y le asignamos el valor correspondiente
                        $nodoDepartamento->appendChild($archivoXML->createElement("FechaBajaDepartamento", $registro->T02_FechaBajaDepartamento)); //Creamos un hijo dentro del nodo departamento llamado FechaBaja y le asignamos el valor correspondiente
                        $nodoDepartamento->appendChild($archivoXML->createElement("VolumenNegocio", $registro->T02_VolumenNegocio)); //Creamos un hijo dentro del nodo departamento llamado volumenNegocio y le asignamos el valor correspondiente 

                        $registro =  $resultadoConsulta->fetchObject(); //Obtenemos el siguiente registro de la consulta y avanzamos el puntero al siguiente
                    }

                    $archivoXML->save("tmp/tablaDepartamento.xml"); //Guardamos el archivo XML en la carpeta tmp del servidor

                    header('Content-Type: text/xml;charset=utf-8'); //Tipo del archivo
                    header('Content-Disposition: attachment; filename="tablaDepartamento.xml"'); //Nombre del archivo de la descarga
                    readfile("tmp/tablaDepartamento.xml"); //Ubicación del archivo
                    exit;

                    break;

                case 'json':
                    $aDepartamentos = []; // declaramos el array donde almacenaremos los departamentos del archivo json

                    $registro = $resultadoConsulta->fetchObject(); // obtenemos el primer registro y avanzamos el puntero al siguiente
                    while ($registro) {

                        // añadimos un array asociativo por cada departamento de la base de datos en el array de departamentos
                        $aDepartamentos[] = [
                            'CodDepartamento' => $registro->T02_CodDepartamento,
                            'DescDepartamento' => $registro->T02_DescDepartamento,
                            'FechaCreacionDepartamento' => $registro->T02_FechaCreacionDepartamento,
                            'FechaBajaDepartamento' => $registro->T02_FechaBajaDepartamento,
                            'VolumenNegocio' => $registro->T02_VolumenNegocio
                        ];
                        $registro = $resultadoConsulta->fetchObject(); // avanzamos el puntero al siguiente registro
                    }

                    $fichero = fopen('tmp/tablaDepartamento.json', 'w'); // abrimos el fichero json
                    fwrite($fichero, json_encode($aDepartamentos, JSON_PRETTY_PRINT)); // escribimos el array formateado en el archivo json
                    fclose($fichero); // cerramos el fichero

                    header('Content-Type: application/json;charset=utf-8'); //Tipo del archivo
                    header('Content-Disposition: attachment; filename="tablaDepartamento.json"'); //Nombre del archivo de la descarga
                    readfile("tmp/tablaDepartamento.json"); //Ubicación del archivo
                    exit;

                    break;
            }
        }
    }
    
    /**
     * Metodo importarDepartamentos()
     * 
     * Metodo que sirve para importar departamentos a nuestra base de datos a partir de un archivo,
     * este archivo puede tener extension xml o json
     *
     * @param  string $fichero fichero que queremos importar
     * @param  string $tipo tipo de archivo que se desea exportar (xml o json)
     * @return void
     */
    public static function importarDepartamentos($fichero, $tipo)
    {
        $sentenciaSQL = "Insert into T02_Departamento values (?, ?, ?, ?, ?)";

        switch ($tipo) { // filtramos el tipo que el usuario desea importar
            case 'xml':

                move_uploaded_file($fichero, 'tmp/copiaDeSeguridad.xml'); //Movemos el archivo al tmp con el nombre que deseemos

                $archivoXML = new DOMDocument("1.0", "utf-8"); //Creamos un objeto DOMDocument con dos parámetros, la versión y la codificación del documento
                $archivoXML->load('tmp/copiaDeSeguridad.xml'); //Cargamos el documento XML

                $numeroDepartamentos = $archivoXML->getElementsByTagName('Departamento')->count(); //Guardamos el número de departamentos que hay en el archivoXML
                for ($numeroDepartamento = 0; $numeroDepartamento < $numeroDepartamentos; $numeroDepartamento++) { //Recorremos los departamentos

                    $CodDepartamento = $archivoXML->getElementsByTagName("CodDepartamento")->item($numeroDepartamento)->nodeValue; //Guardamos el valor del elemento del cógido de departamento
                    if (!self::validarCodNoExiste($CodDepartamento)) { // si el departamento ya se encuentra en la base de datos
                        self::bajaFisicaDepartamento($CodDepartamento); // lo eliminamos para importarlo posteriormente actualizado
                    }
                    $DescDepartamento = $archivoXML->getElementsByTagName("DescDepartamento")->item($numeroDepartamento)->nodeValue; //Guardamos el valor del elemento de la descripción del departamento

                    $timestampFechaCreacion = $archivoXML->getElementsByTagName("FechaCreacionDepartamento")->item($numeroDepartamento)->nodeValue; //Guardamos el valor del elemento de la fecha de creación del departamento

                    $timestampFechaBaja = $archivoXML->getElementsByTagName("FechaBajaDepartamento")->item($numeroDepartamento)->nodeValue; //Guardamos el valor del elemento de la fecha de baja
                    if (empty($timestampFechaBaja)) { //Si el elemento de la feha de baja está vacío
                        $timestampFechaBaja = null; //Le asignamos el valor de null para que no de error a la hora de insertar en la base de datos
                    }

                    $VolumenNegocio = $archivoXML->getElementsByTagName("VolumenNegocio")->item($numeroDepartamento)->nodeValue; //Guardamos el valor del elemento del volumen de negocio

                    //Asignamos al array parametros los diferentes valores de los campos guardados
                    $parametros = [$CodDepartamento, $DescDepartamento, $timestampFechaCreacion, $VolumenNegocio, $timestampFechaBaja];
                    DBPDO::ejecutarConsulta($sentenciaSQL, $parametros); //Ejecutamos la consulta con los parámetros
                }
                break;

            case 'json':

                move_uploaded_file($fichero, 'tmp/copiaDeSeguridad.json'); //Movemos el archivo al tmp con el nombre que deseemos

                $archivoJson = file_get_contents('tmp/copiaDeSeguridad.json'); // Almacenamos el fichero convertido en string
                $aDepartamentos = json_decode($archivoJson, true); // decodificamos el archivo json

                foreach($aDepartamentos as $aDepartamento){ //recorremos la informacion del archivo
                    $codDepartamento = $aDepartamento['CodDepartamento'];
                    if(!self::validarCodNoExiste($codDepartamento)){ // si el codigo de departamento existe en la base de datos
                        self::bajaFisicaDepartamento($codDepartamento); // eliminamos el departamento para importarlo actualizado posteriormente
                    }
                    
                    //Creamos el array de los parametros que vamos a insertar en la base de datos
                    $parametros = [$aDepartamento['CodDepartamento'], 
                                   $aDepartamento['DescDepartamento'], 
                                   $aDepartamento['FechaCreacionDepartamento'],
                                   $aDepartamento['VolumenNegocio'],
                                   $aDepartamento['FechaBajaDepartamento']];
                    DBPDO::ejecutarConsulta($sentenciaSQL, $parametros); //Ejecutamos la consulta con los parámetros
                }
                break;
        }
    }
}