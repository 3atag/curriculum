<?php

namespace App\Controllers;

use App\Models\Job;

class JobsController
{
    public function postAddJobAction($request)
    {

        // Si el formulario fue enviado
        if ($request->getMethod() == 'POST') {

            $postData = $request->getParsedBody();
            // Creo una nueva instancia de la clase Job
            $job = new Job;
            // Agrego al atributo title (notar que es el mismo nombre que el campo de la tabla jobs en la BD) el valor del titulo que llega desde el formulario
            $job->title = $postData['title'];
            // Agrego al atributo description (notar que es el mismo nombre que el campo de la tabla jobs en la BD) el valor de la descripcion que llega desde el formulario
            $job->description = $postData['description'];
            // invocamos el metodo save para guardar los datos en la base.
            $job->save();
        }

        include '../views/addJob.twig';

    }
}
