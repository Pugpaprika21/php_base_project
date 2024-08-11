<?php

namespace App\Foundation;

interface Requestable
{
    /**
     * @param string $method
     * @return array
     */
    public function body(string $method = "post"): array;
}
