<?php

namespace App\Controllers;

use App\Models\{Job, Project};

class IndexController
{

    public function indexAccion()
    {

        $name = 'Juan Pintos';

        $limitMonths = 2000;

        // Tremos todos los registros que Elocuent encuentre en el modelo Job
        $jobs = Job::all();

        // Tremos todos los registros que Elocuent encuentre en el modelo Job
        $projects = Project::all();

        include '../views/index.php';

    }
}
