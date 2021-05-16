
<main id="main-eliminarDepartamento">
<article class="form-container">
        <header>
            <h2>Eliminar Departamento</h2>
        </header>
        <form id="form-eliminarDepartamento" name="form-consultarModificarDepartamento" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <div class="input-field-container">
                <input type="text" id="CodDepartamento" name="CodDepartamento" value="<?php echo $oDepartamento->codDepartamento; ?>" readonly>
                <label for="CodDepartamento">Codigo de Departamento</label>
            </div>
            <div class="input-field-container">
                <input type="text" id="DescDepartamento" name="DescDepartamento" value="<?php echo $oDepartamento->descDepartamento; ?>" readonly>
                <label for="DescDepartamento">Descripcion del Departamento</label>
            </div>
            <div class="input-field-container">
                <input type="text" id="FechaCreacion" name="FechaCreacion" value="<?php echo date('d/m/Y',$oDepartamento->fechaCreacionDepartamento); ?>" readonly>
                <label for="fechaCreacion">Fecha Creacion</label>
            </div>
            <div class="input-field-container">
                <input type="text" id="FechaBaja" name="FechaBaja" value="<?php echo empty($oDepartamento->fechaBajaDepartamento)?"NULL":date('d/m/Y',$oDepartamento->fechaBajaDepartamento);?>" readonly>
                <label for="FechaBaja">Fecha Baja</label>
            </div>
            <div class="input-field-container">
                <input type="text" id="VolumenNegocio" name="VolumenNegocio" value="<?php echo $oDepartamento->volumenDeNegocio; ?>" readonly>
                <label for="VolumenNegocio">Volumen Negocio</label>
            </div>
            
            <div>
                <button class="form-button" type="submit" name="Aceptar">Aceptar</button>
            </div>

        </form>

        <form  id="form-buttons" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="registro" method="post">
            <button class="form-button" type="submit" name="Cancelar">Cancelar</button>
        </form>
    </article>
</main>