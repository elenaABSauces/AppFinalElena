<main class="mainCambiarPassword">
    <div id="cambiarPassword">
        <form name="formularioCambiarPassword" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form">
            <h3>Cambiar Password</h3>
            <br>
            <div>
                <label for="Password">Contrase�aa Actual</label><br>
                <input class="campos" type="password" id="Password" name="Password" value="<?php
                echo (isset($_REQUEST['Password'])) ? $_REQUEST['Password'] : null;
                ?>">

                <?php
                echo ($aErrores['Password'] != null) ? "<span style='color:#FF0000'>" . $aErrores['Password'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
                ?>
                <br><br>

                <label for="NuevaPassword">Nueva Contraseña</label><br>
                <input class="campos" type="password" id="NuevaPassword" name="NuevaPassword" value="<?php
                echo (isset($_REQUEST['NuevaPassword'])) ? $_REQUEST['NuevaPassword'] : null;
                ?>">

                <?php
                echo ($aErrores['NuevaPassword'] != null) ? "<span style='color:#FF0000'>" . $aErrores['NuevaPassword'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
                ?>
                <br><br>

                <label for="RepetirPassword">Repetir Contrase�a</label><br>
                <input class="campos" type="password" id="RepetirPassword" name="RepetirPassword" value="<?php
                echo (isset($_REQUEST['RepetirPassword'])) ? $_REQUEST['RepetirPassword'] : null;
                ?>">

                <?php
                echo ($aErrores['RepetirPassword'] != null) ? "<span style='color:#FF0000'>" . $aErrores['RepetirPassword'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
                ?>
                <br><br>
            </div>
            <div>
                <input class="enviar" type="submit" value="Aceptar" name="Aceptar">
                <br>
                <input class="enviar" type="submit" value="Cancelar" name="Cancelar">
            </div>
        </form>
    </div>
    <br><!-- comment -->
    <form  name="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <button type="submit" name='volver' value="volver" class="volver">VOLVER</button>
    </form>
</main>