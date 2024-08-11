<?php

use App\DI\Container;

$container = new Container();

// ----------------------- config --------------------------- //

$container->set("config", function () {
    return [
        "db" => [
            "driver" => env("DB_DRIVER"),
            "host" => env("DB_HOST"),
            "dbname" => env("DB_NAME"),
            "user" => env("DB_USER"),
            "password" => env("DB_PASS"),
        ]
    ];
});

// ----------------------- pdo --------------------------- //

$container->set("pdo", function () {
    try {
        $config = $this->get("config");
        
        $pdo = new PDO("{$config["db"]["driver"]}:host={$config["db"]["host"]};dbname={$config["db"]["dbname"]}", $config["db"]["user"], $config["db"]["password"]);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch (PDOException $e) {
        die("connection failed: " . $e->getMessage());
    }
});

// ----------------------- repository --------------------------- //

$container->set("repository", function () { 
    return include "app/repository/register.php";
});