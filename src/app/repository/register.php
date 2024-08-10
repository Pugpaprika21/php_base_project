<?php

use App\Repository\UserableRepository;
use App\Repository\UserRepository;

return [
    UserableRepository::class => new UserRepository(),
];