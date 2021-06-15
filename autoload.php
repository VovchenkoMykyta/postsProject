<?php

spl_autoload_register(function ($class) {
  $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
  $filePath = "./vendor/$class.php";
  if ( file_exists($filePath) ) {
    include_once $filePath;
  } else {
    return false;
  }
});
    