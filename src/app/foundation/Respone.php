<?php

namespace App\Foundation;

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
     * @var string
     */
    private string $message = "";

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
     * @param string $message
     * @return Responeable
     */
    public function message(string $message): Responeable
    {
        $this->message = $message;
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

        echo json_encode(ResponeMessage::create($this->status, $this->message, $this->data));
        exit;
    }

    /**
     * @param array $headers
     * @return void
     */

    /* 
    $respone->headers([
        "Access-Control-Allow-Credentials: true",
        "Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization",
        "Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS",
        "Cache-Control: no-store, no-cache, must-revalidate, max-age=0",
        "Pragma: no-cache",
        "X-Custom-Header: Value"
    ]);
    */

    public function headers(array $headers): Responeable
    {
        header_remove();

        foreach ($headers as $header) {
            header($header);
        }

        return $this;
    }
}
