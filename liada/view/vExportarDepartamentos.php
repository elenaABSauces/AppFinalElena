<main id="main-exportarDepartamentos">
    <article class="form-container">
        <header>
            <h2>Exportar Departamentos</h2>
            <p>Exportacion de toda la tabla de Departamentos</p>
        </header>
        
        <form id="form-exportarDepartamentos" name="form-exportarDepartamentos" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="select-field-container">
                <p"Formato">Formato: </p>
                <select name="Formato">
                    <option value="xml" <?php echo (isset($formato) && $formato == "xml") ? "selected" : null ?> > xml </option>
                    <option value="json" <?php echo (isset($formato) && $formato == "json") ? "selected" : null ?> > json </option>
                    <option value="csv" <?php echo (isset($formato) && $formato == "csv") ? "selected" : null ?> > csv </option>
                </select>
            </div>
            <?php
            echo (isset($errorFormato) && $errorFormato != null) ? "<span class='error'>" . $errorFormato . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
            ?>

            <div>
                <button class="form-button" type="submit" name="Aceptar">Aceptar</button>

            </div>

        </form>
        <form id="form-buttons" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="form-buttons-exportarDepartamentos" method="post">
            <button class="form-button" type="submit" name="Cancelar">Cancelar</button>
        </form>
    </article>
</main>