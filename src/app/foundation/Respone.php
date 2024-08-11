<?php

namespace App\Foundation;

class ResponeMessage
{
    /**
     * @param integer $status
     * @param array|object $data
     */
    public function __construct(public int $status, public array|object $data)
    {
        $this->status = $status;
        $this->data = $data;
    }
}

class Respone extends Http implements Responeable
{
    /**
     * @var integer
     */
    private int $status = self::OK;

    /**
     * @var array|object
     */
    private array|object $data = [];

    /**
     * @param integer $status
     * @return Responeable
     */
    public function status(int $status = self::OK): Responeable
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param array|object $data
     * @return Responeable
     */
    public function data(array|object $data): Responeable
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return void
     */
    public function toJSON(): void
    {
        http_response_code($this->status);
        header("Content-Type: application/json; charset=utf-8");

        echo json_encode(new ResponeMessage($this->status, $this->data));
        exit;
    }
}
