<?php

use App\Controllers\UserController;
use App\Foundation\Requestable;
use App\Foundation\Responeable;

$router["user/welcome"] = [UserController::class, "welcome"];
$router["web"] = $router;
