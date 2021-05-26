<main>
    <div id="inicioSesion">
        <form name="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h3>Inicia sesion</h3>
            <br>
            <div>
                <label for="CodUsuario">Usuario</label>
                <input type="text" name="CodUsuario" value="<?php if ($aErrores['CodUsuario'] == NULL && isset($_REQUEST['CodUsuario'])) {
    echo $_REQUEST['CodUsuario'];
} ?>">
                <br><br>

                <label for="Password">Contraseña</label>
                <input type = "Password"  name = "Password" value="<?php if ($aErrores['Password'] == NULL && isset($_REQUEST['Password'])) {
    echo $_REQUEST['Password'];
} ?>">
                <br><br>
            </div>
            <div>
                <input class="enviar" type="submit" value="Iniciar Sesion" name="IniciarSesion">
                <br><br>
                <input class="enviar" type="submit" value="Registrarse" name="Registrarse">
            </div>
            <form name="logout" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button class="enviar" type="submit" name='volver'>Volver</button>
            </form>
        </form>
    </div>
</main>