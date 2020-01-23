<?php

// En Xampp el sistema de errores viene activo por defecto, pero en otros servidores puede no estar acitvo. Con estos codigos podemos visualizar los errores en pantalla. SOLO USAR EN DESARROLLO

ini_set('display_errors', 1);
ini_set('display_starup_errors', 1);
error_reporting(E_ALL);

// Agregamos archivo autoload
require_once '../vendor/autoload.php';

// Traemos la clase Manager de Elocuent como Capsule
use Illuminate\Database\Capsule\Manager as Capsule;

// Traemos la clase RouterContainer
use Aura\Router\RouterContainer;

// Creamos un objeto clase Capsule
$capsule = new Capsule;

// Configuramos el acceso a la base de datos, es decir: el metodo addConnection del objeto creado con los datos de acceso a la base de datos
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

// Creamos un objeto diactoros que contenga a todas las superglobales
$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);
// Creo un contenedor de rutas (objeto de la clase Aura/Router)
$routerContainer = new RouterContainer();

// Creamos el mapa de ruta
$map = $routerContainer->getMap();


$map->get('index', '/curriculum/','../index.php');

$map->get('addJobs', '/curriculum/jobs/add','../addJob.php');

$matcher = $routerContainer->getMatcher();

$route = $matcher->match($request);

if(!$route){

  echo 'No route';

} else {

  require $route->handler;

}
