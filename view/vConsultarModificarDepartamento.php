<main id="main-consultarModificarDepartamento">
    <article class="form-container">
        <header>
            <h2>Consultar/Modificar Departamento</h2>
        </header>
        <form id="form-consultarModificarDepartamento" name="form-consultarModificarDepartamento" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <div class="input-field-container">
                <p>Codigo de Departamento</p>
                <input type="text" id="CodDepartamento" name="CodDepartamento" value="<?php echo $oDepartamento->codDepartamento?>" readonly>
            </div>
            <div class="input-field-container">
                <p>Descripcion del Departamento</p>
                <input type="text" id="DescDepartamento" name="DescDepartamento" value="<?php
                    if(isset($_REQUEST['DescDepartamento'])){
                        if($aErrores['DescDepartamento'] != null){
                            echo $oDepartamento->descDepartamento;
                        }else{
                            echo $_REQUEST['DescDepartamento'];
                        }
                    }else{
                        echo $oDepartamento->descDepartamento;
                    }
                    ?>" required>
            </div>
                <?php
                    echo ($aErrores['DescDepartamento'] != null) ? "<span class='error'>" . $aErrores['DescDepartamento'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
                ?>
            <div class="input-field-container">
                 <p>Fecha Creacion</p>
                <input type="text" id="FechaCreacion" name="FechaCreacion" value="<?php echo date('d/m/Y',$oDepartamento->fechaCreacionDepartamento); // si la fecha esta vacia imprime null, si no su valor?>" readonly>
            </div>
            <div class="input-field-container">
                <p>Fecha Baja</p>
                <input type="text" id="FechaBaja" name="FechaBaja" value="<?php echo empty($oDepartamento->fechaBajaDepartamento)?"NULL":date('d/m/Y',$oDepartamento->fechaBajaDepartamento);?>" readonly>       
            </div>
            <div class="input-field-container">
                <p>Volumen Negocio</p>
                <input type="text" id="VolumenNegocio" name="VolumenNegocio" value="<?php
                    if(isset($_REQUEST['VolumenNegocio'])){
                        if($aErrores['VolumenNegocio'] != null){
                            echo $oDepartamento->volumenDeNegocio;
                        }else{
                            echo $_REQUEST['VolumenNegocio'];
                        }
                    }else{
                        echo $oDepartamento->volumenDeNegocio;
                    }
                    ?>" required>
                
            </div>
                <?php
                    echo($aErrores['VolumenNegocio'] != null) ? "<span class='error'>" . $aErrores['VolumenNegocio'] . "</span>" : null; // si el campo es erroneo se muestra un mensaje de error
                ?>
            
            <div>
                <button class="form-button" type="submit" name="Aceptar">Aceptar</button>
            </div>

        </form>

        <form  id="form-buttons" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="form-buttons-consultarModificar" method="post">
            <button class="form-button" type="submit" name="Cancelar">Cancelar</button>
        </form>
    </article>
</main>