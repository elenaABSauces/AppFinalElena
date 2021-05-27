<main id="main-bajaLogicaDepartamento">
    <article class="form-container">
        <header>
            <h2>Baja Logica Departamento</h2>
        </header>
        <form id="form-bajaLogicaDepartamento" name="form-bajaLogicaDepartamento" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <div class="input-field-container">
            <p>Codigo de Departamento</p>
                <input type="text" id="CodDepartamento" name="CodDepartamento" value="<?php echo $oDepartamento->codDepartamento; ?>" readonly>
                
            </div>
            <div class="input-field-container">
                <p>Descripcion del Departamento</p>
                <input type="text" id="DescDepartamento" name="DescDepartamento" value="<?php echo $oDepartamento->descDepartamento; ?>" readonly>
                
            </div>
            <div class="input-field-container">
                <p>Fecha Creacion</p>
                <input type="date" id="FechaCreacion" name="FechaCreacion" value="<?php echo date('Y-m-d',$oDepartamento->fechaCreacionDepartamento); ?>" readonly>
                
            </div>
            <div class="input-field-container">
                <p>Fecha Baja</p>
                <input type="date" id="FechaBaja" name="FechaBaja" value="<?php echo date('Y-m-d',time());?>" required>
                
            </div>
            <?php
                echo(!is_null($errorFechaBaja)) ? "<span class='error'>".$errorFechaBaja."</span>" : null;     
            ?>
            <div class="input-field-container">
                <p>Volumen Negocio</p>
                <input type="text" id="VolumenNegocio" name="VolumenNegocio" value="<?php echo $oDepartamento->volumenDeNegocio; ?>" readonly>
                
            </div>
            <div>
                <button class="form-button" type="submit" name="Aceptar">Aceptar</button>
            </div>

        </form>

        <form  id="form-buttons" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="form-buttons-bajaLogica" method="post">
            <button class="form-button" type="submit" name="Cancelar">Cancelar</button>
        </form>
    </article>
</main>