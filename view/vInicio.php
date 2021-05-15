<main>
    <article>
        <div id=""imagenPerfil">
            <?php echo ($imagenUsuario != null) ? '<img id="fotoPerfil" src = "data:image/png;base64,' . base64_encode($imagenUsuario) . '" alt="Foto de perfil"/>' : "<img id='fotoPerfil'src='webroot/images/image_perfil.png' alt='imagen_perfil' />"; ?>
        </div>
        <div id="inicio">
            <h3><?php echo ($numConexiones > 1) ? "Te has conectado " . $numConexiones . " veces.<br>La última conexión fue el " . date('d/m/Y', $ultimaConexionAnterior) . " a las " . date('H:i:s', $ultimaConexionAnterior) : "Esta es la primera vez que te conectas." ?></h3>

    </article>
</main>
</body>