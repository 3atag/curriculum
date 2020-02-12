<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

    protected $table = 'jobs';
}


trait Utilidades
{

    public function mostrarNombre()
    {

        return $this->nombre;
    }
}

class Auto
{
    // propiedad comun
    public $nombre;
    public $marca;

    // invocamos el trait
    use Utilidades;
}

class Persona
{
    // propiedad comun
    public $nombre;
    public $apellido;
    // invocamos el trait
    use Utilidades;
}

$auto = new Auto();
$persona = new Persona();


$auto->mostrarNombre();
$persona->mostrarNombre();


abstract class Computadora
{

    public $encendido;

    abstract public function encender();

    public function apagado()
    {

        $this->encendido = false;
    }
}

class PcAsus extends Computadora
{

    public function encender()
    {

        $this->encendido = true;
    }
}

$computadora = new Computadora();


if (class_exists('Job')) {
 
    echo 'hola';
} else {
    echo 'chau';
}

// Devuelve un array con los nombres de los metodos de un objeto
$metodos = get_class_methods($computadora);