<?php

namespace App\Http\Controllers\Admin;

use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Models\VisitorDetail;
use App\Models\ArticleVisitor;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display Dashboard page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->breadcrumb();
        $visitor = new \stdClass();
        $visitor->today = Visitor::today()->sum('total');
        $visitor->yesterday = Visitor::yesterday()->sum('total');
        $visitor->prevMonth = Visitor::previousMonth()->sum('total');        
        $visitor->allOfTime = Visitor::allOfTime()->sum('total');
        $visitor->statisticChart = Visitor::fiveDayAgo()->get()->toJson();
        $visitor->donutChart = VisitorDetail::browserUsage('week')->get()->toJson();        
        $visitor->popularArticle = ArticleVisitor::popularArticle('week')->get();
        return view('admin.pages.dashboard', compact('visitor'));
    }
}
