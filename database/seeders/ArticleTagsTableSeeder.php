<?php

namespace Database\Seeders;

use App\Models\ArticleTag;
use Illuminate\Database\Seeder;

class ArticleTagsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        ArticleTag::query()->delete();
        ArticleTag::query()->create([
            'name' => '默认',
            'flag' => 'default',
            'created_at' => '2023-07-28 00:00:00',
            'updated_at' => '2023-07-28 00:00:00',
        ]);

    }
}
