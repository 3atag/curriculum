<?php

namespace App\Models;

class BaseElement
{
    /* Propiedades */
    protected $titulo;
    protected  $descripcion;
    public  $visible = true;
    public  $meses;
    private $tutor;

    /* Constructor */

    public function __construct($contTitulo, $contDescripcion)
    {
        $this->agregarTitulo($contTitulo);
        $this->agregarDescripcion($contDescripcion);
    }


    /************ METODOS */

    public function getDuracion()
    {

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

    /* SETTER titulo */

    public function agregarTitulo($titulo)
    {
        return $this->titulo = $titulo;
    }

    /* SETTER descripcion */

    public function agregarDescripcion($descripcion)
    {
        return $this->descripcion = $descripcion;
    }

} /* Fin de la clase */
