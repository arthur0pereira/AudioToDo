<?php

namespace generic;

abstract class Controller
{
    protected function render($view, $data = [])
    {
        extract($data);
        require_once "public/{$view}.php";
    }

    protected function redirect($url)
    {
        header("Location: {$url}");
        exit;
    }
}
