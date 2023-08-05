<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        if (! Admin::query()->exists()) {
            Admin::factory()->create([
                'name' => 'haibin',
                'email' => '756152823@qq.com',
            ]);
        }

    }
}
