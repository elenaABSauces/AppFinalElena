<?php
    $_SESSION['paginaAnterior'] = $controladores['bajaLogica'];

    $oDepartamento = DepartamentoPDO::obtenerDatosDepartamento($_SESSION['CodDepartamento']);

    if(isset($_REQUEST['Cancelar'])){
        $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos'];
        header('Location: index.php');//Redirigimos al usuario a la ventana de editar departamento
        exit;
    }

    define("OBLIGATORIO", 1);
    $entradaOK = true;

    $errorFecha = null; // creamos una variable inicializada a null para almacenar los posibles errores de entrada
    $fechaActual= new DateTime();//Almacenamos el valor de la fecha actual en fechaBaja

    if(isset($_REQUEST['Aceptar'])){
        $errorFecha = validacionFormularios::validarFecha($_REQUEST['FechaBaja'], '2500-01-01', $fechaActual->format('Y/m/d'), OBLIGATORIO);//Comprobamos que la fecha esta comprendida entre la fecha actual y la fecha máxima
        
        if($errorFecha!=null){//Si la fecha es incorrecta
            $entradaOK = false; // cambiamos el valor de la entradaOK a false
            $_REQUEST['FechaBaja'] = ""; // limpiamos el valor del campo del formulario
        }
    }else{ // si el usuario no ha enviado el formulario
        $entradaOK = false; // cambiamos el valor de la entradaOK a false
    }

    if($entradaOK){ // si la entrada es correcta

        if(DepartamentoPDO::bajaLogicaDepartamento($oDepartamento->codDepartamento, $_REQUEST['FechaBaja'])){ // damos de baja el departamento
            $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos']; // almacenamos en la variable de sesion paginaEnCurso
        }
        
        header('Location: index.php');//Redirigimos al usuario a la ventana de editar departamento
        exit;
    }

    $vistaEnCurso = $vistas['bajaLogica']; // guardamos en la variable vistaEnCurso la vista que queremos implementar

    require_once $vistas['layout']; // cargamos el layout
?>