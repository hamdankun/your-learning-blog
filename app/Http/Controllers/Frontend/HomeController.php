<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{   
    /**
     * The path view layout
     */
    CONST PATH_VIEW = 'frontend.pages.home.';

    /**
     * The module name class
     */
    CONST MODULE_NAME = 'Article';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = \Cache::remember(request()->fullUrl(), 5, function () {
            return Article::orderBy('id', 'asc')->limit(20)->get(); 
        });
        return view(static::PATH_VIEW.'index', compact('articles'));
    }
}
