<?php

use App\Controllers\UserController;

$router["user/welcome"] = [UserController::class, "welcome"];

$router["user/index"] = function () {
    return "index";
};

$router["web"] = $router;
