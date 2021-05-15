<?php

require_once "core/libreriaValidacion.php";

require_once "model/Usuario.php";
require_once "model/UsuarioPDO.php";
require_once "model/DBPDO.php";
require_once "model/REST.php";

$controladores = [
    "login" => "controller/cLogin.php",
    "principal" => "controller/cPrincipal.php",
    "inicio" => "controller/cInicio.php",
    "registro" => "controller/cRegistro.php",
    "detalle" => "controller/cDetalle.php",
    "editar" => "controller/cEditar.php",
    "editar" => "controller/cEditar.php",
    "cambiarPassword" => "controller/cCambiarPassword.php",
    "borrarCuenta" => "controller/cBorrarCuenta.php",
    "rest" => "controller/cREST.php",
    "wip" => "controller/cWIP.php",
    "mtoDepartamentos" => "controller/cMtoDepartamentos.php"
];

$vistas = [
    "layout" => "view/layout.php",
    "principal" => "view/vPrincipal.php",
    "login" => "view/vLogin.php",
    "inicio" => "view/vInicio.php",
    "registro" => "view/vRegistro.php",
    "detalle" => "view/vDetalle.php",
    "editar" => "view/vEditar.php",
    "cambiarPassword" => "view/vCambiarPassword.php",
    "borrarCuenta" => "view/vBorrarCuenta.php",
    "rest" => "view/vREST.php",
    "wip" => "view/vWIP.php",
    "mtoDepartamentos" => "controller/cMtoDepartamentos.php"
];
?>