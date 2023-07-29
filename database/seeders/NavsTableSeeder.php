<?php

namespace Database\Seeders;

use App\Models\Nav;
use Illuminate\Database\Seeder;

class NavsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        Nav::query()->delete();

        $navs = [

            0 => [
                'type' => 4,
                'parent_id' => 0,
                'name' => '首页',
                'url' => '/',
                'sort' => 1,
                'status' => 1,
                'created_at' => '2018-08-11 09:18:28',
                'updated_at' => '2018-08-11 09:19:09',
            ],

            1 => [
                'type' => 1,
                'parent_id' => 0,
                'name' => '我的栏目',
                'url' => null,
                'sort' => 2,
                'status' => 1,
                'created_at' => '2023-07-28 21:06:06',
                'updated_at' => '2018-08-11 09:18:39',
            ],

            2 => [
                'type' => 2,
                'parent_id' => 0,
                'name' => '文章归档',
                'url' => null,
                'sort' => 3,
                'status' => 1,
                'created_at' => '2023-07-28 22:57:46',
                'updated_at' => '2023-07-28 23:30:35',
            ],
            3 => [
                'type' => 3,
                'parent_id' => 0,
                'name' => '母婴系统',
                'url' => 'https://mm.zhonghaibin.com',
                'sort' => 4,
                'status' => 1,
                'created_at' => '2023-07-28 21:05:52',
                'updated_at' => '2023-07-28 22:53:31',
            ],
            4 => [
                'type' => 3,
                'parent_id' => 0,
                'name' => 'My GitHub',
                'url' => 'https://github.com/zhonghaibin',
                'sort' => 5,
                'status' => 1,
                'created_at' => '2023-07-28 21:05:52',
                'updated_at' => '2023-07-28 22:53:31',
            ],
        ];

        foreach ($navs as $nav) {
            Nav::query()->create($nav);
        }

    }
}
