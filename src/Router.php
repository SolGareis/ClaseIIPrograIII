<?php
declare(strict_types=1);

class Router {
    public function run() {
        // --- COMIENZO CÓDIGO DEL PROFESOR ---
        
        // Método HTTP
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        // URI pedida
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';

        // Quitar query string
        $path = (string)parse_url($requestUri, PHP_URL_PATH);

        // Normalizar posibles bases
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $scriptDir  = str_replace('\\', '/', dirname($scriptName)); // ej: /prog3-clase2/public

        // Si la URL contiene el directorio del script, lo quitamos
        if ($scriptDir !== '/' && strpos($path, $scriptDir) === 0) {
            $path = substr($path, strlen($scriptDir));
        } else {
            // fallback: quitar /public si aparece
            $path = preg_replace('#^/public#', '', $path);
        }

        // asegurar formato
        $path = '/' . ltrim((string)$path, '/');
        if ($path === '//') {
            $path = '/';
        }

        // Ruta de prueba
        if ($method === 'GET' && $path === '/health') {
            header('Content-Type: application/json; charset=utf-8');
            http_response_code(200);

            echo json_encode([
                'status'      => 'ok',
                'timestamp'   => date('Y-m-d H:i:s'),
                'php_version' => phpversion(),
                'server'      => $_SERVER['SERVER_SOFTWARE'] ?? 'Apache'
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

            exit;
        }

        // Ruta base opcional
        if ($path === '/' || $path === '') {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);

         echo json_encode([
            'message' => 'Bienvenido a la API de AgroSense.',
            'status'  => 'online',
            'endpoints' => [
                'health' => '/health'
             ]
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            exit;
        }

        // No encontrada
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(404);
        echo json_encode([
            'error' => 'Not Found',
            'path'  => $path
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        // --- FIN CÓDIGO DEL PROFESOR ---
    }
}