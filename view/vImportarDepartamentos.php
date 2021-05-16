<main id="main-importarDepartamentos">
    <article class="form-container">
        <header>
            <h2>Importar Departamentos</h2>
        </header>

        <form id="form-importarDepartamentos" name="form-importarDepartamentos" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

            <div class="input-field-container">
                <input type="file" id="ArchivoImportado" name="ArchivoImportado" required>
                <p>Importar Archivo</p>
            </div>
            <?php
            echo (isset($errorArchivoImportado) && $errorArchivoImportado != null) ? "<span class='error'>" . $errorArchivoImportado . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
            ?>

            <div class="select-field-container">
                <p>Formato: </p>
                <select name="Formato">
                    <option value="text/xml" <?php echo (isset($formato) && $formato == "xml") ? "selected" : null ?> > xml </option>
                    <option value="application/json" <?php echo (isset($formato) && $formato == "json") ? "selected" : null ?> > json </option>
                    <option value="application/vnd.ms-excel" <?php echo (isset($formato) && $formato == "csv") ? "selected" : null ?> > csv </option>
                </select>
            </div>
            <?php
            echo (isset($errorFormato) && $errorFormato != null) ? "<span class='error'>" . $errorFormato . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
            ?>

            <div>
                <button class="form-button" type="submit" name="Aceptar">Aceptar</button>

            </div>

        </form>
        <form id="form-buttons" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="form-buttons-importarDepartamentos" method="post">
            <button class="form-button" type="submit" name="Cancelar">Cancelar</button>
        </form>
    </article>
</main>