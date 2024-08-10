<?php

namespace App\Foundation;

interface RequestableHandler
{
    /**
     * @param string $method
     * @return array
     */
    public function body(string $method = "post"): array;
}
