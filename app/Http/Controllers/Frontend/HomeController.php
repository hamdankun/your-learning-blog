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
     * The article instance
     * @var \App\Http\Controllers\Frontend\ArticleController
     */
    private $articleController;

    /**
     * Get current route name
     */
    public function __construct(ArticleController $articleController)
    {
        $this->getAndShareToViewCurrentRoute();
        $this->articleController = $articleController;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articleController->getAndStoreToCache();
        return view(static::PATH_VIEW.'index', compact('articles'));
    }
}
