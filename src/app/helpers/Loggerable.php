<?php

namespace App\Helpers;

interface Loggerable
{
    /**
     * @param string $content
     * @return void
     */
    public function log($content);

    /**
     * @param array|object $request
     * @return void
     */
    public function logRequest($request);
    
    /**
     * @param array|object $request
     * @return void
     */
    public function logRespone($respone);
}
