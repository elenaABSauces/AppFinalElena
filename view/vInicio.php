<main>
    <article id="inicio">
        <div id="imagenPerfil">
            <?php echo ($imagenUsuario != null) ? '<img id="fotoPerfil" src = "data:image/png;base64,' . base64_encode($imagenUsuario) . '" alt="Foto de perfil"/>' : "<img id='fotoPerfil'src='webroot/media/images/image_perfil.png' alt='imagen_perfil' />"; ?>
        </div>
        <div id="iconexion">
            <h3><?php echo ($numConexiones > 1) ? "Te has conectado " . $numConexiones . " veces.<br>La útima conexión fue el " . date('d/m/Y', $ultimaConexionAnterior) . " a las " . date('H:i:s', $ultimaConexionAnterior) : "Esta es la primera vez que te conectas." ?></h3>
        </div>
    </article>
</main>
</body>