<?php


namespace App\Middlewares;


use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthenticationMiddleware implements MiddlewareInterface
{

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        if ($request->getUri()->getPath() === '/admin' or
            $request->getUri()->getPath() === '/logout' or
            $request->getUri()->getPath() === '/usuarios/add' or
            $request->getUri()->getPath() === '/experiencias' or
            $request->getUri()->getPath() === '/experiencias/add' or
            $request->getUri()->getPath() === '/experiencias/delete' or
            $request->getUri()->getPath() === '/experiencias/undelete' or
            $request->getUri()->getPath() === '/proyectos/add'

        ) {

            $sessionUserId = $_SESSION['userId'] ?? null;

            if(!$sessionUserId) {

                return new RedirectResponse('/login');

            }



        }

        return $handler->handle($request);

    }
}