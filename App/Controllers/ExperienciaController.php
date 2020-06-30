<?php

namespace App\Controllers;

use App\Models\Experiencia;
use App\Models\Project;
use App\Services\ExperienciaService;

use App\Services\ExprerienciaService;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\ServerRequest;
use Respect\Validation\Validator as v;


class ExperienciaController extends BaseController
{
    private $experienciaService;

    public function __construct(ExperienciaService $experienciaService)
    {
        parent::__construct();

        $this->experienciaService = $experienciaService;

    }


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

                if (!$logo->getClientFilename()) {

                    $fileName = '';
                }

                if ($logo->getError() == UPLOAD_ERR_OK) {
                    $filePath = "uploads/";
                    $fileName = $filePath . $logo->getClientFilename();
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

    /***** Index *****/
    public function indexAction()
    {

        $experiencias = Experiencia::withTrashed()->get();

        return $this->renderHTML('experiencias/index.twig', compact('experiencias'));

    }

    /***** Borrar registro (soft delete) *****/
    public function deleteAction(ServerRequest $request)
    {
        $params = $request->getQueryParams();

        $this->experienciaService->deleteExperiencia($params['id']);

        return new RedirectResponse('/experiencias');

    }

    /***** Reactivar registro *****/
    public function undeleteAction(ServerRequest $request)
    {
        $params = $request->getQueryParams();
        $experiencia = Experiencia::withTrashed()
            ->where('id', $params['id'])
            ->restore();

        return new RedirectResponse('/experiencias');

    }
}
