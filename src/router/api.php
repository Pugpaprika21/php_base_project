<?php

use App\Controllers\UserController;
use App\Foundation\Requestable;
use App\Foundation\Responeable;

$router["api"] = [
    "user/index" => [UserController::class, "index"]
];
