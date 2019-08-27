<?php

/*
 * This file is part of the thans/layui-admin.
 *
 * (c) Thans <thans@thans.cn>
 *
 * This source file is subject to the Apache2.0 license that is bundled.
 */

namespace Kuiba\kuibaAdmin\facade;

use think\Facade;

class AdminsAuth extends Facade
{
    protected static function getFacadeClass()
    {
        return 'Kuiba\kuibaAdmin\AdminsAuth';
    }
}