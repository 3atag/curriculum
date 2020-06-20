<?php

namespace App\Controllers;

use App\Models\Experiencia;
use App\Models\Project;

use Respect\Validation\Validator as v;


class ProyectoController extends BaseController
{
    /***** Mostrar formulario agregar registro *****/
    public function postAddProyectoAction()
    {

        return $this->renderHTML('crearProyecto.twig');

    }

    /***** Guardar registro *****/
    public function postSaveProyectoAction($request)
    {
        $responseMessage = null;

        if ($request->getMethod() == 'POST') {

            $postData = $request->getParsedBody();

            $proyectoValidator = v::key('titulo', v::stringType()->notEmpty())
                ->key('descripcion', v::stringType()->notEmpty());


            try {
                $proyectoValidator->assert($postData);
                $proyecto = new Project();

                $proyecto->title = $postData['titulo'];
                $proyecto->description = $postData['descripcion'];
                $proyecto->url = $postData['url'];

                $proyecto->save();

                $responseMessage = 'Proyecto agregado con éxito';

            } catch (\Exception $e) {

                $responseMessage = $e->getMessage();
            }

        }

        return $this->renderHTML('crearProyecto.twig', [
            'responseMessage' => $responseMessage
        ]);
    }
}
