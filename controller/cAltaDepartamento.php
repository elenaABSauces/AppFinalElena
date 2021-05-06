<?php 
    $_SESSION['paginaAnterior'] = $controladores['añadir'];

    if(isset($_REQUEST['Cancelar'])){
        $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos'];
        header('Location: index.php');//Redirigimos al usuario a la ventana de editar departamento
        exit;
    }

    define("OBLIGATORIO", 1);
    $entradaOK = true;

    //Declaramos el array de errores y lo inicializamos a null
    $aErrores = ['CodDepartamento' => null,
                 'DescDepartamento' => null,
                 'VolumenNegocio' => null];

    //Declaramos el array del formulario y lo inicializamos a null
    $aFormulario = ['CodDepartamento' => null,
                 'DescDepartamento' => null,
                    'VolumenNegocio' => null];

    if(isset($_REQUEST['Aceptar'])){
        $aErrores['CodDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['CodDepartamento'], 3, 3, OBLIGATORIO);//Comprobamos que el código de departamento sea alfanumérico
        $aErrores['DescDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['DescDepartamento'], 255, 1, OBLIGATORIO);//Comprobamos que la descripción del departamento sea alfanumérico
        $aErrores['VolumenNegocio'] = validacionFormularios::comprobarFloat($_REQUEST['VolumenNegocio'], PHP_FLOAT_MAX, PHP_FLOAT_MIN, OBLIGATORIO);//Comprobamos que el volumen de negocio sea float
        
        if($aErrores['CodDepartamento']==null){
            if(!ctype_upper($_REQUEST['CodDepartamento'])){
                $aErrores['CodDepartamento'] = "El codigo de departamento debe introducirse en letras mayusculas";
            }else{
                if(!DepartamentoPDO::validarCodNoExiste($_REQUEST['CodDepartamento'])){
                    $aErrores['CodDepartamento'] = "El codigo de departamento introducido ya se encuentra registrado";
                }
            }
        }
        // Recorremos el array de errores
        foreach ($aErrores as $campo => $error){
            if ($error != null) { // Comprobamos que el campo no esté vacio
                $entradaOK = false; // En caso de que haya algún error le asignamos a entradaOK el valor false para que vuelva a rellenar el formulario      
                $_REQUEST[$campo] = "";
            }
        }
    }else{
        $entradaOK = false;
    }

    if($entradaOK){
        DepartamentoPDO::altaDepartamento($_REQUEST['CodDepartamento'], $_REQUEST['DescDepartamento'], $_REQUEST['VolumenNegocio']); // damos de alta el departamento
        
        $_SESSION['paginaEnCurso'] = $controladores['mtoDepartamentos'];
        header('Location: index.php');//Redirigimos al usuario a la ventana de editar departamento
        exit;
    }

    $vistaEnCurso = $vistas['añadir']; // guardamos en la variable vistaEnCurso la vista que queremos implementar

    require_once $vistas['layout'];
?>