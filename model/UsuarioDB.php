<?php

/**
 * Interface UsuarioDB
 * 
 * Interface que se va a implementar en la clace UsuarioPDO
 * 
 * @author Cristina Nuñez y Javier Nieto
 * @since 1.0
 * @copyright 2020-2021 Cristina Nuñez y Javier Nieto
 * @version 1.0
 */
interface UsuarioDB{

    /**
     * Metodo validarUsuario()
     * 
     * Metodo que valida si existe un determinado usuario y password en la base de datos.
     * 
     * @param string $codUsuario codigo del usuario
     * @param string $password password del usuario
     */
    public static function validarUsuario($codUsuario,$password);
}

?>