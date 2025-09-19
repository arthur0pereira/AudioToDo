<?php
namespace generic;

use controller\UsuarioController;
class AppController {

    public function handleRequest() {
        $requestUri = $_SERVER['REQUEST_URI'];
        $path = parse_url($requestUri, PHP_URL_PATH);
        
        $routes = [
            '/usuario/cadastro' => ['controller' => 'UsuarioController', 'method' => 'store'],
        ];
        
        if (array_key_exists($path, $routes)) {
            $route = $routes[$path];
            $controllerName = $route['controller'];
            $methodName = $route['method'];
            
            $controller = new $controllerName();
            $controller->$methodName();
            
        } else {
            http_response_code(404);
            echo "Página não encontrada!";
        }
    }
}