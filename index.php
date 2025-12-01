<?php
require 'generic/Autoload.php';

use generic\Controller; 

$controller = new Controller();
// die("ROTA RECEBIDA: " . ($_GET['url'] ?? 'nada'));


if (isset($_GET["url"]) && $_GET["url"] !== "") {
    $controller->verificarChamadas($_GET["url"]);
} else {
    // rota padrão → chama o formulário via CONTROLLER, não arquivo físico
    header("Location: /usuario/form");
    exit;
}
