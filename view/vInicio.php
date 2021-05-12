
<main class="mainInicio">
    <div id="imagen">
        <?php
            if(isset($oUsuarioActual->imagenPerfil)){
                echo '<img style="margin-rigth: 2px;" src = "data:image/png;base64,' . base64_encode($oUsuarioActual->imagenPerfil) . '" width = "20px"/>';
            }
        ?>
    </div>
    <div id="inicio">
        <h1>Bienvenido/a <?php echo $oUsuarioActual->descUsuario?></h1>
        <p><?php echo ($oUsuarioActual->numConexiones > 1) ? "Esta es la ".$oUsuarioActual->numConexiones." vez que se conecta" : "Es la primera vez que se conecta" ?></p>
        <p><?php echo isset($ultimaConexion) ? "Se conecto por ultima vez el ".date('d/m/Y',$ultimaConexion)." a las ".date('H:i:s',$ultimaConexion) : null; ?> </p>
    </div>
</main>