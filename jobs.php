<?php

use App\Models\{Job,Project};

// Tremos todos los registros que Elocuent encuentre en el modelo Job
$jobs = Job::all();

$project1 = new Project ('Intranet','Sistema Intranet para CPHA');
$project1->visible = true;
$project1->meses = 11;



$projects = [
    $project1
];



function imprimirElementos($elemento)
{

    // if ($elemento->visible == false) {
    //     return;
    // }

    echo '
    <div class="project">
                <h5>'.$elemento->title.'</h5>
                <div class="row">
                    <div class="col-3">
                        <img id="profile-picture" src="https://ui-avatars.com/api/?name=John+Doe&size=255" alt="">
                      </div>
                      <div class="col">'.$elemento->description.'.</p>
                        <strong>Technologies used:</strong>
                        <span class="badge badge-secondary">PHP</span>
                        <span class="badge badge-secondary">HTML</span>
                        <span class="badge badge-secondary">CSS</span>
                      </div>
                     
                </div>
            </div>';
            
}
