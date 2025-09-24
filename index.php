<?php
include "generic/Autoload.php";

$controller = $_GET['c'] ?? 'usuario';
$action = $_GET['a'] ?? 'form';

$controllerName = ucfirst($controller) . "Controller";
$controllerFile = "controller/{$controllerName}.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $fqcn = "Controller\\{$controllerName}";
    $obj = new $fqcn();
    if (method_exists($obj, $action)) {
        $obj->$action();
    } else {
        echo "Ação não encontrada!";
    }
} else {
    echo "Controller não encontrado!";
}

?>