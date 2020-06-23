<?php

namespace App\Controllers;

use App\Models\{Categoria, Experiencia, Project, Skilltool, User, Net};
use Respect\Validation\Validator as v;
use Laminas\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController
{

    /***** Mostrar todos los registros *****/
    public function getLogin()
    {
        return $this->renderHTML('login.twig');
    }

    /***** Guardar registro *****/
    public function postLogin($request)
    {
        $responseMessage = null;

        if ($request->getMethod() == 'POST') {

            $postData = $request->getParsedBody();

            $userValidator = v::key('email', v::email()->notEmpty())
                ->key('clave', v::stringType()->notEmpty());


            try {
                $userValidator->assert($postData);

                $user = User::where('email', $postData['email'])->first();
                if ($user) {

                    if(\password_verify($postData['clave'], $user->clave)) {

                        $_SESSION['userId'] = $user->id;
                        return new RedirectResponse('admin');

                    } else {
                        $responseMessage = 'Usuario o clave no válidas';

                    }


                } else {
                    $responseMessage = 'Usuario o clave no válidas';

                }

            } catch (\Exception $e) {

                $responseMessage = $e->getMessage();
            }

        }

        return $this->renderHTML('login.twig', [
            'responseMessage' => $responseMessage
        ]);
    }

    /***** Cerrar session *****/
    public function getLogout()
    {
        session_unset ();

        return new RedirectResponse('/login');
    }


}
