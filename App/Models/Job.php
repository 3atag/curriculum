<?php

namespace App\Models;

class Job extends BaseElement implements Printable {

    public function __construct($contTitulo, $contDescripcion) 
    {
        $newContTitulo = 'Job '.$contTitulo;

        parent::__construct($newContTitulo, $contDescripcion);
    }

    
    public function obtenerTitulo() {

        return $this->titulo;

    }

    public function obtenerDescripcion() {

        return $this->descripcion;

    }


}

?>