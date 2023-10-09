<?php

spl_autoload_register(function ($class) {
    if(str_contains($class, 'OS\\')){
        $path = str_replace('\\', DIRECTORY_SEPARATOR , $class);
        $path = str_replace('OS', '', $path);
        require_once(
            get_template_directory()
            . DIRECTORY_SEPARATOR
            .'src'
            .DIRECTORY_SEPARATOR
            . $path
            . '.php');
    }
});
