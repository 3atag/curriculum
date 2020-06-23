<?php

namespace App\Controllers;

use App\Models\{Categoria, Experiencia, Project, Skilltool, User, Net};

class IndexController extends BaseController
{

    /***** Mostrar todos los registros *****/
    public function indexAccion()
    {
        $experiencias = Experiencia::select('puesto', 'empresa', 'logoEmpresa', 'resumen')->get();
        $projects = Project::select('title', 'description','url')->get();
        $usuario = User::select('firstName', 'lastName', 'email', 'phoneCell', 'resumen')
            ->where('activo', '=', 1)
            ->get();

        $redes = Net::select('socialNetworks.name', 'socialNetworks.url')
            ->join('users', 'socialNetworks.idUser', '=', 'users.id')
            ->where('users.activo', '=', 1)
            ->get();

        $categorias = Categoria::select('id','nombre',)
            ->where('activo', '=', 1)
            ->get();

        $skillstools = Skilltool::select('skillsTools.nombre', 'skillsTools.idCategoria', 'categorias.nombre AS categoria')
            ->join('categorias', 'skillsTools.idCategoria', '=', 'categorias.id')
            ->where('skillsTools.activo', '=', 1)
            ->get();

        return $this->renderHTML('index.twig', [
            'experiencias' => $experiencias,
            'projects' => $projects,
            'user' => $usuario,
            'nets' => $redes,
            'categorias' => $categorias,
            'skillstools' => $skillstools,
        ]);
    }

    }
