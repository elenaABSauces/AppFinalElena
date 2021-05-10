<main class="mainEliminarDepartamento">
    <div id="eliminarDepartamento">
        <form name="formulario" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="form">
            <h3>Eliminar Departamento</h3>
            <br>
            <h5><img src="webroot/media/images/atencion.png" width="15px">  Eliminarás este departamento de forma permanente</h5>

            <br>
            <div>
                <label for="CodDepartamento">Código de departamento</label><br>
                <input style="background-color: #f5f5f5;" class="codigoDep" type="text" id="CodDepartamento" name="CodDepartamento" readonly value="<?php echo $oDepartamento->codDepartamento; ?>">
                <br><br>

                <label for="DescDepartamento" >Descripción de departamento</label><br>
                <input style="background-color: #f5f5f5;" class="campos" type="text" id="DescDepartamento" name="DescDepartamento" readonly value="<?php echo $oDepartamento->descDepartamento; ?>">
                <br><br>

                <label for="FechaCreacion">Fecha de creación</label><br>
                <input style="background-color: #f5f5f5;" class="fechaDep" type="text" id="FechaCreacion" name="FechaCreacion" readonly value="<?php echo date('d/m/Y',$oDepartamento->fechaCreacionDepartamento); ?>">
                <br><br>

                <label for="FechaBaja">Fecha de baja</label><br>
                <input style="background-color: #f5f5f5;" class="fechaDep" type="text" id="FechaBaja" name="FechaBaja" readonly value="<?php echo isset($oDepartamento->fechaBajaDepartamento) ? date('d/m/Y',$oDepartamento->fechaBajaDepartamento) : "null"; ?>">
                <br><br>

                <label for="VolumenNegocio">Volumen de negocio</label><br>
                <input style="background-color: #f5f5f5;" class="vNegocio" type="text" id="VolumenNegocio" name="VolumenNegocio" readonly value="<?php echo $oDepartamento->volumenDeNegocio; ?>">
                <br><br>
            </div>
            <div>
                <input class="eliminar" type="submit" value="Aceptar" name="Aceptar">
                <br>
                <input class="enviar" type="submit" value="Cancelar" name="Cancelar">
            </div>
        </form>
    </div>
</main>