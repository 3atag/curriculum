<?php

// Traemos la clase Job
use App\Models\Job;

// Si el formulario fue enviado
if (!empty($_POST)) {
  // Creo una nueva instancia de la clase Job
  $job = new Job;
  // Agrego al atributo title (notar que es el mismo nombre que el campo de la tabla jobs en la BD) el valor del titulo que llega desde el formulario
  $job->title = $_POST['title'];
  // Agrego al atributo description (notar que es el mismo nombre que el campo de la tabla jobs en la BD) el valor de la descripcion que llega desde el formulario
  $job->description = $_POST['description'];
  // invocamos el metodo save para guardar los datos en la base.
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