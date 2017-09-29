<?php
namespace App\Classes;

use DB;
use App\Models\Article;
use App\Models\ArticleVisitor;
use App\Models\ArticleVisitorPerDay;
use App\Models\ArticleVisitorDetail;

class AuditVisitorArticle {
    
    /**
     * Article instance
     *
     * @var \App\Models\Article
     */
    protected $article;

    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Initialize aticle instance
     *
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
        $this->request = app('request');
        $this->store();
    } 

    /**
     * Save visitor
     *
     * @return void
     */
    public function store()
    {
        DB::beginTransaction();
        try {
            $visitor = $this->toVisitor();
            $visitorPerDay = $this->toVisitorPerDay($visitor);
            $this->toVisitorDetail($visitorPerDay);
            DB::commit();
        } catch (\Exception $e) {
            info($e->getMessage());
            DB::rollback();
        }
    }

    /**
     * Save to visitor table
     *
     * @return void
     */
    public function toVisitor()
    {
        $visitor = ArticleVisitor::firstOrNew(['article_id' => $this->article->id]);
        $visitor->total += 1;
        $visitor->save();
        return $visitor;
    }

    /**
     * Save to visitor per day table
     *
     * @param Visitor $visitor
     * @return void
     */
    public function toVisitorPerDay(ArticleVisitor $visitor)
    {
        $visitorPerDay = ArticleVisitorPerDay::firstOrNew([
            'article_visitor_id' => $visitor->id, 
            'date' => \Carbon\Carbon::now()->toDateString()
        ]);
        $visitorPerDay->total += 1;
        $visitorPerDay->save();
        return $visitorPerDay;
    }

    /**
     * Save to visitor detail table
     *
     * @param VisitorPerDay $visitorPerDay
     * @return void
     */
    public function toVisitorDetail(ArticleVisitorPerDay $visitorPerDay)
    {
        ArticleVisitorDetail::create([
            'article_visitor_per_day_id' => $visitorPerDay->id,
            'ip_address' => $this->request->ip(),
            'page' => $this->request->fullUrl(),
            'browser' => (new \Jenssegers\Agent\Agent())->browser()
        ]);
    }
}