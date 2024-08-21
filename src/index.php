<?php

declare(strict_types=1);

use App\Foundation\Request;
use App\Foundation\Respone;
use App\Foundation\RouteParser;

$router = [];
require_once "utils/function.php";
require_once "app/autoload.php";
require_once "router/web.php";
require_once "router/api.php";

$action = RouteParser::parseUrl();
$route = $action["route"];
$path = $action["path"];

try {
    if (isset($router[$route][$path])) {
        $handler = $router[$route][$path];
        $request = new Request();
        $respone = new Respone();
        $content = "";

        if (is_callable($handler)) {
            $content = !empty($handler($request, $respone)) ? $handler($request, $respone) : "";
        } elseif (is_array($handler) && count($handler) === 2) {
            list($controllerName, $methodName) = $handler;
            $controller = new $controllerName($container);
            $content = $controller->$methodName($request, $respone);
        } else {
            throw new Exception("invalid route handler");
        }

        switch ($route) {
            case APP_TYPE_WEB:
                header_xss();
                require_once "views/web.php";
                break;
            case APP_TYPE_API:
                header_cors();
                echo $content;
                break;
            default:
                throw new Exception("route type not supported");
        }
    } else {
        throw new Exception("page not found");
    }
} catch (Exception $e) {
    http_response_code(500);
    echo $e->getMessage();
} finally {
    unset($router);
}
