<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        Category::query()->delete();

        Category::query()->create([
            'parent_id' => 0,
            'name' => '默认',
            'flag' => 'default',
            'keywords' => 'default',
            'description' => 'default',
            'sort' => 1,
            'created_at' => '2023-07-28 00:00:00',
            'updated_at' => '2023-07-28 00:00:00',
        ]);

    }
}
