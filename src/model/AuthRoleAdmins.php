<?php

namespace Kuiba\kuibaAdmin\model;

use think\model\Pivot;

class AuthRoleAdmins extends Pivot
{
    protected $name = 'auth_role_admins';
    protected $autoWriteTimestamp = true;
}
