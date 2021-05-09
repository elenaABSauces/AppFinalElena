<main class="mainEditarPerfil">
    <div id="editarPerfil">
        <form name="formulario" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="form" enctype="multipart/form-data">
            <h3>Editar Perfil</h3>
            <br>
            <h4>Campos bloqueados (*)</h4>
            <br>
            <div>
                <label for="CodUsuario">Usuario (*)</label><br>
                <input class="campos" type="text" id="CodUsuario" name="CodUsuario" readonly value="<?php echo $_SESSION['usuarioDAW215AplicacionFinal']->codUsuario; ?>">
                <br><br>

                <label for="DescUsuario" >Descripción del usuario</label><br>
                <input class="campos" type="text" id="DescUsuario" name="DescUsuario" value="<?php echo $_SESSION['usuarioDAW215AplicacionFinal']->descUsuario; ?>">
                <?php
                    echo $errorDescripcion!=null ? "<span style='color:#FF0000'>".$errorDescripcion."</span>" : null;// si el campo es erroneo se muestra un mensaje de error
                ?>
                <br><br>

                <label for="NumConexiones">Número de conexiones (*)</label><br>
                <input class="campos" type="text" id="NumConexiones" name="NumConexiones" readonly value="<?php echo $_SESSION['usuarioDAW215AplicacionFinal']->numConexiones; ?>">
                <br><br>

                <label for="FechaHoraUltimaConexion">Fecha Hora Última Conexión (*)</label><br>
                <input class="campos" type="text" id="FechaHoraUltimaConexion" name="FechaHoraUltimaConexion" readonly value="<?php echo (date('d/m/Y H:i:s',$_SESSION['usuarioDAW215AplicacionFinal']->fechaHoraUltimaConexion)); ?>">
                <br><br>

                <label for="imagen">Imagen</label><br>
                <input class="campos" type="file" id="imagen" name="imagen">
                <?php
                    echo $errorImagen!=null ? "<span style='color:#FF0000'>".$errorImagen."</span>" : null;// si el campo es erroneo se muestra un mensaje de error
                ?>
                <br><br>

                <input class="cambiarPassword" type="submit" value="CambiarPassword" name="CambiarPassword">
                <br>
                <input class="eliminarCuenta" type="submit" value="EliminarCuenta" name="EliminarCuenta">
                <br><br>
            </div>
            <div>
                <input class="enviar" type="submit" value="Aceptar" name="Aceptar">
                <br>
                <input class="enviar" type="submit" value="Cancelar" name="Cancelar">
            </div>
        </form>
    </div>
</main>