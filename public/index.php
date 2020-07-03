<?php

// Agregamos archivo autoload
require_once '../vendor/autoload.php';

session_start();

if (file_exists("../.env")) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
}

// Traemos la clase Manager de Elocuent como Capsule
use Illuminate\Database\Capsule\Manager as Capsule;

// Traemos la clase RouterContainer
use Aura\Router\RouterContainer;

// Traemos el estandar PSR7 de Diactores para manejar las respuestas y requerimientos HTTP
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\RedirectResponse;

use App\Services\ExperienciaService;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use WoohooLabs\Harmony\Harmony;
use WoohooLabs\Harmony\Middleware\DispatcherMiddleware;
use WoohooLabs\Harmony\Middleware\LaminasEmitterMiddleware;

// Creamos el canal de log
$log = new Logger('name');
$log->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log', Logger::WARNING));

// Creamos el contenedor de dependencias
$container = new DI\Container();

// Creamos un objeto clase Capsule
$capsule = new Capsule;

// Configuramos el acceso a la base de datos, es decir: el metodo addConnection del objeto creado con los datos de acceso a la base de datos
$capsule->addConnection([
    'driver' => $_ENV['DB_DRIVER'],
    'host' => $_ENV['DB_HOST'],
    'database' => $_ENV['DB_NAME'],
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
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
$map->get('index', '/', [
    'App\Controllers\IndexController',
    'indexAccion'
]);

$map->get('admin', '/admin', [
    'App\Controllers\AdminController',
    'adminAction'
]);

/******************* AUTH ********************/
$map->get('login', '/login', [
    'App\Controllers\AuthController',
    'getLogin'
]);

$map->post('auth', '/auth', [
    'App\Controllers\AuthController',
    'postLogin'
]);

$map->get('logout', '/logout', [
    'App\Controllers\AuthController',
    'getLogout'
]);

/******************* USUARIOS ********************/

$map->get('addUsuario', '/usuarios/add', [
    'App\Controllers\UserController',
    'getAddUserAction'
]);

$map->post('saveUsuario', '/usuarios/save', [
    'App\Controllers\UserController',
    'postSaveUsuarioAction'
]);


/************* EXPERIENCIAS *****************/
$map->get('indexExperiencia', '/experiencias', [
    'App\Controllers\ExperienciaController',
    'indexAction'
]);

$map->get('addExperiencia', '/experiencias/add', [
    'App\Controllers\ExperienciaController',
    'postAddExperienciaAction'
]);

$map->post('saveExperiencia', '/experiencias/save', [
    'App\Controllers\ExperienciaController',
    'postSaveExperienciaAction'
]);

$map->get('deleteExperiencia', '/experiencias/delete', [
    'App\Controllers\ExperienciaController',
    'deleteAction'
]);

$map->get('undeleteExperiencia', '/experiencias/undelete', [
    'App\Controllers\ExperienciaController',
    'undeleteAction'
]);

/************* PROYECTOS *****************/
$map->get('addProyecto', '/proyectos/add', [
    'App\Controllers\ProyectoController',
    'postAddProyectoAction'
]);

$map->post('saveProyecto', '/proyectos/save', [
    'App\Controllers\ProyectoController',
    'postSaveProyectoAction'
]);


// El matcher es un objeto que compara lo que tenemos en el request con lo que seteamos en nuestro mapa de rutas
$matcher = $routerContainer->getMatcher();

$route = $matcher->match($request);

if (!$route) {

    echo 'No route';
} else {

//    // Guardamos el array asociativo  en una variable
//    $handlerData = $route->handler;
//
//    $controllerName = $handlerData['controller'];
//    $actionName = $handlerData['action'];
//
//    $needsAuth = $handlerData['auth'] ?? false;
//
//    $sessionUserId = $_SESSION['userId'] ?? null;
//
//    if ($needsAuth && !$sessionUserId) {
//        // Si requiere autenticacion y el user id NO ESTA definido
//
//        $response = new RedirectResponse('/login');
//        // La respuesta redirige a login
//
//    }
    // Si requiere autenticacion y el user id ESTA definido

    // usamos el valor del primer indice del array creado para cargar dinamicamente el nombre de la clase a instanciar
//        if ($controllerName === 'App\Controllers\ExperienciaController') {
//
//            $controller = new $controllerName(new ExperienciaService());
//
//        } else {
//            $controller = new $controllerName;
//        }
    try {

        $harmony = new Harmony($request, new Response());
        $harmony
            ->addMiddleware(new LaminasEmitterMiddleware(new SapiEmitter()))
            ->addMiddleware(new \App\Middlewares\AuthenticationMiddleware())
            ->addMiddleware(new Middlewares\AuraRouter($routerContainer))
            ->addMiddleware(new DispatcherMiddleware($container, 'request-handler'))
            ->run();

    } catch (\Exception $e) {
        $log->warning($e->getMessage());
        $emmiter = new SapiEmitter();
        $emmiter->emit(new Response\EmptyResponse(400));

    } catch (\Error $e) {

        $emmiter = new SapiEmitter();
        $emmiter->emit(new Response\EmptyResponse(500));

    }


//    $controller = $container->get($controllerName);
//
//    // invocamos el metodo del controlador con el request, que el un objeto Diactoros con todo el contenido normalizado de las superglobales
//    $response = $controller->$actionName($request);
//
//    foreach ($response->getHeaders() as $name => $values) {
//        foreach ($values as $value) {
//            header(sprintf('%s: %s', $name, $value), false);
//        }
//    }
//
//    http_response_code($response->getStatusCode());
//
//    echo $response->getBody();
}
