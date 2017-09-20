<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use function foo\func;
use Illuminate\Foundation\Testing\HttpException;
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
        $sortBy = request()->get('sortby');
        $this->buildSEOArticleIndex();
        return view(static::PATH_VIEW . 'index', compact('articles', 'q', 'sortBy'));
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
        $relatedArticle = $this->relatedArticle($article);
        $recentArticle = $this->recentArticle();
        $popularArticle = $this->popularArticle();
        (new \App\Classes\AuditVisitor($article));
        $labels = $this->label();
        return view(static::PATH_VIEW . 'show', compact('article', 'relatedArticle', 'recentArticle', 'labels', 'popularArticle'));
    }

    /**
     * Get popular Article
     * @return \Illuminate\Support\Cache
     */
    public function popularArticle()
    {
        return $this->toCache(function() {
            return $this->article->popular()->limit(env('POPULAR_ARTICLE_LIMIT'))->get();
        }, 5, 'popular-article');
    }

    /**
     * Get popular article
     * @return \Illuminate\Http\Response
     */
    public function ajaxPopularArticle()
    {
        if (request()->ajax() || \request()->wantsJson()) {
            return $this->jsonResponse([
                'status' => 'success',
                'data' => $this->popularArticle()
            ]) ;
        }

        throw new \Symfony\Component\HttpKernel\Exception\HttpException(400, 'Invalid Request Exception', null, array(), 400);
    }

    /**
     * Get recent label
     */
    public function label()
    {
        return $this->toCache(function() {
           return \App\Models\Label::select('name')
               ->orderBy('id', 'desc')
               ->limit(5)
               ->pluck('name');
        }, 5, 'label');
    }

    /**
     * Get recent article
     */
    public function recentArticle()
    {
        return $this->toCache(function () {
           return $this->article->recent()->get();
        }, 5, 'recent-article');
    }

    /**
     * Get related article next/prev
     * @param \App\Models\Article $article
     * @return \Illuminate\Support\Cache
     */
    public function relatedArticle($article)
    {
        return $this->toCache(function() use ($article) {
            $relatedArticle['next'] = $this->article->findNextData($article->id)->first();
            $relatedArticle['prev'] = $this->article->findPrevData($article->id)->first();
            return $relatedArticle;
        }, 5, 'related-article-' . request()->fullUrl());
    }

    /**
     * Get product by category
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function getByCategory($slug)
    {
        return $this->toCache(function () use ($slug) {
            return $this->article->getByCategory($slug)
                ->findSimiliar(request()->get('q'))
                ->paginate(env('FRONT_ARTICLE_PAGINATE'));
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
                    $articles = $article->whereSlug($this->article->getTable() . '.slug', $slugArticle);
                }

                $articles = $articles->jsonPublicColumn()->takeSlugArticleAndCategory();

            }

            $articles = $articles->findSimiliar(request()->get('query'));

            $sortByColumn = $this->defineSortBy();
            $articles = $articles->sortBy($sortByColumn);
            $articles = $this->toCache(function () use ($articles) {
                return $articles->paginate(env('FRONT_ARTICLE_PAGINATE'));
            });

            return $this->jsonResponse([
                'status' => 'success',
                'data' => $articles
            ]);
        }

        throw new \Symfony\Component\HttpKernel\Exception\HttpException(400, 'Invalid Request Exception', null, array(), 400);
    }

    private function defineSortBy()
    {
        $querySort = request()->get('sortby');
        $sortByList = [];
        $sortByList['popular'] = 'popular';
        $sortByList['recent'] = 'desc';
        $sortByList['old'] = 'asc';
        return !empty($sortByList[$querySort]) ? $sortByList[$querySort] : $sortByList['recent'];
    }

    /**
     * Autocomplete search article
     * @return \Illuminate\Http\Response
     */
    public function ajaxSearch()
    {
        $articles = $this->toCache(function () {
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
                ->paginate(env('FRONT_ARTICLE_PAGINATE'));
        }, 5);
    }

    public function buildSEOArticleIndex()
    {
        \SEOMeta::setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        \SEOMeta::addKeyword(['lorem ipsum', 'all', 'in', 'one']);
        \OpenGraph::setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        \OpenGraph::setTitle('All Article');
        \OpenGraph::setUrl(request()->fullUrl());
        \OpenGraph::addProperty('type', 'article');
        \OpenGraph::addProperty('locale', 'en-id');
        \OpenGraph::addProperty('locale:alternate', ['en-us']);
        \OpenGraph::addImage(url('/') . '/images/logo.png');
        \Twitter::setTitle('All Article');
        \Twitter::setSite('@yourlearning');

    }
}
