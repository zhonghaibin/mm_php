<?php

namespace App\Helpers\Extensions;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

/**
 * 登录用户助手函数
 * Class UserExt
 */
class UserExt
{
    /**
     * 获取登录用户
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|bool
     */
    public static function currentUser()
    {
        $uid = Auth::id() ?: null;
        if (! $uid) {
            return false;
        }

        return Admin::query()->find($uid);
    }

    /**
     * 获取登录用户某属性值
     *
     * @return mixed
     */
    public static function getAttribute($key)
    {
        $user = self::currentUser();

        return $user->getAttributeValue($key);
    }

    public static function logout()
    {
        Auth::logout();
    }

    public static function hasPermissionTo($permission)
    {
        $user = self::currentUser();

        return $user->hasPermissionTo($permission);

    }
}
