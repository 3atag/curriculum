<?php

namespace App\Controllers;

use App\Models\{Categoria, Experiencia, Project, Skilltool, User, Net};

class AuthController extends BaseController
{

    /***** Mostrar todos los registros *****/
    public function getLogin()
    {
          return $this->renderHTML('login.twig');
    }

    }
