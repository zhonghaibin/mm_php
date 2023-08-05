<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        DB::table('configs')->delete();

        DB::table('configs')->insert([
            0 => [
                'id' => 1,
                'name' => 'site_status',
                'value' => '1',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            1 => [
                'id' => 2,
                'name' => 'site_close_word',
                'value' => '站点维护，临时关闭',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            2 => [
                'id' => 3,
                'name' => 'site_name',
                'value' => 'xxx',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            3 => [
                'id' => 4,
                'name' => 'site_title',
                'value' => 'xxx',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            4 => [
                'id' => 5,
                'name' => 'site_keywords',
                'value' => 'xx,xxx',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            5 => [
                'id' => 6,
                'name' => 'site_description',
                'value' => 'xxx',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            6 => [
                'id' => 7,
                'name' => 'site_icp_num',
                'value' => 'xxx',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            7 => [
                'id' => 8,
                'name' => 'site_admin',
                'value' => 'xxx',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            8 => [
                'id' => 9,
                'name' => 'site_admin_mail',
                'value' => '//mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=xxx',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            9 => [
                'id' => 10,
                'name' => 'site_admin_weibo',
                'value' => '//weibo.com/xxx',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            10 => [
                'id' => 11,
                'name' => 'site_admin_github',
                'value' => '//gitee.com/xxx',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            11 => [
                'id' => 12,
                'name' => 'site_admin_info',
                'value' => 'PHP ARTISAN.',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            12 => [
                'id' => 13,
                'name' => 'site_info',
                'value' => '本站发布的系统与软件仅为个人学习测试使用，请在下载后24小时内删除，不得用于任何商业用途，否则后果自负，请支持购买正版软件！如侵犯到您的权益,请及时通知我们,我们会及时处理。',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            13 => [
                'id' => 14,
                'name' => 'site_admin_avatar',
                'value' => '/images/avatar.png',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            14 => [
                'id' => 15,
                'name' => 'site_mailto_admin',
                'value' => 'xxx@qq.com',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            15 => [
                'id' => 16,
                'name' => 'site_110beian_num',
                'value' => 'xxxxx',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            16 => [
                'id' => 17,
                'name' => 'site_110beian_link',
                'value' => 'http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=xxx',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            17 => [
                'id' => 18,
                'name' => 'site_allow_comment',
                'value' => '1',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            18 => [
                'id' => 19,
                'name' => 'site_allow_message',
                'value' => '1',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            19 => [
                'id' => 20,
                'name' => 'site_allow_subscribe',
                'value' => '',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            20 => [
                'id' => 21,
                'name' => 'allow_reward',
                'value' => '0',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            21 => [
                'id' => 22,
                'name' => 'wepay',
                'value' => '1',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            22 => [
                'id' => 23,
                'name' => 'alipay',
                'value' => '',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
            23 => [
                'id' => 24,
                'name' => 'water_mark_status',
                'value' => '1',
                'created_at' => '2023-08-01 00:00:00',
                'updated_at' => '2023-08-01 00:00:00',
            ],
        ]);

    }
}
