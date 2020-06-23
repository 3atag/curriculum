<?php

namespace App\Controllers;

use App\Models\{Experiencia, Project, User };

use Respect\Validation\Validator as v;


class UserController extends BaseController
{
    /***** Mostrar formulario agregar registro *****/
    public function getAddUserAction()
    {

        return $this->renderHTML('crearUser.twig');

    }

    /***** Guardar registro *****/
    public function postSaveUsuarioAction($request)
    {
        $responseMessage = null;

        if ($request->getMethod() == 'POST') {

            $postData = $request->getParsedBody();

            $userValidator = v::key('nombre', v::stringType()->notEmpty())
                ->key('apellido', v::stringType()->notEmpty())
                ->key('email', v::email()->notEmpty())
                ->key('clave', v::stringType()->notEmpty());


            try {
                $userValidator->assert($postData);
                $usuario = new User();

                $usuario->firstName = $postData['nombre'];
                $usuario->lastName = $postData['apellido'];
                $usuario->email = $postData['email'];
                $usuario->clave = password_hash( $postData['clave'], PASSWORD_DEFAULT);
                $usuario->phoneCell = $postData['telefono'];
                $usuario->resumen = $postData['resumen'];

                $usuario->save();

                $responseMessage = 'Usuario creado con éxito';

            } catch (\Exception $e) {

                $responseMessage = $e->getMessage();
            }

        }

        return $this->renderHTML('crearUser.twig', [
            'responseMessage' => $responseMessage
        ]);
    }
}
