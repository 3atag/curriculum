<?php

namespace App\Services;

use App\Models\Experiencia;

class ExperienciaService
{
    public function deleteExperiencia($id)
    {
        $experiencia = Experiencia::findOrFail($id);
        if (!$experiencia) {
           throw new \Exception('Experiencia no encontrada');
        }
        $experiencia->delete();

    }
}