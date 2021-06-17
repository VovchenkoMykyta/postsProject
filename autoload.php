<?php

spl_autoload_register(function ($class) {

    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    
    $filePath = "./vendor/$class";

    if (file_exists($filePath)) {
        include_once $filePath;
        return true;
    } else {
        return false;
    }
});

include "config.php";
