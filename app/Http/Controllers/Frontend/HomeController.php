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
     * Get current route name
     */
    public function __construct()
    {
        $this->getAndShareToViewCurrentRoute();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->toCache(function () {
            return Article::orderBy('id', 'asc')->limit(20)->get();
        }, 5);
        return view(static::PATH_VIEW.'index', compact('articles'));
    }
}
