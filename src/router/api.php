<?php

use App\Controllers\UserController;
use App\Foundation\Requestable;
use App\Foundation\Responeable;

$router["user/index"] = [UserController::class, "index"];
$router["api"] = $router;
