<?php

require_once "core/libreriaValidacion.php";

require_once "model/Usuario.php";
require_once "model/UsuarioPDO.php";
require_once "model/DBPDO.php";
require_once "model/REST.php";
require_once "model/Departamento.php";
require_once "model/DepartamentoPDO.php";

$controladores = [
    "login" => "controller/cLogin.php",
    "principal" => "controller/cPrincipal.php",
    "inicio" => "controller/cInicio.php",
    "registro" => "controller/cRegistro.php",
    "detalle" => "controller/cDetalle.php",
    "editar" => "controller/cEditar.php",
    "cambiarPassword" => "controller/cCambiarPassword.php",
    "borrarCuenta" => "controller/cBorrarCuenta.php",
    "rest" => "controller/cREST.php",
    "wip" => "controller/cWIP.php",
    "error" => "controller/cError.php",
    "mtoDepartamentos" => "controller/cMtoDepartamentos.php",
    "altaDepartamento" => "controller/cAltaDepartamento.php",
    "bajaLogicaDepartamento" => "controller/cBajaLogicaDepartamento.php",
    "rehabilitacionDepartamento" => "controller/cRehabilitacionDepartamento.php",
    "consultarModificarDepartamento" => "controller/cConsultarModificarDepartamento.php",
    "importarDepartamentos" => "controller/cImportarDepartamentos.php",
    "exportarDepartamentos" => "controller/cExportarDepartamentos.php",
    "eliminarDepartamento" => "controller/cEliminarDepartamento.php",
    "tecnologias" => "controller/cTecnologias.php"
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
    "error" => "view/vError.php",
    "mtoDepartamentos" => "view/vMtoDepartamentos.php",
    "altaDepartamento" => "view/vAltaDepartamento.php",
    "bajaLogicaDepartamento" => "view/vBajaLogicaDepartamento.php",
    "rehabilitacionDepartamento" => "view/vRehabilitacionDepartamento.php",
    "consultarModificarDepartamento" => "view/vConsultarModificarDepartamento.php",
    "importarDepartamentos" => "view/vImportarDepartamentos.php",
    "exportarDepartamentos" => "view/vExportarDepartamentos.php",
    "eliminarDepartamento" => "view/vEliminarDepartamento.php",
    "tecnologias" => "view/vTecnologias.php"
];
?>