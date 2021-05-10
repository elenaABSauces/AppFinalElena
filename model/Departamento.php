<?php 
/**
 * Class Departamento
 *
 * Clase que se va a utilizar para crear un objeto de la clase Departamento
 * 
 * @author Cristina Nuñez y Javier Nieto
 * @since 1.1
 * @copyright 2020-2021 Cristina Nuñez y Javier Nieto
 * @version 1.1
 */
class Departamento {
    
    /**
     * Codigo del departamento
     * 
     * @var string 
     */
    private $codDepartamento;

    /**
     * Descripcion del departamento
     * 
     * @var string 
     */
    private $descDepartamento;

    /**
     * Fecha de creacion del departamento
     * 
     * @var int 
     */
    private $fechaCreacionDepartamento;

    /**
     * Volumen de negocio del departamento
     * 
     * @var float 
     */
    private $volumenDeNegocio;

    /**
     * Fecha Baja del departamento
     * 
     * @var int 
     */
    private $fechaBajaDepartamento;
    
        
    /**
     * Metodo magico __construct()
     * 
     * Metodo magico del constructor de la clase Departamento
     *
     * @param  string $codDepartamento
     * @param  string $descDepartamento
     * @param  int $fechaCreacionDepartamento
     * @param  float $volumenDeNegocio
     * @param  int $fechaBajaDepartamento
     */
    function __construct($codDepartamento, $descDepartamento, $fechaCreacionDepartamento, $volumenDeNegocio, $fechaBajaDepartamento=null) {
        $this->codDepartamento = $codDepartamento;
        $this->descDepartamento = $descDepartamento;
        $this->fechaCreacionDepartamento = $fechaCreacionDepartamento;
        $this->volumenDeNegocio = $volumenDeNegocio;
        $this->fechaBajaDepartamento = $fechaBajaDepartamento;
    }

    /**
     * Metodo magico __set()
     * 
     * Metodo que devuelve el valor de un atributo
     * 
     * @param mixed $atributo atributo del que queremos obtener el valor
     * @return mixed valor del atributo que hemos pasado com parametro
     */
    function __get($atributo){
        return $this->$atributo;
    }

    /**
     * Metodo magico __set()
     * 
     * Metodo que cambia el valor de un atributo
     * 
     * @param mixed $atributo atributo al cual queremos cambiarle el valor
     * @param mixed $nuevoValor nuevo valor que queremos para el atributo
     */
    function __set($atributo, $nuevoValor){
        $this->$atributo = $nuevoValor;
    }
}
?>