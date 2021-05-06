
    <div id="consultarEditarDepartamento">
        <form name="formulario" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="form">
            <h3>Añadir Departamento</h3>
            <br>
            <div>
                <label for="CodDepartamento">Código de departamento</label><br>
                <input class="codigoDep" type="text" id="CodDepartamento" name="CodDepartamento" value="<?php echo isset($_REQUEST['CodDepartamento']) ? $_REQUEST['CodDepartamento'] : null; ?>">
                <?php echo isset($aErrores['CodDepartamento']) ? '<p style="color: red;">'. $aErrores['CodDepartamento'].'</p>' : null; ?>
                <br><br>

                <label for="DescDepartamento" >Descripción de departamento</label><br>
                <input class="campos" type="text" id="DescDepartamento" name="DescDepartamento" value="<?php echo isset($_REQUEST['DescDepartamento']) ? $_REQUEST['DescDepartamento'] : null; ?>">
                <?php echo isset($aErrores['DescDepartamento']) ? '<p style="color: red;">'. $aErrores['DescDepartamento'].'</p>' : null; ?>
                <br><br>

                <label for="VolumenNegocio">Volumen de negocio</label><br>
                <input class="vNegocio" type="text" id="VolumenNegocio" name="VolumenNegocio" value="<?php echo isset($_REQUEST['VolumenNegocio']) ? $_REQUEST['VolumenNegocio'] : null; ?>">
                <?php echo isset($aErrores['VolumenNegocio']) ? '<p style="color: red;">'. $aErrores['VolumenNegocio'].'</p>' : null; ?>
                <br><br>
            </div>
            <div>
                <input class="enviar" type="submit" value="Aceptar" name="Aceptar">
                <br>
                <input class="enviar" type="submit" value="Cancelar" name="Cancelar">
            </div>
        </form>
    </div>
