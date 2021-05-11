<?php

class REST{    
    
     public static function sevicioAPOD($fecha) {    
        try{
            $resultado = file_get_contents("https://api.nasa.gov/planetary/apod?api_key=DEMO_KEY&date=$fecha", true); // obtenemos el resultado del servidor del api rest
            
            if($resultado == false){ // si no obtenemos el resultado esperado
                throw new Exception("Error en la conexión con el servidor, vuelva a intentarlo mas tarde"); //Lanzamos una excepcion
            }

            $aDatos = json_decode($resultado, true); // Almacenamos el array devuelto por json_decode
            return $aDatos; //devolvemos un array con los datos que queremos devolver
            
        }catch(Exception $excepcion){
            $aRespuesta [0] = $excepcion -> getMessage(); //Asignamos a un array el mensaje de error de la excepcion
            return $aRespuesta; // devolvemos el array con el mensaje de error
        }       
    }
    
    public static function getElephant($sexo) {    
        try{
            $resultado = file_get_contents("https://elephant-api.herokuapp.com/elephants/sex/$sexo", true); // obtenemos el resultado del servidor del api rest
            
            if($resultado == false){ // si no obtenemos el resultado esperado
                throw new Exception("Error en la conexión con el servidor, vuelva a intentarlo mas tarde"); //Lanzamos una excepcion
            }

            $aDatos = json_decode($resultado, true); // Almacenamos el array devuelto por json_decode
          
           $posicion=array_rand($aDatos); //el metodo rand nos devuelve una posicion aleatoria del array
            
           //var_dump($aDatos[$posicion]);
              
           return $aDatos[$posicion];//devolvemos una posicion aleatoria del array $aDatos

            
        }catch(Exception $excepcion){
            $aRespuesta [0] = $excepcion -> getMessage(); //Asignamos a un array el mensaje de error de la excepcion
            return $aRespuesta; // devolvemos el array con el mensaje de error
        }       
    }   

}
    
 
?>