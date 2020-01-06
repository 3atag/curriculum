<?php

require 'modelos/Job.php';
require 'modelos/Project.php';


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

$projects = [
    $project1
];



function imprimirElementos($elemento)
{

    if ($elemento->visible == false) {
        return;
    }

    echo '
    <div class="project">
                <h5>'.$elemento->getTitulo().'</h5>
                <div class="row">
                    <div class="col-3">
                        <img id="profile-picture" src="https://ui-avatars.com/api/?name=John+Doe&size=255" alt="">
                      </div>
                      <div class="col">'.$elemento->getDescripcion().'.</p>
                        <strong>Technologies used:</strong>
                        <span class="badge badge-secondary">PHP</span>
                        <span class="badge badge-secondary">HTML</span>
                        <span class="badge badge-secondary">CSS</span>
                      </div>
                </div>
            </div>';
            
}
