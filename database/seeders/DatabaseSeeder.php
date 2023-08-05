<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ArticleTagsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(NavsTableSeeder::class);
        $this->call(ConfigsTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $categorys = \App\Models\Category::factory(1)->create();
        foreach ($categorys as $category) {

            $articles = \App\Models\Article::factory(2)->create([
                'category_id' => $category->id,
            ]);
            $article_tags = \App\Models\ArticleTag::factory(3)->create();
            foreach ($articles as $article) {
                \App\Models\Feed::factory(1)->create([
                    'target_id' => $article->id,
                    'target_type' => 0,
                ]);
                foreach ($article_tags as $article_tag) {
                    \App\Models\ArticleTagRel::query()->insert([
                        'article_id' => $article->id,
                        'article_tag_id' => $article_tag->id,
                    ]);
                }
            }

        }

    }
}
