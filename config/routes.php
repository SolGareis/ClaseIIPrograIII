<?php
class Router {
    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];

        // Limpiamos la ruta para que solo quede lo que viene después de /public
        $path = parse_url($requestUri, PHP_URL_PATH);
        $path = str_replace('/AgroSense/public', '', $path);
        if ($path === '' || $path === false) { $path = '/'; }

        // Ruta de salud
        if ($method === 'GET' && $path === '/health') {
            header('Content-Type: application/json');
            echo json_encode([
                "status" => "ok",
                "timestamp" => date("Y-m-d H:i:s"),
                "php_version" => phpversion(),
                "server" => "Apache/XAMPP (AgroSense MVC)"
            ], JSON_PRETTY_PRINT);
            exit;
        }

        // Ruta por defecto
        if ($path === '/') {
            echo "Bienvenido a la API de AgroSense. Probá /health";
            exit;
        }

        // Si no existe la ruta
        http_response_code(404);
        echo "404 - Ruta no encontrada: " . $path;
    }
}