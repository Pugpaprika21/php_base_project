<?php

try {
    include_once "constant/vars.php";
    include_once "utils/function.php";
    include_once "utils/autoload.php";
    include_once "config/container.php";
    include_once "db/rb_connect.php";

    $action = route_parse_urls();
    $route = $action["route"];
    $controller = APP_NAMESPACE . ucfirst($action["controller"])  . "Controller";
    $method = $action["method"];

    if (class_exists($controller) && method_exists($controller, $method)) {
        $controller = new $controller($container);
        switch ($route) {
            case "web":
                header_xss();
                $controller->{$method}();
                break;
            case "api":
                header_cors();
                $controller->{$method}();
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
