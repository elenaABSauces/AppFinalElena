
        <h2>Variables Superglobales.</h2>
        <h3>$_COOKIE</h3>
        <div>  
        <?php foreach ($_COOKIE as $parm => $value)  echo "<b>$parm </b> ? '$value'<br>"; ?>
        </div>
       
        <h3>$_SESSION</h3>
        <div>    
        <pre>
            <?php print_r($_SESSION);?>
        </pre>
        </div>
        
        <h3>$_SERVER</h3>
        <div>     
            <?php foreach ($_SERVER as $parm => $value)  echo "<b>$parm </b> ? '$value'<br>"; ?>
        </div>
        <h3>$_FILES</h3>
        <div>   
         <?php print_r($_FILES);?>
        </div>
        <form  name="formulario" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">   
            <button type="submit" name='volver' value="volver" class="volver">VOLVER</button>
        </form>