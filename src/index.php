<?php

declare(strict_types=1);

ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

$router = [];
require_once "utils/function.php";
require_once "app/autoload.php";
require_once "router/web.php";
require_once "router/api.php";

$action = route_parse_urls();

$route = $action["route"];
$path = $action["path"];

try {
    if (isset($router[$route][$path])) {
        $handler = $router[$route][$path];
        if (!is_null($handler)) {
            switch ($route) {
                case "web":
                    if (gettype($handler) == "object") {
                        $html = !empty($handler()) ? $handler() : "";
                    } else {
                        $controller = ucfirst($handler[0]);
                        $controller = new $controller($container);
                        $requests = $controller->requests();
                        $respones = $controller->respones();
                        $html = $controller->{$handler[1]}($requests, $respones);
                    }

                    header_xss();
                    require_once "views/web.php";
                    break;
                case "api":
                    /*  */
                    break;
                default:
                    throw new Exception("error processing (route not match)");
                    break;
            }
        }
    } else {
        throw new Exception("page not found..");
    }
} catch (Exception $e) {
    http_response_code(500);
    die($e->getMessage());
} finally {
    unset($router);
}


