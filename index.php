<?php
require_once __DIR__ . '/generic/Autoload.php';

$c = $_GET['c'] ?? 'usuario';
$a = $_GET['a'] ?? 'form';

$controllerName = ucfirst($c) . "Controller";
$controllerNamespace = "Controller\\" . $controllerName;

if (class_exists($controllerNamespace)) {
    $controller = new $controllerNamespace();

    if (method_exists($controller, $a)) {
        $controller->$a();
    } else {
        echo "Ação não encontrada.";
    }
} else {
    echo "Controller não encontrado.";
}
