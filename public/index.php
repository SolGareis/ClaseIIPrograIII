<?php
// El __DIR__ nos dice dónde estamos (carpeta public)
// El /../ nos dice "salí de public y entrá a la carpeta principal"
// Luego entramos a src y buscamos Router.php
require_once __DIR__ . '/../src/Router.php';

$router = new Router();
$router->run();