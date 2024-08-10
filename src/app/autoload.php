<?php

spl_autoload_register(function ($className) {
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
});

include_once "app/constant/vars.php";
include_once "config/container.php";
include_once "db/rb_connect.php";
