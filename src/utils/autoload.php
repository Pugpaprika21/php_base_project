<?php

// -------------------------------------- load class ----------------------------------------- //

function app_class($className)
{
    $app_config_paths = include "config/apppath.php";
    $classParts = explode("\\", $className);
    $classFileName = end($classParts);
    foreach ($app_config_paths["app"] as $folder) {
        $classFilePath = $folder . $classFileName . ".php";
        if (file_exists($classFilePath)) {
            include_once $classFilePath;
            return;
        }
    }
}

spl_autoload_register("app_class");
