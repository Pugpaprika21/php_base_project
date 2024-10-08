<?php

namespace App\Foundation;

interface Responeable
{
    /**
     * @param integer $status
     * @return Responeable
     */
    public function status(int $status = Http::OK): Responeable;

    /**
     * @param string $msg
     * @return Responeable
     */
    public function message(string $msg): Responeable;

    /**
     * @param array|object $data
     * @return Responeable
     */
    public function data(array|object $data): Responeable;

    /**
     * @return string|false
     */
    public function toJSON();

    /**
     * @param string $path
     * @param array $data
     * @return string
     */
    public function view($path, $data = []);

    /**
     * @param array $headers
     * @return void
     */
    public function headers(array $headers): Responeable;
}
