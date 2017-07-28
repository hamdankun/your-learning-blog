<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * The path view layout
     */
    CONST PATH_VIEW = 'frontend.pages.article.';

    /**
     * The module name class
     */
    CONST MODULE_NAME = 'Article';

    /**
     * Init Instance and config settings
     * @param \App\Models\Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
        $this->getAndShareToViewCurrentRoute();
    }

    /**
     * Show article base on slug
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = $this->article->whereSlug($slug)->firstOrFail();
        $this->buildSEO($article);
        return view(static::PATH_VIEW.'show', compact('article'));
    }

    public function showByCategory($slug)
    {
        $article = $this->article->getByCategory($slug)->get();
        return view(static::PATH_VIEW.'index', compact('article'));
    }

    public function ajaxRequest()
    {
        if (request()->ajax() || request()->wantsJson()) {

            $articles = $this->getAndStoreToCache();

            return $this->jsonResponse([
                'status' => 'success',
                'data' => $articles
            ]);
        }

        throw new \Symfony\Component\HttpKernel\Exception\HttpException(400, 'Invalid Request Exception', null, array(), 400);
    }

    public function getAndStoreToCache()
    {
        return $this->toCache(function () {
            return $this->article->orderBy('id', 'desc')->simplePaginate(20);
        }, 5);
    }
}
