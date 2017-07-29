<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Indicator success proses
     */
    CONST SUCCESS = 'success';

    /**
     * Indicator error proses
     */
    CONST ERROR = 'error';

    /**
     * Set breadcrumbs name
     * @return void
     */
    public function breadcrumb($childPath = [])
    {
        $path = $this->setObjectPath('dashboard', 'admin.dashboard', 'fa-dashboard', true);

        if (count($childPath) > 0) {
            $path['active'] = false;
        }

        $path = collect([$path]);
        $path = $path->merge($childPath);
        view()->share('breadcrumbs', $path->toArray());
    }

    /**
     * set object path link
     * @param string  $name
     * @param string  $link
     * @param string  $icon
     * @param boolean $active
     */
    public function setObjectPath($name, $link, $icon, $active = false)
    {
        return ['name' => $name, 'link' => $link, 'icon' => $icon, 'active' => $active];
    }


    /**
     * Build notification
     * @param string $type
     * @param string $message
     */
    public function setNotification($type, $message)
    {
        session()->flash('notification.type', $type);
        session()->flash('notification.message', $message);
    }

    /**
     * Redirect to route
     * @param  string $name
     * @return \Illuminate\Http\Response
     */
    public function toRoute($name)
    {
        return redirect()->route($name);
    }

    /**
     * Get errors exception proses
     * @param  \Exception $e
     * @return string
     */
    public function errorException(\Exception $e)
    {
        if (env('APP_DEBUG')) {
            $errorMessage = $e->getMessage().' - '.$e->getLine().' - '.$e->getFile();
            \Log::error($errorMessage);
        } else {
            $errorMessage = trans('error.500');
        }

        return $errorMessage;
    }

    /**
     * @param  Closure $callback
     * @param  integer $minutes
     * @param  string $key
     * @return \Illuminate\Support\Cache
     */
    public function toCache($callback, $minutes = 5, $key = '')
    {
        return \Cache::remember($key ? $key : request()->fullUrl(), $minutes, $callback);
    }

    /**
     * Get current name route and share to view
     * @return void
     */
    public function getAndShareToViewCurrentRoute()
    {
        if (request()->route()) {
            view()->share('current_route', request()->route()->getName());
        }
    }

    /**
     * Get list category
     * @return void
     */
    public function getAndShareToViewCategory()
    {
        $categories = $this->toCache(function() {
            return \App\Models\Category::select('name', 'slug')->orderBy('id', 'desc')
                                       ->limit(7)
                                       ->get();
        }, 5, 'categories');

        view()->share('categories', $categories);
    }

    /**
     * Generate response json
     * @param  array  $data
     * @param  integer $status
     * @return \Illuminate\Http\Response
     */
    public function jsonResponse($data, $status = 200)
    {
        return response()->json($data, 200);
    }

    /**
     * Set Seo for page
     * @param  array  $article
     * @return void
     */
    public function buildSEO($article = [])
    {

        \SEOMeta::setTitle($article->title);
        \SEOMeta::setDescription(strip_tags($article->content));
        \SEOMeta::addMeta('article:published_time', $article->created_at->toW3CString(), 'property');
        \SEOMeta::addMeta('article:section', $article->category->name, 'property');
        \SEOMeta::addKeyword($article->label);

        \OpenGraph::setDescription(strip_tags($article->content));
        \OpenGraph::setTitle($article->title);
        \OpenGraph::setUrl(request()->fullUrl());
        \OpenGraph::addProperty('type', 'article');
        \OpenGraph::addProperty('locale', 'en-id');
        \OpenGraph::addProperty('locale:alternate', ['en-us']);

        \OpenGraph::addImage(url('/') . '/storage/article-images/640x480/' .  $article->image);

        \OpenGraph::setTitle('Article')
            ->setDescription(strip_tags($article->content))
            ->setType('article')
            ->setArticle([
                'published_time' => $article->created_at->toW3CString(),
                'modified_time' => $article->updated_at->toW3CString(),
                'author' => $article->user->name,
                'section' => $article->category->name,
                'tag' => $article->label
            ]);
    }

    /**
     * Store artice category
     * @param  string $slug
     * @return void
     */
    public function activeCategory($slug)
    {
        view()->share('active_category', $slug);
    }
}
