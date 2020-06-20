<?php

// Agregamos archivo autoload
require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Traemos la clase Manager de Elocuent como Capsule
use Illuminate\Database\Capsule\Manager as Capsule;

// Traemos la clase RouterContainer
use Aura\Router\RouterContainer;



// Creamos un objeto clase Capsule
$capsule = new Capsule;

// Configuramos el acceso a la base de datos, es decir: el metodo addConnection del objeto creado con los datos de acceso a la base de datos
$capsule->addConnection([
  'driver'    => 'mysql',
  'host'      => $_ENV['DB_HOST'],
  'database'  => $_ENV['DB_NAME'],
  'username'  => $_ENV['DB_USER'],
  'password'  => $_ENV['DB_PASS'],
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

// En el router podemos guardar un array asociativo con la ruta de la clase y el metodo como handler
$map->get('index', '/',[
  'controller'=>'App\Controllers\IndexController',
  'action'=>'indexAccion'
]);

$map->get('login', '/login',[
    'controller'=>'App\Controllers\AuthController',
    'action'=>'getLogin'
]);

$map->get('addProyecto', '/proyectos/add',[
  'controller'=> 'App\Controllers\ProyectoController',
  'action'=>'postAddProyectoAction'
]);

$map->post('saveProyecto', '/proyectos/save',[
    'controller'=> 'App\Controllers\ProyectoController',
    'action'=>'postSaveProyectoAction'
]);



// El matcher es un objeto que compara lo que tenemos en el request con lo que seteamos en nuestro mapa de rutas
$matcher = $routerContainer->getMatcher();


$route = $matcher->match($request);

if(!$route){

  echo 'No route';

} else {

  // Guardamos el array asociativo  en una variable
  $handlerData = $route->handler;

  $controllerName = $handlerData['controller'];
  $actionName = $handlerData['action'];

  // usamos el valor del primer indice del array creado para cargar dinamicamente el nombre de la clase a instanciar
  $controller = new $controllerName;

  // invocamos el metodo del controlador con el request, que el un objeto Diactoros con todo el contenido normalizado de las superglobales
  $response = $controller->$actionName($request);

  echo $response->getBody();

}


