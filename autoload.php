<?php

spl_autoload_register(function ($class) {
    
    $filePath = "./vendor/$class.php";
    $filePath = str_replace("\\", "/", $filePath);

    if (file_exists($filePath)) {
        include_once $filePath;
    } else {
        return false;
    }

});

include "config.php";
