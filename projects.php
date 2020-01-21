<?php

use App\Models\Project;

// Tremos todos los registros que Elocuent encuentre en el modelo Job
$projects = Project::all();


function imprimirProjects($elemento) {

    // if ($elemento->visible == false) {
    //     return;
    // }

    echo '<div class="project">
  <h5>'.$elemento->title.'</h5>
  <div class="row">
      <div class="col-3">
          <img id="profile-picture" src="https://ui-avatars.com/api/?name=John+Doe&size=255" alt="">
        </div>
        <div class="col">
          <p>'.$elemento->description.'</p>
          <strong>Technologies used:</strong>
          <span class="badge badge-secondary">PHP</span>
          <span class="badge badge-secondary">HTML</span>
          <span class="badge badge-secondary">CSS</span>
        </div>
  </div>
</div>';
}
