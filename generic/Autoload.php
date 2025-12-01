<?php

spl_autoload_register(function ($classe) {

    $classe = str_replace("\\", "/", $classe); 
    $arquivo = __DIR__ . "/../" . $classe . ".php";

    if (file_exists($arquivo)) {
        require $arquivo;
    }
});
