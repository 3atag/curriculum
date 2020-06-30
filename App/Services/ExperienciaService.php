<?php

namespace App\Services;

use App\Models\Experiencia;

class ExperienciaService
{
    public function deleteExperiencia($id)
    {
        $experiencia = Experiencia::find($id);
        $experiencia->delete();

    }
}