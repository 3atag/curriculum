<?php

// Agregamos archivo autoload
require_once 'vendor/autoload.php';

// Traemos la clase Manager de Elocuent como Capsule
use Illuminate\Database\Capsule\Manager as Capsule;

// Traemos la clase Job
use App\Models\Job;

// Creamos un objeto clase Capsule
$capsule = new Capsule;

// Configuramos el metodo addConnection del objeto creado con los datos de acceso a la base de datos
$capsule->addConnection([
  'driver'    => 'mysql',
  'host'      => 'localhost',
  'database'  => 'curriculum',
  'username'  => 'root',
  'password'  => '',
  'charset'   => 'utf8',
  'collation' => 'utf8_unicode_ci',
  'prefix'    => '',
]);

// Hacemos que la instancia de Capsule esté disponible globalmente a través de métodos estáticos ... (opcional)
$capsule->setAsGlobal();

// Inicializar Eloquent ORM... (opcional; a no ser que se haya usado setEventDispatcher())
$capsule->bootEloquent();

if (!empty($_POST)) {

  $job = new Job;
  $job->title = $_POST['title'];
  $job->description = $_POST['description'];
  $job->save();

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add Job</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

</head>

<body>
  <h1>Agregar Job</h1>
  <form action="addJob.php" method="POST">
    <label for="title">Titulo</label>
    <input type="title" id="title" name="title"> <br />

    <label for="descripcion">Descripcion</label>
    <input type="descripcion" id="description" name="description"> <br />

    <input type="submit" name="agregar" id="agregar" value="Agregar">
  </form>
</body>

</html>