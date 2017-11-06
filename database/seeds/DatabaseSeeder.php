<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ArticleSeeder::class);
        // $this->call(SeoPropertySeeder::class);
        // $this->call(SeoStaticPageSeeder::class);
        // $this->call(ArticleVisitorSeeder::class);
    }
}
