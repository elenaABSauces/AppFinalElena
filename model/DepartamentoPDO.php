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
     * Metodo buscarDepartamentosPorDescripcion()
     * 
     * Metodo que devuelve un array con los departamentos obtenidos en la busqueda de los departamentos por la descripcion 
     * y el numero de paginas totales para realizar la paginacion
     *
     * @param  string $descDepartamento descripcion del departamento
     * @param  string $criterioBusqueda criterio de busqueda segun el estado de la fecha de baja del departamento (todos|alta|baja)
     * @param  int $numPaginaActual numero de pagina actual
     * @param  int $numMaxDepartamentos numero de paginas totales
     * @return mixed[] array con los departamentos y el numero de paginas totales para realizar la paginacion
     */
    public static function buscarDepartamentosPorDescripcion($descDepartamento, $criterioBusqueda, $numPaginaActual, $numMaxDepartamentos)
    {
        $aDepartamentos = []; // declaramos e inicializamos el array de departamentos
        $numPaginasTotal = 1; // declaramos e inicializamos el numero de paginas totales

        $filtroConsulta = null; // declaramos e inicializamos el criterio de busqueda a null

        if ($criterioBusqueda == "baja") {
            $filtroConsulta = "and T02_FechaBajaDepartamento is not null";
        } else if ($criterioBusqueda == "alta") {
            $filtroConsulta = "and T02_FechaBajaDepartamento is null";
        }

        $sentenciaSQL = "Select * FROM T02_Departamento where T02_DescDepartamento LIKE '%' ? '%' " . (($filtroConsulta != null) ? $filtroConsulta : NULL) . " LIMIT " . (($numPaginaActual - 1) * $numMaxDepartamentos) . ',' . $numMaxDepartamentos;
        $resultadoConsulta = DBPDO::ejecutarConsulta($sentenciaSQL, [$descDepartamento]); // almacenamos en la variable $resultadoConsulta los departamentos obtenidos en la consulta
        
        $nDepartamentos = $resultadoConsulta->rowCount();
        if ($nDepartamentos > 0) { // si la consulta devuelve algun departamento    
            /*        
            $departamento = $resultadoConsulta->fetchObject(); // obtenemos el primer departmento de la consulta, lo almacenamos en la variable $departamento y avanzamos el puntero al siguiente departamento
            $numDepartamento = 0; // declaramos e inicializamos el numero del departamento del array equivalente a la posicion del array

            while ($departamento) { // mientras haya algun departamento
                // Instanciamos un objeto Departamento con los datos devueltos por la consulta
                $oDepartamento = new Departamento($departamento->T02_CodDepartamento, $departamento->T02_DescDepartamento, $departamento->T02_FechaCreacionDepartamento, $departamento->T02_VolumenNegocio, $departamento->T02_FechaBajaDepartamento);
                $aDepartamentos[$numDepartamento] = $oDepartamento; // añadimos el objeto departamento en la posicion del array correspondiente
                $numDepartamento++; // incrementamos el numero del departamento equivalente a la posicion el array
                $departamento = $resultadoConsulta->fetchObject(); // almacenamos el siguiente departamento devuelto por la consulta y avanzamos el puntero al siguiente departamento
            }
            */
            for($pDepartamento = 0; $pDepartamento < $nDepartamentos; ++$pDepartamento) { //recorremos los departamentos devueltos por la consuelta
                $departamento = $resultadoConsulta->fetchObject(); //obtenemos el primer registro que nos proporciona la consulta
                $oDepartamento = new Departamento($departamento->T02_CodDepartamento, $departamento->T02_DescDepartamento, $departamento->T02_FechaCreacionDepartamento, $departamento->T02_VolumenNegocio, $departamento->T02_FechaBajaDepartamento);//creamos objeto dpt
                $aDepartamentos[] = $oDepartamento; //almacenamos el objeto en un array para devolverlo en el return
                     
            }
        }


        $sentenciaSQLNumDepartamentos = "Select count(*) FROM T02_Departamento WHERE T02_DescDepartamento LIKE '%' ? '%' " . (($filtroConsulta != null) ? $filtroConsulta : NULL);
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

        $sentenciaSQL = "Update T02_Departamento set T02_DescDepartamento=?, T02_VolumenNegocio=? where T02_CodDepartamento=?";
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
     * Metodo importar()
     *
     * Metodo que importa departamentos guardados en un ficher que es pasado como parametro
     * 
     * @param  string $archivo archivo que queremos importar
     * @param  string $formato formato del archivo
     * @return boolean true si se ha importado con exito, false en caso contrario
     */
    public static function importar($archivo, $formato)
    {
        $importacion = true; // inicializamos a true la variable
        $fechaActual = date('Ymd'); // variable que almacena formateada la fecha actual
        $sentenciaSQL = "Insert into T02_Departamento values (?, ?, ?, ?, ?)";

        switch ($formato) {
            case 'text/xml':
                move_uploaded_file($archivo, './tmp/' . $fechaActual . 'importacion.xml'); // guarda en el directorio el fichero subido 
                $documentoXML = new DOMDocument("1.0", "utf-8"); // creo el objeto de tipo DOMDocument que recibe 2 parametros: la version y la codificacion del XML que queremos crear
                $documentoXML->load('./tmp/' . $fechaActual . 'importacion.xml');

                $nDepartamentos = $documentoXML->getElementsByTagName('Departamento')->length; // obtiene cuantos departamentos hay en el fichero
                if ($nDepartamentos != 0) { // si hay algun fichero
                    for ($nDepartamento = 0; $nDepartamento < $nDepartamentos && $importacion; $nDepartamento++) { // recorro los departamentos
                        // por cada departamento del documento obtengo los diferentes campos y almacenamos en cada variable el valor del campo del departamento que indica $nDepartamento
                        $codDepartamento = $documentoXML->getElementsByTagName("CodDepartamento")->item($nDepartamento)->nodeValue;
                        $descDepartamento = $documentoXML->getElementsByTagName("DescDepartamento")->item($nDepartamento)->nodeValue;
                        $fechaCreacionDepartamento = $documentoXML->getElementsByTagName("FechaCreacionDepartamento")->item($nDepartamento)->nodeValue;
                        $volumenNegocio = $documentoXML->getElementsByTagName("VolumenNegocio")->item($nDepartamento)->nodeValue;
                        $fechaBajaDepartamento = $documentoXML->getElementsByTagName("FechaBajaDepartamento")->item($nDepartamento)->nodeValue;


                        if (!self::validarCodNoExiste($codDepartamento)) { // si existe el departamento
                            self::bajaFisicaDepartamento($codDepartamento); // elimina el departamento
                        }

                        if (empty($fechaBajaDepartamento)) { // si la fecha de baja esta vacia
                            $fechaBajaDepartamento = null; // establece el parametro fecha de baja a null
                        }


                        $parametros = [$codDepartamento, $descDepartamento, $fechaCreacionDepartamento, $volumenNegocio, $fechaBajaDepartamento];

                        if (!DBPDO::ejecutarConsulta($sentenciaSQL, $parametros)) { //Ejecutamos la consulta con los parámetros
                            $importacion = false;
                            exit;
                        }
                    }
                } else {
                    $importacion = false;
                }
                break;

            case 'application/json':
                move_uploaded_file($archivo, './tmp/' . $fechaActual . 'importacion.json'); // guarda en el directorio el fichero subido 

                $archivoJSON = file_get_contents("./tmp/" . $fechaActual . "importacion.json"); // coge el contenido del archivo json
                $aJSON = json_decode($archivoJSON); // decodifica el fichero json
                if ($aJSON) {
                    for ($nDepartamento = 0; $nDepartamento < count($aJSON) && $importacion; $nDepartamento++) { // recorro los departamentos del fichero

                        $parametros = [ // alamcenamos los datos del departamento actual
                            $aJSON[$nDepartamento]->CodDepartamento,
                            $aJSON[$nDepartamento]->DescDepartamento,
                            $aJSON[$nDepartamento]->FechaCreacionDepartamento,
                            $aJSON[$nDepartamento]->VolumenNegocio,
                            $aJSON[$nDepartamento]->FechaBajaDepartamento
                        ];

                        if (!self::validarCodNoExiste($parametros[0])) { // si existe el departamento
                            self::bajaFisicaDepartamento($parametros[0]); // elimina el departamento
                        }

                        if (!DBPDO::ejecutarConsulta($sentenciaSQL, $parametros)) { //Ejecutamos la consulta con los parámetros
                            $importacion = false;
                        }
                    }
                } else {
                    $importacion = false;
                }
                break;

            case 'application/vnd.ms-excel':
                move_uploaded_file($archivo, './tmp/' . $fechaActual . 'importacion.csv'); // guarda en el directorio el fichero subido 

                if (($puntero = fopen("./tmp/" . $fechaActual . "importacion.csv", "r"))) { // abre el puntero en modo lectura
                    while (($departamento = fgetcsv($puntero))) { // va recorriendo las lineas del fichero csv
                        $parametros = [
                            $departamento[0], // T02_CodDepartamento
                            $departamento[1], // T02_DescDepartamento
                            $departamento[2], // T02_FechaCreacionDepartamento
                            $departamento[3], // T02_VolumenNegocio
                            $departamento[4]  // T02_FechaBajaDepartamento
                        ];

                        if (!self::validarCodNoExiste($parametros[0])) { // si el departamento existe
                            self::bajaFisicaDepartamento($parametros[0]); // borramos el departamento
                        }

                        if (empty($parametros[4])) { // si la fecha de baja esta vacia
                            $parametros[4] = null; // establece el parametro fecha de baja a null
                        }

                        if (!DBPDO::ejecutarConsulta($sentenciaSQL, $parametros)) { //Ejecutamos la consulta con los parámetros
                            $importacion = false;
                        }
                    }
                    return fclose($puntero); // cierra el puntero
                } else {
                    $importacion = false;
                }
                break;
        }

        return $importacion;
    }


    /**
     * Metodo exportar()
     * 
     * Metodo que exporta todos los departamentos de la base de datos
     *
     * @param  string $formato formato del archivo para exportar
     * @return void
     */
    public static function exportar($formato)
    {
        $fechaActual = date('Ymd'); // variable que almacena formateada la fecha actual

        $sentenciaSQL = "Select * from T02_Departamento";
        $resultadoConsulta = DBPDO::ejecutarConsulta($sentenciaSQL, []); // almacenamos en la variable $resultadoConsulta el resultado obtenido al ejecutar la consulta
        if ($resultadoConsulta != null) { // si se ha ejecutado la consulta
            switch ($formato) {
                case 'xml':

                    $documentoXML = new DOMDocument("1.0", "utf-8"); // creo el objeto de tipo DOMDocument que recibe 2 parametros: ela version y la codificacion del XML que queremos crear
                    $documentoXML->formatOutput = true; // establece la salida formateada
                    $root = $documentoXML->appendChild($documentoXML->createElement('Departamentos')); // creo el nodo raiz
                    $oDepartamento = $resultadoConsulta->fetchObject(); // Obtengo el primer registro de la consulta como un objeto
                    while ($oDepartamento) { // recorro los registros que devuelve la consulta y por cada uno de ellos ejecuto el codigo siguiente
                        $departamento = $root->appendChild($documentoXML->createElement('Departamento')); // creo el nodo para el departamento 
                        $departamento->appendChild($documentoXML->createElement('CodDepartamento', $oDepartamento->T02_CodDepartamento)); // añado como hijo el codigo de departamento con su valor
                        $departamento->appendChild($documentoXML->createElement('DescDepartamento', $oDepartamento->T02_DescDepartamento)); // añado como hijo la descripcion del departamento con su valor
                        $departamento->appendChild($documentoXML->createElement('FechaCreacionDepartamento', $oDepartamento->T02_FechaCreacionDepartamento)); // añado como hijo la fecha de creacion del departamento con su valor
                        $departamento->appendChild($documentoXML->createElement('VolumenNegocio', $oDepartamento->T02_VolumenNegocio)); // añado como hijo el volumen de negocio del departamento con su valor
                        $departamento->appendChild($documentoXML->createElement('FechaBajaDepartamento', $oDepartamento->T02_FechaBajaDepartamento)); // añado como hijo la fecha de baja del departamento con su valor
                        $oDepartamento = $resultadoConsulta->fetchObject(); // guardo el registro actual como un objeto y avanzo el puntero al siguiente registro de la consulta
                    }

                    $documentoXML->save('./tmp/' . $fechaActual . "exportacion.xml"); // si se guarda el arbol XML en la ruta especificada con la fecha del dia que se ejecuta

                    header('Content-Type: text/xml'); // indicamos que la salida será de tipo xml
                    header("Content-Disposition: attachment; filename=" . $fechaActual . "exportacion.xml"); // indicaremos que el archivo se va a descargar con el atributo attachment y que el nombre del fichero sera el valor de filename
                    readfile("./tmp/" . $fechaActual . "exportacion.xml"); // mostrar el fichero del servidor en el navegador del documento xml si este no se descarga
                    exit;

                    break;

                case 'json':
                    $aJSON = []; // inicializamos el array donde vamos a guardar los datos de los departamentos

                    $oDepartamento = $resultadoConsulta->fetchObject(); // guardo el registro actual como un objeto y avanzo el puntero al siguiente registro de la consulta
                    $nDep = 0; // inicializamos cero el numero de departamento
                    while ($oDepartamento) { // recorro los registros que devuelve la consulta de la consulta 
                        $aDepartamento[$nDep]['CodDepartamento'] = $oDepartamento->T02_CodDepartamento; // obtengo el valor del codigo del departamento del registro actual 
                        $aDepartamento[$nDep]['DescDepartamento'] = $oDepartamento->T02_DescDepartamento; // obtengo el valor de la descripcion del departamento del registro actual 
                        $aDepartamento[$nDep]['FechaCreacionDepartamento'] = $oDepartamento->T02_FechaCreacionDepartamento; // obtengo el valor de la fecha de creacion del departamento del registro actual 
                        $aDepartamento[$nDep]['FechaBajaDepartamento'] = $oDepartamento->T02_FechaBajaDepartamento; // obtengo el valor de la fecha de baja del departamento del registro actual 
                        $aDepartamento[$nDep]['VolumenNegocio'] = $oDepartamento->T02_VolumenNegocio; // obtengo el valor de la fecha de baja del departamento del registro actual 

                        array_push($aJSON, $aDepartamento); // añadimos al el array los datos del departamento

                        $nDep++; // sumamos 1 al contador

                        $oDepartamento = $resultadoConsulta->fetchObject(); // guardo el registro actual como un objeto y avanzo el puntero al siguiente registro de la consulta
                    }

                    $json = json_encode($aDepartamento, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); // codifica el array dado en formato json utilizando espacios en blanco para formatear los datos y codifica caracteres Unicode multibyte literalmente

                    $puntero = fopen("./tmp/" . $fechaActual . "exportacion.json", "w"); // abre el fichero con permisos de escritura

                    fwrite($puntero, $json);

                    header('Content-Type: text/json'); // indicamos que la salida será de tipo json
                    header("Content-Disposition: attachment; filename=" . $fechaActual . "exportacion.json"); // indicaremos que el archivo se va a descargar con el atributo attachment y que el nombre del fichero sera el valor de filename
                    readfile("./tmp/" . $fechaActual . "exportacion.json"); // mostrar el fichero del servidor en el navegador del documento json si este no se descarga
                    exit;

                    break;

                case 'csv':

                    $puntero = fopen('./tmp/' . $fechaActual . 'exportacion.csv', 'w'); // crea/abre el fichero en modo escritura

                    $oDepartamento = $resultadoConsulta->fetchObject(); // Obtengo el primer registro de la consulta como un objeto

                    $nDep = 0; // inicializo la variable que contara las posiciones en las que se guarda cada departamento en el array
                    while ($oDepartamento) { // recorro los registros que devuelve la consulta de la consulta 
                        $aDepartamento[$nDep]['CodDepartamento'] = $oDepartamento->T02_CodDepartamento; // obtengo el valor del codigo del departamento del registro actual 
                        $aDepartamento[$nDep]['DescDepartamento'] = $oDepartamento->T02_DescDepartamento; // obtengo el valor de la descripcion del departamento del registro actual 
                        $aDepartamento[$nDep]['FechaCreacionDepartamento'] = $oDepartamento->T02_FechaCreacionDepartamento; // obtengo el valor de la fecha de creacion del departamento del registro actual 
                        $aDepartamento[$nDep]['VolumenNegocio'] = $oDepartamento->T02_VolumenNegocio; // obtengo el valor de la fecha de baja del departamento del registro actual 
                        $aDepartamento[$nDep]['FechaBajaDepartamento'] = $oDepartamento->T02_FechaBajaDepartamento; // obtengo el valor del volumen del departamento del registro actual 

                        fputcsv($puntero, $aDepartamento[$nDep]); // formatea una linea con los datos pasados en el array y lo escribe en el fichero

                        $nDep++; // sumamos 1 al contador

                        $oDepartamento = $resultadoConsulta->fetchObject(); // guardo el registro actual como un objeto y avanzo el puntero al siguiente registro de la consulta
                    }

                    fclose($puntero); // cierra el puntero

                    header('Content-Type: text/csv'); // indicamos que la salida será de tipo csv
                    header("Content-Disposition: attachment; filename=" . $fechaActual . "exportacion.csv"); // indicaremos que el archivo se va a descargar con el atributo attachment y que el nombre del fichero sera el valor de filename
                    readfile("./tmp/" . $fechaActual . "exportacion.csv"); // mostrar el fichero del servidor en el navegador del documento csv si este no se descarga
                    exit;

                    break;
            }
        }
    }
}
