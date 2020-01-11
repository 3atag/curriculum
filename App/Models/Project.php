<?php

namespace modelos;

// namespace app\modelos;

require_once 'BaseElement.php';
require_once 'Printable.php';

class Project extends BaseElement implements Printable {

    public function obtenerTitulo() {

        return $this->titulo;

    }

    public function obtenerDescripcion() {

        return $this->descripcion;

    }
}


?>