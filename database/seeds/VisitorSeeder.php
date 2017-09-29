<?php

use App\Models\Visitor;
use App\Models\VisitorDetail;
use App\Models\ArticleVisitor;
use Illuminate\Database\Seeder;
use App\Models\ArticleVisitorPerDay;
use App\Models\ArticleVisitorDetail;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $visitors = [];

        Visitor::truncate();
        App\Models\VisitorDetail::truncate();
        ArticleVisitor::where('id', '<>', 0)->delete();
        ArticleVisitorDetail::where('id', '<>', 0)->delete();        
        ArticleVisitorPerDay::where('id', '<>', 0)->delete();

        // for($i = 0; $i < 10; $i++) {
        //     $visitors[] = [
        //         'date' => \Carbon\Carbon::now()->subMonth(rand(1, 12))->firstOfMonth()->addDays($i),
        //         'total' => rand(100, 1000),
        //         'created_at' => \Carbon\Carbon::now(),
        //         'updated_at' => \Carbon\Carbon::now()
        //     ];
        // }

        // Visitor::insert($visitors);
        
        // $visitorArticle = ArticleVisitor::get();
        // $visitorPerDay = [];
        // foreach($visitorArticle as $key => $value) {
        //     $visitorPerDay[] = [
        //         'article_visitor_id' => $value->id,
        //         'date' => \Carbon\Carbon::now()->subDays(($key + 1)),
        //         'total' => rand(100, 1000),
        //         'created_at' => \Carbon\Carbon::now(),
        //         'updated_at' => \Carbon\Carbon::now()
        //     ];
        // }
        // ArticleVisitorPerDay::insert($visitorPerDay);

        // foreach($this->pages() as $key => $page) {
        //     foreach(range(1, 100) as $key => $value) {
        //         $visitorDetail[] = [
        //             'page' => $page,
        //             'browser' => array('chrome', 'firefox', 'opera', 'safari')[rand(0, 3)],
        //             'ip_address' => array('192.10.20.1', '192.12.20.1', '192.10.20.10', '192.10.11.1')[rand(0, 3)],                    
        //             'date' => \Carbon\Carbon::now()->subDays(($key + 1)),
        //             'created_at' => \Carbon\Carbon::now(),
        //             'updated_at' => \Carbon\Carbon::now()
        //         ];
        //     }
        // }

        // App\Models\VisitorDetail::insert($visitorDetail);        
    }

    public function pages() {
        $data = [
            'http://ngulik.dev',
            'http://ngulik.dev/p/category/all?page=1',
            'http://ngulik.dev/site-map',
            'http://ngulik.dev/privacy-police',
            'http://ngulik.dev/contact-us',
            'http://ngulik.dev/about-us',
            'http://ngulik.dev/p/category/eddbb605-ce3b-338e-a713-411aa8d8543d/article/8e836f28-bf47-39a9-a278-7bebbd97429e',
            'http://ngulik.dev/p/category/76c4351e-0e21-3099-b8dc-4a80d751e521/article/4ab046b7-7e52-3f55-a52a-fdafe091cdcb',
            'http://ngulik.dev/p/category/2852a40d-dd67-324a-b9c6-031794a005ff/article/1adaddb9-7a17-3a89-8f60-a0aa2e214564',
            'http://ngulik.dev/p/category/7a615e47-5181-34b6-89f8-7c8244de5691/article/c7027285-42c8-32f0-bc55-dc55a7c8a228',
            'http://ngulik.dev/p/category/2852a40d-dd67-324a-b9c6-031794a005ff/article/1adaddb9-7a17-3a89-8f60-a0aa2e214564'
        ];
        return $data;
    }
}
