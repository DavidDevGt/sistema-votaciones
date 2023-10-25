<?php

require 'vendor/autoload.php';

$router = new AltoRouter();

$router->setBasePath('/sistema-votaciones');

// Rutas

$router->map('GET', '/', function () {
    require __DIR__ . '/views/index.php';
}, 'inicio');

$router->map('GET', '/registro', function () {
    require __DIR__ . '/views/registro.php';
}, 'registro');

$router->map('GET', '/login', function () {
    require __DIR__ . '/views/login.php';
}, 'login');

$router->map('POST', '/registro/crear', function () {
    require __DIR__ . '/controllers/auth/AuthController.php';
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