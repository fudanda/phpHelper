<?php

namespace Kuiba\kuibaAdmin\facade;

use Kuiba\kuibaAdmin\Facade;

class Casbin extends Facade
{
    public static function getFacadeAccessor()
    {
        return \Kuiba\kuibaAdmin\Auth\Casbin::class;
    }
}