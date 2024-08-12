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
        $body = $request->body();

        $users = $this->repository->findAll();

        $respone->status(Http::OK)->message("success")->data($users)->toJSON();
    }

    public function doPost(Requestable $request, Responeable $respone)
    {
        $body = $request->ajax();

        $respone->status(Http::OK)->message("success")->data($body)->toJSON();
    }

    public function home(Requestable $request, Responeable $respone)
    {
        return $this->view("content.php", ["name" => "alex"]);
    }
}
