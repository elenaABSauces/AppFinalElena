<?php

class REST{    
    
     public static function sevicioAPOD($fecha) {    
        $aRespuestas=[ //creamos un array con posición para guardar respuesta de Datos o respuesta de exception
            "correcto" => null,
            "incorrecto" => null
        ];
        
        
        try{
            $resultado = file_get_contents("https://api.nasa.gov/planetary/apod?api_key=DEMO_KEY&date=$fecha", true); // obtenemos el resultado del servidor del api rest
            
            if($resultado == false){ // si no obtenemos el resultado esperado
                throw new Exception("Error en la conexión con el servidor, vuelva a intentarlo mas tarde"); //Lanzamos una excepcion
            }

            $aDatos = json_decode($resultado, true); // Almacenamos el array devuelto por json_decode
            
            $aRespuesta["correcto"]= $aDatos;
            
        }catch(Exception $excepcion){
            $aRespuesta ["incorrecto"] = $excepcion -> getMessage(); //Asignamos a un array el mensaje de error de la excepcion
            
        }
        return $aRespuesta;
    }
    
    public static function getElephant($sexo) {    
        $aRespuestas=[ //creamos un array con posición para guardar respuesta de Datos o respuesta de exception
            "correcto" => null,
            "incorrecto" => null
        ];
     
        try{
            $resultado = file_get_contents("https://elephant-api.herokuapp.com/elephants/sex/$sexo", true); // obtenemos el resultado del servidor del api rest
            
            if($resultado == false){ // si no obtenemos el resultado esperado
                throw new Exception("Error en la conexión con el servidor, vuelva a intentarlo mas tarde"); //Lanzamos una excepcion
            }

            $aDatos = json_decode($resultado, true); // Almacenamos el array devuelto por json_decode
          
           $posicion=array_rand($aDatos); //el metodo rand nos devuelve una posicion aleatoria del array
            
           //var_dump($aDatos[$posicion]);
   
           $aRespuesta["correcto"]= $aDatos[$posicion]; //guardamos la respuseta en la posicion correcta

        }catch(Exception $excepcion){
            $aRespuesta ["incorrecto"] = $excepcion -> getMessage(); //Asignamos a la posicion incorrecto el mensaje de error
            
        }  
        
        return $aRespuesta; //devolvemos el array respuesta
    }   

}
?>
