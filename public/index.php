<?php
// Requerimos el archivo del Router que está en la carpeta src
require_once __DIR__ . '/../src/Router.php';

$router = new Router();
$router->run();