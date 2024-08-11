<?php

namespace App\DI;

use App\DI\Containerable;
use Exception;

class Container implements Containerable
{
    /**
     * @var array
     */
    private $building = [];

    /** 
     * @param string $container
     * @param callable $fn
     * @return void
     */
    public function set($container, $fn)
    {
        $this->building[$container] = $fn->bindTo($this, $this);
    }

    /**
     * @param string $container
     * @return mixed
     */
    public function get($container)
    {
        if (isset($this->building[$container])) {
            return ($this->building[$container])();
        }
        throw new Exception("container not found: {$container}");
    }

    /**
     * @param string $interface
     * @return object
     */
    public function repository($interface)
    {
        if (interface_exists($interface) && strpos($interface, "Repository") !== false) {
            if (!empty($this->building["repository"])) {
                return $this->building["repository"]()[$interface];
            }
            throw new Exception("repository not found: {$interface}");
        }

        throw new Exception("invalid interface or missing 'Repository' keyword: {$interface}");
    }
}
