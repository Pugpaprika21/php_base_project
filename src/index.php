<?php

declare(strict_types=1);

ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

include_once "utils/function.php";
include_once "app/autoload.php";

try {    
    $action = route_parse_urls();
    $route = $action["route"];
    $controller = APP_NAMESPACE . ucfirst($action["controller"])  . "Controller";
    $method = $action["method"];

    if (class_exists($controller) && method_exists($controller, $method)) {
        $controller = new $controller($container);
        $requests = $controller->requests();
        switch ($route) {
            case "web":
                header_xss();
                $controller->{$method}($requests);
                break;
            case "api":
                header_cors();
                $controller->{$method}($requests);
                break;
            default:
                throw new Exception("error processing (route not match)");
                break;
        }
    } else {
        throw new Exception("error processing (controller or method not found)");
    }
} catch (Exception $e) {
    http_response_code(500);
    die($e->getMessage());
}
