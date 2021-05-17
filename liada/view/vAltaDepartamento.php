<main id="main-altaDepartamento">
    <article class="form-container">
        <header>
            <h2>Alta Departamento</h2>
        </header>
        <form id="form-altaDepartamento" name="form-altaDepartamento" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <div class="input-field-container">
                <p for="CodDepartamento">Codigo de Departamento</p>
                <input type="text" id="CodDepartamento" name="CodDepartamento" value="<?php
                    echo (isset($_REQUEST['CodDepartamento'])) ? $_REQUEST['CodDepartamento'] : null; // si el campo esta correcto mantengo su valor en el formulario
                    ?>" required>
            </div>
            <?php
                echo ($aErrores['CodDepartamento'] != null) ? "<span class='error'>" . $aErrores['CodDepartamento'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
            ?>
            <div class="input-field-container">
                <p>Descripcion del Departamento</p>
                <input type="text" id="DescDepartamento" name="DescDepartamento" value="<?php
                            echo (isset($_REQUEST['DescDepartamento'])) ? $_REQUEST['DescDepartamento'] : null; // si el campo esta correcto mantengo su valor en el formulario
                            ?>" required>
            </div>
            <?php
                echo ($aErrores['DescDepartamento'] != null) ? "<span class='error'>" . $aErrores['DescDepartamento'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
            ?>
            <div class="input-field-container">
                <p>Volumen Negocio</p>
                <input type="text" id="VolumenNegocio" name="VolumenNegocio" value="<?php
                            echo (isset($_REQUEST['VolumenNegocio'])) ? $_REQUEST['VolumenNegocio'] : null; // si el campo esta correcto mantengo su valor en el formulario
                            ?>" required>
            </div>
            <?php
                echo($aErrores['VolumenNegocio'] != null) ? "<span class='error'>" . $aErrores['VolumenNegocio'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
            ?>
            
            <div>
                <button class="form-button" type="submit" name="Aceptar">Aceptar</button>
            </div>

        </form>

        <form  id="form-buttons" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="form-buttons" method="post">
            <button class="form-button" type="submit" name="Cancelar">Cancelar</button>
        </form>
    </article>
</main>