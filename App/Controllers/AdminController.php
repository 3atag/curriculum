<?php

namespace App\Controllers;

use App\Models\Experiencia;
use App\Models\Project;

use Respect\Validation\Validator as v;


class AdminController extends BaseController
{
    /***** Mostrar vista *****/
    public function adminAction()
    {

        return $this->renderHTML('admin.twig');

    }

}
