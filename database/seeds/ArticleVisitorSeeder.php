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

        for ($i = 0; $i < 99; $i++) {
            $article = App\Models\Article::whereNotIn('id', App\Models\Visitor::pluck('article_id')
                ->toArray())
                ->first();
            $visitor = App\Models\Visitor::create([
                'article_id' => $article->id,
                'total' => $this->faker->randomNumber
            ]);
            $randomLength = rand(1, 50);
            for ($i = 0; $i < $randomLength; $i++) {
                $visitorPerDay = App\Models\VisitorPerDay::create([
                    'visitor_id' => $visitor->id,
                    'total' => $this->faker->randomNumber
                ]);

                $randomLength = rand(1, 50);
                for ($i = 0; $i < $randomLength; $i++) {
                    App\Models\VisitorDetail::create([
                        'visitor_per_day_id' => $visitorPerDay->id,
                        'ip_address' => $this->faker->ipv4,
                        'page' => App\Models\Article::orderByRaw('RAND()')->first()->slug,
                        'browser' => 'chrome'
                    ]);
                }
            }
        }

    }
}
