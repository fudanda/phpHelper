<?php

namespace Kuiba\kuibaAdmin\facade;

use think\Facade;

class Tool extends Facade
{
    protected static function getFacadeClass()
    {
        return 'Kuiba\kuibaAdmin\Tool';
    }
}