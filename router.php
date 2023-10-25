<?php
require_once 'vendor/autoload.php';
require_once 'controllers/auth/AuthController.php';

// Inicio el enrutador con la lib AltoRouter
$router = new AltoRouter();

// Configurar la ruta
$router->setBasePath('/sistema-votaciones');

// Rutas
$router->map('GET', '/', function () {
    if (!verificar_sesion()) {
        header('Location: /sistema-votaciones/login');
        exit();
    }
    require __DIR__ . '/index.php';
}, 'inicio');

$router->map('GET', '/registro', function () {
    if (verificar_sesion()) {
        header('Location: /sistema-votaciones/');
        exit();
    }
    require __DIR__ . '/views/registro.php';
}, 'registro');

$router->map('GET', '/login', function () {
    if (verificar_sesion()) {
        header('Location: /sistema-votaciones/');
        exit();
    }
    require __DIR__ . '/views/login.php';
}, 'login');

$router->map('POST', '/registro/crear', function () {
    registrar();
});

$router->map('POST', '/login/entrar', function () {
    iniciar_sesion();
});

$router->map('GET', '/cerrar-sesion', function () {
    cerrar_sesion();  // Llama a la función cerrar_sesion directamente
});

// Mas

// Que hagan match como si fuera Tinder :v
$match = $router->match();

// Llamar al callback o mostrar un error 404
if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    // No se encontró la ruta
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404 Not Found';
}