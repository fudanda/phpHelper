<?php

namespace Kuiba\kuibaAdmin;

class Facade
{
    public function __construct()
    {
        //
    }

    public static function getInstance($classname, $args)
    {
        return new $classname($args);
    }

    public static function getFacadeAccessor()
    {
        //
    }

    public static function __callstatic($method, $arg)
    {
        $instance = static::getInstance(static::getFacadeAccessor(), [1, 2, 3]);
        return call_user_func_array(array($instance, $method), $arg);
    }
}