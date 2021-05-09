<?php

class REST{    
    
        public static function sevicioAPOD($fecha) {
        //llamamos al servicio, pasándole la fecha al campo date, y decodificamos el json que nos devuelve
        return json_decode(file_get_contents("https://api.nasa.gov/planetary/apod?api_key=DEMO_KEY&date=$fecha"), true);        
    }
}
    
 
?>