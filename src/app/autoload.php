<?php

ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

spl_autoload_register(function ($classname) {
    $app_config_paths = include "config/apppath.php";
    $class_parts = explode("\\", $classname);
    $class_filename = end($class_parts);
    foreach ($app_config_paths["app"] as $folder) {
        $class_filepath = $folder . $class_filename . ".php";
        if (file_exists($class_filepath)) {
            include_once $class_filepath;
            return;
        }
    }
});

require_once "app/constant/vars.php";
require_once "app/libs/rb.php";
require_once "db/rb_connect.php";
require_once "config/container.php";

