<?php
require_once "core/libreriaValidacion.php";

require_once "model/Usuario.php";
require_once "model/UsuarioDB.php";
require_once "model/UsuarioPDO.php";
require_once "model/Departamento.php";
require_once "model/DepartamentoPDO.php";
require_once "model/REST.php";
require_once "model/DBPDO.php";

$controladores = [
    "wip" => "controller/cWIP.php",
    "principal" => "controller/cPrincipal.php",
    "login" => "controller/cLogin.php",
    "inicio" => "controller/cInicio.php",
    "registro" => "controller/cRegistro.php",
    "rest" => "controller/cREST.php",
    "miCuenta" => "controller/cMiCuenta.php",
    "borrarCuenta" => "controller/cBorrarCuenta.php",
    "cambiarPassword" => "controller/cCambiarPassword.php",
    "mtoDepartamentos" => "controller/cMtoDepartamentos.php",
    "mtoUsuarios" => "controller/cMtoUsuarios.php",
    "tecnologias" => "controller/cTecnologias.php",
    "consultarModificar" => "controller/cConsultarModificarDepartamento.php",
    "borrar" => "controller/cEliminarDepartamento.php",
    "bajaLogica" => "controller/cBajaLogicaDepartamento.php",
    "rehabilitar" => "controller/cRehabilitacionDepartamento.php",
    "añadir" => "controller/cAltaDepartamento.php",
    "importar" => "controller/cImportarDepartamentos.php",
    "exportar" => "controller/cExportarDepartamentos.php"
];

$vistas = [
    "wip" => "view/vWIP.php",
    "layout" => "view/layout.php",
    "principal" => "view/vPrincipal.php",
    "login" => "view/vLogin.php",
    "inicio" => "view/vInicio.php",
    "registro" => "view/vRegistro.php",
    "rest" => "view/vREST.php",
    "miCuenta" => "view/vMiCuenta.php",
    "borrarCuenta" => "view/vBorrarCuenta.php",
    "cambiarPassword" => "view/vCambiarPassword.php",
    "mtoDepartamentos" => "view/vMtoDepartamentos.php",
    "mtoUsuarios" => "view/vMtoUsuarios.php",
    "tecnologias" => "view/vTecnologias.php",
    "consultarModificar" => "view/vConsultarModificarDepartamento.php",
    "borrar" => "view/vEliminarDepartamento.php",
    "bajaLogica" => "view/vBajaLogicaDepartamento.php",
    "rehabilitar" => "view/vRehabilitacionDepartamento.php",
    "añadir" => "view/vAltaDepartamento.php",
    "importar" => "view/vImportarDepartamentos.php",
    "exportar" => "view/vExportarDepartamentos.php"
];
?>