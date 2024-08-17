<?php

namespace App\Controllers;

use App\DI\Container;
use App\DI\Containerable;
use App\Foundation\Http;
use App\Foundation\Requestable;
use App\Foundation\Responeable;
use App\Repository\UserableRepository;

class UserController extends BaseController
{
    private ?Container $container;

    private ?UserableRepository $repository;

    public function __construct(Containerable $container)
    {
        $this->container = $container;
        $this->repository = $this->container->repository(UserableRepository::class);
    }

    public function index(Requestable $request, Responeable $respone)
    {
        $users = $this->repository->findAll();

        return $respone->status(Http::OK)->message("success")->data($users)->toJSON();
    }

    public function welcome(Requestable $request, Responeable $respone)
    {
        return $this->view("welcome.php", [
            'title' => "Hello, Welcome!",
            'content' => "Thank you for visiting our website. We hope you enjoy our content and have the best experience on our site."
        ]);
    }
}
