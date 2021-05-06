<?php
$_SESSION['paginaAnterior'] = $controladores['mtoDepartamentos'];
$_SESSION['CriterioBusqueda'] = "Todos";

if(!isset($_SESSION['BusquedaDepartamento'])){//Si el usuario no ha realizado ninguna busqueda de ningun departamento
    $_SESSION['BusquedaDepartamento']="";//Por defecto establecemos la variable de sesión vacía para que aparezcan todos los departamentos almacenados
}

if(isset($_REQUEST['volver'])){
    $_SESSION['paginaEnCurso'] = $controladores['inicio']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}


if(isset($_REQUEST['añadir'])){//Si el usuario pulsa el botón de editar
    $_SESSION['paginaEnCurso'] = $controladores['añadir'];
    header('Location: index.php');//Redirigimos al usuario a la ventana de editar departamento
    exit;
}

if(isset($_REQUEST['importar'])){//Si el usuario pulsa el botón de editar
    $_SESSION['paginaEnCurso'] = $controladores['importar'];
    header('Location: index.php');//Redirigimos al usuario a la ventana de editar departamento
    exit;
}

if(isset($_REQUEST['exportar'])){//Si el usuario pulsa el botón de editar
    $_SESSION['paginaEnCurso'] = $controladores['exportar'];
    header('Location: index.php');//Redirigimos al usuario a la ventana de editar departamento
    exit;
}

if(!isset($_SESSION['PaginaActual'])){//Si no está establecida la pagina actual en la sesion
    $_SESSION['PaginaActual']=1;//Establecemos la página actual a 1
}

if (isset($_REQUEST['avanzarPagina'])) {//Si pulsa el botón de avanzar pagina
    $_SESSION['PaginaActual'] = $_REQUEST['avanzarPagina'];//el numero de la pagina es igual al valor de avanzarPagina
} else if(isset($_REQUEST['retrocederPagina'])){//Si pulsa el botón de retroceder pagina
    $_SESSION['PaginaActual'] = $_REQUEST['retrocederPagina'];//el numero de la pagina es igual al valor de retrocederPagina
}else if(isset($_REQUEST['paginaInicial'])){//Si pulsa el botón de pagina inicial
    $_SESSION['PaginaActual'] = $_REQUEST['paginaInicial'];//el numero de la pagina es igual al valor de paginaInicial
}else if(isset($_REQUEST['paginaFinal'])){//Si pulsa el botón de pagina final
    $_SESSION['PaginaActual'] = $_REQUEST['paginaFinal'];//el numero de la pagina es igual al valor de paginaFinal
}

if(isset($_REQUEST['editar'])){//Si el usuario pulsa el botón de editar
    $_SESSION['CodDepartamento'] = $_REQUEST['editar'];//Almacenamos el valor del botón, el cual contiene el valor del departamento que queremos editar, en la variable de sesion
    $_SESSION['paginaEnCurso'] = $controladores['consultarModificar'];
    header('Location: index.php');//Redirigimos al usuario a la ventana de editar departamento
    exit;
}

if(isset($_REQUEST['borrar'])){//Si el usuario pulsa el boton de borrar
    $_SESSION['CodDepartamento']=$_REQUEST['borrar'];//Almacenamos el valor del botón, el cual contiene el valor del departamento que queremos editar, en la variable de sesion
    $_SESSION['paginaEnCurso'] = $controladores['borrar'];
    header('Location: index.php');//Redirigimos al usuario a la ventana de baja departamento
    exit;
}

if(isset($_REQUEST['bajaLogica'])){//Si el usuario pulsa el boton de baja logica
    $_SESSION['CodDepartamento']=$_REQUEST['bajaLogica'];//Almacenamos el valor del botón, el cual contiene el valor del departamento que queremos editar, en la variable de sesion
    $_SESSION['paginaEnCurso'] = $controladores['bajaLogica'];
    header('Location: index.php');//Redirigimos al usuario a la ventana de baja logica de departamento
    exit;
}

if(isset($_REQUEST['rehabilitar'])){//Si el usuario pulsa el boton de rehabilitar
    $_SESSION['CodDepartamento']=$_REQUEST['rehabilitar'];//Almacenamos el valor del botón, el cual contiene el valor del departamento que queremos editar, en la variable de sesion
    $_SESSION['paginaEnCurso'] = $controladores['rehabilitar'];
    header('Location: index.php');//Redirigimos al usuario a la ventana de rehabilitar departamento
    exit;
}

define("OPCIONAL", 0);
$aErrores = ['Departamento' => null,
             'CriterioBusqueda' => null];
$entradaOK = true;

if(isset($_REQUEST['Buscar'])){
    $aErrores['Departamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['Departamento'], 255, 1, OPCIONAL);//Comprobamos que la descripción sea alfanumerico
    $aErrores['CriterioBusqueda'] = validacionFormularios::validarElementoEnLista($_REQUEST['CriterioBusqueda'],['Todos','Baja','Alta']);

    foreach ($aErrores as $campo => $error) { // recorro el array de errores
        if ($error != null) { // compruebo si hay algun mensaje de error en algun campo
            $entradaOK = false; // le doy el valor false a $entradaOK
            $_REQUEST[$campo] = ""; // si hay algun campo que tenga mensaje de error pongo $_REQUEST a null
        }
    }

}else{
    $entradaOK = false;
}

if($entradaOK){
    $_SESSION['BusquedaDepartamento'] = $_REQUEST['Departamento'];
    $_SESSION['CriterioBusqueda'] = $_REQUEST['CriterioBusqueda'];
    $_SESSION['PaginaActual'] = 1;
}

$aResultadoBusqueda = DepartamentoPDO::buscarDepartamentosPorDescripcion($_SESSION['BusquedaDepartamento'],$_SESSION['CriterioBusqueda'],  $_SESSION['PaginaActual'], 5);
$aDepartamentos = $aResultadoBusqueda[0];
$paginasTotales = $aResultadoBusqueda[1];
$paginaActual = $_SESSION['PaginaActual'];
$criterioBusqueda = $_SESSION['CriterioBusqueda'];

$busquedaDepartamento = $_SESSION['BusquedaDepartamento'];

$vistaEnCurso = $vistas['mtoDepartamentos']; // guardamos en la variable vistaEnCurso la vista que queremos implementar

require_once $vistas['layout'];
?>