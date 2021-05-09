<main class="mainRegistro">
    <div id="registro">
        <form name="formulario" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="formularioAlta formRegistroPrincipal" onsubmit="return validarFormulario()">
            <h3>Registrate</h3>
            <br>
            <div>
                <label for="CodUsuario">Usuario</label><br>
                <input class="campos" type="text" id="CodUsuario" name="CodUsuario" value="<?php
                echo (isset($_REQUEST['CodUsuario'])) ? $_REQUEST['CodUsuario'] : null; 
                ?>" onblur="validarCodUsuario()">
                
                <?php
                    echo ($aErrores['CodUsuario']!=null) ? "<span style='color:#FF0000'>".$aErrores['CodUsuario']."</span>" : null;// si el campo es erroneo se muestra un mensaje de error
                ?>
                <span style='color:#FF0000' id="errorCodUsuario"></span>
                <br><br>

                <label for="DescUsuario">Descripción del usuario</label><br>
                <input class="campos" type="text" id="DescUsuario" name="DescUsuario" value="<?php
                echo (isset($_REQUEST['DescUsuario'])) ? $_REQUEST['DescUsuario'] : null; 
                ?>"  onblur="validarDescUsuario()">
                
                <?php
                    echo ($aErrores['DescUsuario']!=null) ? "<span style='color:#FF0000'>".$aErrores['DescUsuario']."</span>" : null;// si el campo es erroneo se muestra un mensaje de error
                ?>
                <span style='color:#FF0000' id="errorDescUsuario"></span>
                <br><br>

                <label for="Password">Contraseña</label><br>
                <input class="campos" type="password" id="Password" name="Password" value="<?php
                echo (isset($_REQUEST['Password'])) ? $_REQUEST['Password'] : null; 
                ?>"  onblur="validarPassword('Password', 'errorPassword')">
                
                <?php
                    echo ($aErrores['Password'] != null) ? "<span style='color:#FF0000'>" . $aErrores['Password'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
                ?>
                <span style='color:#FF0000' id="errorPassword"></span>
                <br><br>

                <label for="PasswordConfirmacion">Repita Contraseña</label><br>
                <input class="campos" type="password" id="PasswordConfirmacion" name="PasswordConfirmacion" value="<?php
                echo (isset($_REQUEST['PasswordConfirmacion'])) ? $_REQUEST['PasswordConfirmacion'] : null; 
                ?>" onblur="validarPassword('PasswordConfirmacion', 'errorPasswordConfirmacion')">
                
                <?php
                    echo ($aErrores['PasswordConfirmacion'] != null) ? "<span style='color:#FF0000'>" . $aErrores['PasswordConfirmacion'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
                ?>
                <span style='color:#FF0000' id="errorPasswordConfirmacion"></span>
                <br><br>
            </div>
            <div>
                <input class="enviar" type="submit" value="Registrarse" name="Registrarse">
                
            </div>
        </form>
        <form action="" method="post">
            <input class="enviar" type="submit" value="Cancelar" name="Cancelar">
        </form>
    </div>
</main>