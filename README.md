-- how to run php project 

docker compose up

http://localhost:8000/?route=/web/helloworld/index
http://localhost:8000/?route=/api/user/index
http://localhost:5050 pgsql GUI

-- using container in controller

<?php

class HelloworldController extends BaseController
{
    private Container $container;

    public function __construct(Containerable $container)
    {
        $this->container = $container;
    }

    public function index()
    {
        $db = $this->container->get("db");

        $this->view("welcome.php", [
            "title" => "My Page Title",
            "content" => "This is the page content."
        ]);
    }
}