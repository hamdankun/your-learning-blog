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
        $this->getAndShareToViewCategory();
    }

    /**
     * Show Article base on category
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {

        if ($slug == 'all') {
            $articles = $this->getAndStoreToCache();
        } else {
            $articles = $this->getByCategory($slug);
        }

        $this->activeCategory($slug);
        $q = request()->get('q');

        return view(static::PATH_VIEW.'index', compact('articles', 'q'));
    }

    /**
     * Show article base on slug
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slugCategory, $slugArticle)
    {
        $article = $this->article->whereSlug($slugArticle)->firstOrFail();
        $this->buildSEO($article);
        $this->activeCategory($slugCategory);
        return view(static::PATH_VIEW.'show', compact('article'));
    }

    /**
     * Get product by category
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function getByCategory($slug)
    {
        return $this->toCache(function() use ($slug) {
           return $this->article->getByCategory($slug)
                    ->findSimiliar(request()->get('q'))
                    ->paginate(20);
        });
    }

    /**
     * Handle ajax request
     * @param  string $slugCategory
     * @param  string $slugArticle
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return mixed
     */
    public function ajaxRequest($slugCategory = '', $slugArticle = '')
    {
        if (request()->ajax() || request()->wantsJson()) {

            if (($slugCategory === '' && $slugArticle === '') || $slugCategory === 'all') {
                $tableName = $this->article->getTable();
                $articles = $this->article
                            ->withCategory()
                            ->jsonPublicColumn()
                            ->takeSlugArticleAndCategory();
            } else {

                if ($slugCategory) {
                    $articles = $this->article->getByCategory($slugCategory);
                }

                if ($slugArticle) {
                    $articles = $article->whereSlug($this->article->getTable().'.slug', $slugArticle);
                }

                $articles = $articles->jsonPublicColumn()->takeSlugArticleAndCategory();

            }

            $articles = $articles->findSimiliar(request()->get('query'));

            $articles = $this->toCache(function() use($articles) {
                return $articles->paginate(20);
            });

            return $this->jsonResponse([
                'status' => 'success',
                'data' => $articles
            ]);
        }

        throw new \Symfony\Component\HttpKernel\Exception\HttpException(400, 'Invalid Request Exception', null, array(), 400);
    }

    /**
     * Autocomplete search article
     * @return \Illuminate\Http\Response
     */
    public function ajaxSearch()
    {
        $articles = $this->toCache(function() {
            return $this->article
                    ->select('title')
                    ->getByCategory(request()->get('category'))
                    ->findSimiliar(request()->get('query'))
                    ->limit(10)
                    ->pluck('title')
                    ->toArray();
        });

        return $this->jsonResponse([
                'suggestions' => $articles
            ]);
    }

    /**
     * Get articles and store to cache
     * @return \Illuminate\Support\Cache
     */
    public function getAndStoreToCache()
    {
        return $this->toCache(function () {
            return $this->article
                    ->publicColumn()
                    ->takeSlugArticleAndCategory()
                    ->withCategory()
                    ->findSimiliar(request()->get('q'))
                    ->orderBy('articles.id', 'desc')
                    ->paginate(20);
        }, 5);
    }
}
