<?php

namespace App\Foundation;

interface Requestable
{
    /**
     * @param string $method
     * @return array
     */
    public function body(string $method = "post"): array;

    /**
     * @return array
     */
    public function any(): array;

    /**
     * @return array
     */
    public function ajax();

     /**
     * @param string $method
     * @return void
     */
    public function allow($method);
}
