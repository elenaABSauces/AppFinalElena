<h2>Editar perfil</h2>

<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
    <fieldset>
        <label for="CodUsuario">C�digo del Usuario</label><br>
                <input class="desactivado" type="text" id="CodUsuario" name="CodUsuario" readonly value="<?php echo $codUsuario; ?>">
                <br>

                <label for="DescUsuario" >Descripci�n del usuario(*)</label><br>
                <input class="campos" type="text" id="DescUsuario" name="DescUsuario" value="<?php echo $descUsuario; ?>">
                <?php
                    echo $errorDescripcion!=null ? "<span style='color:#FF0000'>".$errorDescripcion."</span>" : null;
                ?>
                <br>

                <label for="NumConexiones">N�mero de conexiones</label><br>
                <input class="desactivado" type="text" id="NumConexiones" name="NumConexiones" readonly value="<?php echo $numConexiones; ?>">
                <br>

                <label for="FechaHoraUltimaConexion">Fecha Hora �ltima Conexi�n</label><br>
                <input class="desactivado" type="text" id="FechaHoraUltimaConexion" name="FechaHoraUltimaConexion" readonly value="<?php echo (date('d/m/Y H:i:s')); ?>">
                <br>

                <button class="logout" type="submit" name='Aceptar'>Aceptar</button>
                <button class="logout" type="submit" name='Cancelar'>Cancelar</button>
                <button class="logout" type="submit" name='CambiarPassword'>Cambiar Contraseña</button>
    </fieldset>
</form>