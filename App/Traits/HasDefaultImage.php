<?php


namespace App\Traits;


trait HasDefaultImage
{

    public function getImage($altText)
    {
        if (!$this->logoEmpresa) {

            return "https://ui-avatars.com/api/?name=$altText&size=90";

        }

        return $this->logoEmpresa;

    }


}