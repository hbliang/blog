<?php
/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 2017/2/10
 * Time: 下午10:22
 */

namespace App\Policies;


trait SuperAdminBeforeTrait
{
    public function before($user, $ability)
    {
        if ($user->isSuperAdmin) {
            return true;
        }
    }
}