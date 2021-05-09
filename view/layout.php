<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <title>Aplicacion Final</title>
            <link rel="stylesheet" href="webroot/css/estilo.css">
        </head>
        <body>
            <nav class="navInicio">
                <ul class="logoInicio">
                    <li id="logo">App Final Elena</li>
                    
                </ul>
                <form class="forNavInicio" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <?php 
                        if(isset($_SESSION['usuarioDAW216DBProyectoFinal'])){
                    ?>
                     <button class="botonNav" name="rest">Rest</button>
                     <button class="botonNav" name="wip">Mto Departamentos</button>
                     <button class="botonNav" name="editarPerfil">Editar Perfil</button>
                     <button class="botonNav" name="cerrarSesion">Cerrar Sesion</button>
                    <?php 
                    }else{
                    ?>
                    <button class="botonNav" name="inicioSesion">Iniciar Sesion</button>
                           
                    <?php 
                    }
                    ?>
                     
                </form>
            </nav>

            <?php require_once $vistaEnCurso ?>

        <footer>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table>
                <tr>
                    <td><a href="https://www.redhat.com/es" target="_blank">Pagina web imitada</a>
                        <img src="webroot/media/redhat.png" widht="20" height="20"></td>
                    
                    <td class="derechos"><a href="../../index.html">Elena de Anton &copy; 2020/21</a> 
                            <a href="https://github.com/elenaABSauces/AppFinalElena" target="_blank">  
                            <img src="webroot/media/images/github.png" widht="20" height="20"></a></td>
                </tr>
            </table>
        </form>
        </footer>
    </body>
</html>