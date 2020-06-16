<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BaseController
{
    protected $templateEngine;

    public function __construct()
    {
        $loader = new FilesystemLoader('../views');

        $this->templateEngine = new Environment($loader, [
            'debug' => true,
            'cache' => false
        ]);

    }

    public function renderHTML($fileName, $data = []){

        return $this->templateEngine->render($fileName,$data);
    }

}