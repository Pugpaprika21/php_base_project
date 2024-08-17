<?php

namespace App\Controllers;

abstract class BaseController
{
    /**
     * @return mixed
     */
    protected function ajaxRequest()
    {
        $request = file_get_contents("php://input");
        return json_decode($request, true);
    }

    /**
     * @param array|object $data
     * @param integer $statusCode
     * @return void
     */
    protected function toJSON($data, $statusCode = 200)
    {
        http_response_code($this->statusJSON($data, $statusCode));
        header("Content-Type: application/json; charset=utf-8");

        $data = ARR_UPPER_CASE ? arr_upr(["data" => $data]) : ["data" => $data];

        return json_encode($data);
    }

    /**
     * @param string $method
     * @return void
     */
    protected function allow($method)
    {
        if ($_SERVER["REQUEST_METHOD"] != strtoupper($method)) {
            http_response_code(405);
            echo "method not allowed : " . $method;
            exit;
        }
    }

    /**
     * @param string $path
     * @param array $data
     * @return string
     */
    protected function view($path, $data = [])
    {
        $realpath = "views/" . $path;

        extract($data);

        ob_start();
        require $realpath;
        $output = ob_get_clean();

        return $output;
    }

    /**
     * @param array|object $data
     * @param integer $statusCode
     * @return integer
     */
    private function statusJSON($data, $statusCode)
    {
        if (is_array($data) && array_key_exists("status", $data)) {
            return $data["status"];
        } elseif (is_object($data) && property_exists($data, "status")) {
            return $data->status;
        }

        return $statusCode;
    }
}
