<?php

class BaseElement
{
    /* Propiedades */
    private $titulo;
    public  $descripcion;
    public  $visible = true;
    public  $meses;
    private $tutor;

    /* Constructor */

    public function __construct($contTitulo, $contDescripcion)
    {
        $this->agregarTitulo($contTitulo);
        $this->descripcion = $contDescripcion;
    }

    /* Otros Metodos Magicos */

    public function __call($metodo, $argumentos = null) { 
        /* convertimos el nombre del metodos a minusculas */
        $metodo = strtolower($metodo);
        /* extraemos los primeros 3 caractres del nombre del metodo y lo guardamos en la variable prefijo */
        $prefijo = substr($metodo, 0, 3);
        /* extraemos el nombre del atributo, es decir todo lo que le siga a las 3 primeras letras (set o get) y lo guardamos en la variable atributo */
        $atributo = substr($metodo, 3);

        /* Revisamos si el prefio es iguala a set y hay un unico argumento  */
        if ($prefijo == 'set' && count($argumentos) == 1) {

            /* Si existe el atributo en la clase */
            if (property_exists(__CLASS__, $atributo)) {

                /* Creo la variable valor, que contendra el valor del atributo y le asignos el valor del argumento */
                $valor = $argumentos[0];

                /* Asignos la variable valor al atributo */
                $this->$atributo = $valor;
            
            /* Si no existe el atributo en la lcase */
            } else {

                /* Muestro mensaje de error */
                echo "No existe el atributo $atributo.";
            }


            /* Si el prefijo es igual a get */
        } elseif ($prefijo == 'get') {

            /* Si existe el atributo en la clase */
            if (property_exists(__CLASS__, $atributo)) { 
                
                /* Muestro el valor del atributo */
                return $this->$atributo;  
              }
              
            /* Si no existe el atributo en la clase devuelvo null */  
            return NULL;  


            /* Si el prefijo no se corresponde con ninguno de los dos */
        } else {
            echo 'Método no definido <br/>';
        }

       
    }      

    public static function __callStatic($metodo, $argumentos) {  
       
        echo "fallo al llamar al método estatico $metodo() con los argumentos $argumentos";  

    }

    function __isset($atributo) {  

     return isset($this->$atributo);
       
   }  

   
    /* Metodos */

   public function obtenerDuracion() {

        $años  = floor($this->meses / 12);

        if ($años != 0) {

            if ($años > 1) {
                $textoAños = ' años';
            } else {
                $textoAños = ' año';
            }

            $añosCompleto = $años . $textoAños;
        } else {
            $añosCompleto = '';
        }

        $resto = floor($this->meses % 12);

        if ($resto != 0) {

            if ($resto > 1) {
                $textoResto = ' meses';
            } else {
                $textoResto = ' mes';
            }

            $restoCompleto = $resto . $textoResto;
        } else {
            $restoCompleto = '';
        }


        $resultado = $añosCompleto . ' ' . $restoCompleto;


        return $resultado;
    }

    /* Metodo para setear titulo */
   
    public function agregarTitulo ($titulo) {
        return $this->titulo = $titulo;
    }
    


} /* Fin de la clase */

?>