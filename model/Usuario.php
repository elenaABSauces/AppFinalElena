<?php

/**
 * Class Usuario
 *
 * Clase que se va a utilizar para crear un objeto de la clase Usuario
 * 
 * @author Cristina Nuñez y Javier Nieto
 * @since 1.0
 * @copyright 2020-2021 Cristina Nuñez y Javier Nieto
 * @version 1.0
 */
class Usuario {
    
    /**
     * Codigo del usuario 
     * 
     * @var string 
     */
    private $codUsuario;
    
    /**
     * Password del usuario 
     * 
     * @var string  
     */
    private $password;
    
    /**
     * Descripcion del usuario 
     * 
     * @var string 
     */
    private $descUsuario;
    
    /**
     * Numero de conexiones que ha realizado el usuario 
     * 
     * @var int 
     */
    private $numConexiones;
    
    /**
     * Ultima fecha y hora de la ultima conexion en formato timestamp 
     * 
     * @var int 
     */
    private $fechaHoraUltimaConexion;
    
    /**
     * Tipo de perfil del usuario (usuario, administrador) 
     * 
     * @var string 
     */
    private $perfil;
    
    /**
     * Datos de la imagen en formato binario de la base de datos
     * 
     * @var string 
     */
    private $imagenPerfil;
    
    /**
     * Metodo magico __construct()
     * 
     * Metodo magico del constructor de la clase Usuario
     * 
     * @param string $codUsuario codigo del usuario
     * @param string $password password del usuario
     * @param string $descUsuario descripcion del usuario
     * @param int $numConexiones numero de conexiones del usuario
     * @param int $fechaHoraUltimaConexion fecha y hora de la ultima conexion del usuario en formato timestamp
     * @param string $perfil tipo de perfil del usuario
     * @param string $imagenPerfil imagen de perfil del usuario imagen en formato binario de la base de datos
     */
    function __construct($codUsuario, $password, $descUsuario, $numConexiones, $fechaHoraUltimaConexion, $perfil, $imagenPerfil) {
        $this->codUsuario = $codUsuario;
        $this->password = $password;
        $this->descUsuario = $descUsuario;
        $this->numConexiones = $numConexiones;
        $this->fechaHoraUltimaConexion = $fechaHoraUltimaConexion;
        $this->perfil = $perfil;
        $this->imagenPerfil = $imagenPerfil;
    }
    
        
    /**
     * Metodo mágico __get
     * 
     * Metodo que obtiene el valor de un atributo un objeto
     *
     * @param  mixed $atributo
     * @return mixed valor del atributo
     */
    function __get($atributo){
        return $this -> $atributo;
    }
    
    /**
     * Metodo magico __set
     * 
     * Metodo que establece un nuevo valor a un atributo  de un objeto
     *
     * @param  mixed $atributo
     * @param  mixed $nuevoValor
     * @return void
     */
    function __set($atributo, $nuevoValor){
        $this -> $atributo = $nuevoValor;
    }
}