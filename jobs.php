<?php

use App\Models\Job;

// Tremos todos los registros que Elocuent encuentre en el modelo Job
$jobs = Job::all();


function imprimirJobs($elemento)
{

  // if ($elemento->visible == false) {
  //     return;
  // }

  echo '
    <ul>
            <li class="work-position">
              <h5>' . $elemento->title . '</h5>
              <p>' . $elemento->description . '</p>
              <strong>Achievements:</strong>
              <ul>
                <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
                <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
                <li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>
              </ul>
            </li>
           
          </ul>';
}



