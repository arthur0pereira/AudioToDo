<?php
spl_autoload_register(function ($class) {
    $file = __DIR__ . "/../" . str_replace("\\", "/", $class) . ".php";
    // echo "<br>Testando: $file";
    if (file_exists($file)) {
        require_once $file;
        return;
    }
    // echo "<br>Classe não encontrada: $class";
});
