<?php

use Illuminate\Database\Seeder;
use Faker\Generator;

class ArticleVisitorSeeder extends Seeder
{

    /**
     * Faker Instance
     * @var Generator
     */
    protected $faker;
    /**
     * Init faker generator
     * ArticleVisitorSeeder constructor.
     * @param Generator $faker
     */
    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lengthArticle = App\Models\Article::count();
        for ($i = 0; $i < $lengthArticle; $i++) {
            $article = App\Models\Article::whereNotIn('id', App\Models\ArticleVisitor::pluck('article_id')
                ->toArray())
                ->first();
            $visitor = App\Models\ArticleVisitor::create([
                'article_id' => $article->id,
                'total' => $this->faker->randomNumber
            ]);
            $randomLength = rand(1, 50);
            for ($j = 0; $j < $randomLength; $j++) {
                $visitorPerDay = App\Models\ArticleVisitorPerDay::create([
                    'article_visitor_id' => $visitor->id,
                    'date' => new DateTime(),
                    'total' => $this->faker->randomNumber
                ]);

                $randomLength = rand(1, 50);
                for ($k = 0; $k < $randomLength; $k++) {
                    App\Models\ArticleVisitorDetail::create([
                        'article_visitor_per_day_id' => $visitorPerDay->id,
                        'ip_address' => $this->faker->ipv4,
                        'page' => App\Models\Article::orderByRaw('RAND()')->first()->slug,
                        'browser' => 'chrome'
                    ]);
                }
            }
        }

    }
}
