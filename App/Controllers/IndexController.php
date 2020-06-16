<?php

namespace App\Controllers;

use App\Models\{Job, Project};

class IndexController extends BaseController
{

    /***** Mostrar todos los registros *****/
    public function indexAccion()
    {
        $jobs = Job::select('title', 'description')->get();
        $proyectos = Project::select('title', 'description')->get();

        return $this->renderHTML('addJob.twig', [
            'jobs' => $jobs,
            'proyects' => $proyectos,
            'name' => 'Juan Pintos'
        ]);
    }

    }
