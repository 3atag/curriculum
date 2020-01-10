<?php


require 'modelos/Job.php';
require 'modelos/Project.php';
require_once 'modelos/Printable.php';

require 'libreriaX/Project.php';

use modelos\{Job,Project,Printable};

$job1 = new Job('Programador PHP', 'Este es un trabajo increible');

$job1->visible = true;
$job1->meses = 16;


$job2 = new Job('Programador Javascript', 'Este es un trabajo increible');
$job2->visible = true;
$job2->meses = 6;


$jobs = [
    $job1,
    $job2
];


$project1 = new Project ('Intranet','Sistema Intranet para CPHA');
$project1->visible = true;
$project1->meses = 11;

$projectLibX = new libreriaX\Project();

$projects = [
    $project1
];



function imprimirElementos(Printable $elemento)
{

    if ($elemento->visible == false) {
        return;
    }

    echo '
    <div class="project">
                <h5>'.$elemento->obtenerTitulo().'</h5>
                <div class="row">
                    <div class="col-3">
                        <img id="profile-picture" src="https://ui-avatars.com/api/?name=John+Doe&size=255" alt="">
                      </div>
                      <div class="col">'.$elemento->obtenerDescripcion().'.</p>
                        <strong>Technologies used:</strong>
                        <span class="badge badge-secondary">PHP</span>
                        <span class="badge badge-secondary">HTML</span>
                        <span class="badge badge-secondary">CSS</span>
                      </div>
                      <p>'.$elemento->getDuracion().'</p>
                </div>
            </div>';
            
}
