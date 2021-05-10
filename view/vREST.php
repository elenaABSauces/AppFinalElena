<main class="mainRest">
    <div id="inicio">
        <h1>Rest</h1>
           <div id="formulario-rest">
                    <h2>APOD: Astronomy Picture of the Day</h2>
              
                <div id="apodForm" style="display: <?php echo $apodDisplay ?>">
                    <p>Puedes seleccionar una fecha para ver su imagen</p>
                    <form name="rest" id="rest" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <p>
                            <input type="date" name="fecha" max="<?php echo date('Y-m-d') ?>" value="<?php echo date('Y-m-d') ?>">
                        </p>
                        <div class="botones">
                            <input type="submit" value="Buscar" name="enviar">
                        </div>
                    </form>
                    <a href="https://github.com/nasa/apod-api" target="_blank">Documentacion del servicio</a>
                </div>
                <div id="servicio-rest">
<<<<<<< HEAD
                <div id="apodService" style="display: <?php echo $apodDisplay ?>">
=======
                <div id="apodService" >
>>>>>>> development
                    <h3><?php echo $aServicioAPOD['title'] ?></h3>
                    <img src="<?php echo $aServicioAPOD['url'] ?>" widht="500" height="300">
                    <p><?php echo $aServicioAPOD['explanation'] ?></p>
                </div>
        
        
        <br>
        <form class="forNavInicio" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <input class="boton" type="submit" value="volver" name="volver">
        </form>
    </div>
</main>