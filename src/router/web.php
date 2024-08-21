<?php

use App\Controllers\UserController;
use App\Foundation\Requestable;
use App\Foundation\Responeable;

$router["web"] = [
    "user/welcome" => [UserController::class, "welcome"]
];
