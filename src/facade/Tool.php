<?php

namespace Kuiba\kuibaAdmin\facade;

use Kuiba\kuibaAdmin\Facade;

class Tool extends Facade
{
    public static function getFacadeAccessor()
    {
        return \Kuiba\kuibaAdmin\Tool::class;
    }
}