<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    use HasUuids;

    const TYPE
        = [
            0 => '空菜单',
            1 => '分类菜单',
            2 => '归档',
            3 => '单页',
            4 => '外链',
        ];

    const TYPE_EMPTY = 0;    // 普通菜单 可添加单页 链接

    const TYPE_MENU = 1;     // 分类菜单（固定存在的）

    const TYPE_ARCHIVE = 2;  // 归档页面（固定存在的）

    const TYPE_PAGE = 3;     // 单页（url为单页链接）

    const TYPE_LINK = 4;     // 链接（直接添加链接）

    const STATUS_DISPLAY = 1;
}
