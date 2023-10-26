<?php

spl_autoload_register(function ($class) {
    if(strpos($class, 'OS\\') !== false){
        $path = str_replace('\\', DIRECTORY_SEPARATOR , $class);
        $path = str_replace('OS', '', $path);
        require_once(
            dirname(__DIR__)
            . DIRECTORY_SEPARATOR
            .'ostheme/src'
            . $path
            . '.php');
    }
});
