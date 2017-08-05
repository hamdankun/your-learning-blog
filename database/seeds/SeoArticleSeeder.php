<?php

use App\Models\Article;
use App\Models\SeoArticle;
use Illuminate\Database\Seeder;


class SeoArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $article = Article::orderBy('id', 'asc')->first();
        SeoArticle::insert([
            [
                'article_id' => $article->id,
                'type' => 'meta',
                'attribute_key' => 'name',
                'attribute_value' => 'description',
                'content' => $article->description,
                'prefix' => ''
            ],
            [
                'article_id' => $article->id,
                'type' => 'meta',
                'attribute_key' => 'property',
                'attribute_value' => 'article',
                'content' => $article->description,
                'prefix' => ''
            ]
        ]);
    }
}
