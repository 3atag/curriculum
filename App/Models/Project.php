<?php

namespace App\Models;

class Project extends BaseElement implements Printable {

    public function obtenerTitulo() {

        return $this->titulo;

    }

    public function obtenerDescripcion() {

        return $this->descripcion;

    }
}


?>