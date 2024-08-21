<?php

namespace App\Foundation;

namespace App\Foundation;

class RouteParser
{
    private static $protocol;
    private static $host;
    private static $requestUri;
    private static $url;

    public static function init()
    {
        self::$protocol = (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off" || $_SERVER["SERVER_PORT"] == 443) ? "https://" : "http://";
        self::$host = $_SERVER["HTTP_HOST"];
        self::$requestUri = $_SERVER["REQUEST_URI"];
        self::$url = conText(self::$protocol . self::$host . self::$requestUri);
    }

    /**
     * @return array
     */
    public static function parseUrl()
    {
        self::init();

        $queryAction = parse_url(self::$url, PHP_URL_QUERY);
        $parts = explode("/", $queryAction);

        $route = isset($parts[1]) ? conText($parts[1]) : "";
        $controller = isset($parts[2]) ? conText($parts[2]) : "";
        $method = isset($parts[3]) ? conText($parts[3]) : "";
        $path = $controller . "/" . $method;

        return [
            "route" => $route,
            "controller" => $controller,
            "method" => $method,
            "path" => $path,
        ];
    }
}

