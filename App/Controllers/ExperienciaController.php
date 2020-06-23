<?php

namespace App\Controllers;

use App\Models\Experiencia;
use App\Models\Project;

use Respect\Validation\Validator as v;


class ExperienciaController extends BaseController
{
    /***** Mostrar formulario agregar registro *****/
    public function postAddExperienciaAction()
    {

        return $this->renderHTML('crearExperiencia.twig');

    }

    /***** Guardar registro *****/
    public function postSaveExperienciaAction($request)
    {
        $responseMessage = null;

        if ($request->getMethod() == 'POST') {

            $postData = $request->getParsedBody();

            $experienciaValidator = v::key('puesto', v::stringType()->notEmpty())
                ->key('empresa', v::stringType()->notEmpty())
                ->key('resumen', v::stringType()->notEmpty());


            try {
                $experienciaValidator->assert($postData);
                $files = $request->getUploadedFiles();
                $logo = $files['logo_empresa'];

                if ($logo->getError() == UPLOAD_ERR_OK) {
                    $fileName = $logo->getClientFilename();
                    $logo->moveTo("uploads/$fileName");
                }
                $experiencia = new Experiencia();

                $experiencia->puesto = $postData['puesto'];
                $experiencia->empresa = $postData['empresa'];
                $experiencia->logoEmpresa = $fileName;
                $experiencia->resumen = $postData['resumen'];

                $experiencia->save();

                $responseMessage = 'Experiencia agregada con éxito';

            } catch (\Exception $e) {

                $responseMessage = $e->getMessage();
            }

        }

        return $this->renderHTML('crearExperiencia.twig', [
            'responseMessage' => $responseMessage
        ]);
    }
}
