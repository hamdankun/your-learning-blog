<?php

namespace App\Http\Controllers;

use App\Classes\Seo;
use OpenGraph;
use Twitter;
use SEOMeta;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Seo;

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
     * @param string $name
     * @param string $link
     * @param string $icon
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
            $errorMessage = $e->getMessage() . ' - ' . $e->getLine() . ' - ' . $e->getFile();
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
        $categories = $this->toCache(function () {
            return \App\Models\Category::select('name', 'slug')->orderBy('id', 'desc')
                ->limit(7)
                ->get();
        }, 5, 'categories');

        view()->share('categories', $categories);
    }

    /**
     * Generate response json
     * @param  array $data
     * @param  integer $status
     * @return \Illuminate\Http\Response
     */
    public function jsonResponse($data, $status = 200)
    {
        return response()->json($data, 200);
    }

    /**
     * Set Seo for page
     * @param  \App\Models\Article $article
     * @return void
     */
    public function buildSEO($article = [])
    {
        $seoProperties = $this->toCache(function () use ($article) {
            return $article->SEO;
        }, 5, 'seo-' . request()->fullUrl());
        $googlePlusAttributes = $seoProperties->where('attribute_key', 'itemprop');
        $openGraphAttributes = $seoProperties->where('prefix', 'og');
        $twitterAttributes = $seoProperties->where('prefix', 'twitter');
        $articleAttributes = $seoProperties->where('prefix', 'article');
        $generalAttributes = $seoProperties->where('prefix', null)->where('attribute_key', '!=', 'itemprop');
        SEOMeta::setTitle($article->title);

        if (!count($seoProperties)) {
            $this->SEOByDefault($article);
        } else {
            $concat = [
                0 => $generalAttributes,
                1 => $googlePlusAttributes,
                2 => $openGraphAttributes,
                3 => $twitterAttributes,
                4 => $articleAttributes
            ];
            $this->SEOByProperty($article, $concat);

        }
    }

    /**
     * Build Seo by current properties
     * @param \App\Models\Article $article
     */
    public function SEOByDefault($article)
    {
        $description = strip_tags(str_limit($article->description, 200));
        SEOMeta::setDescription($description);
        SEOMeta::addMeta('article:published_time', $article->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $article->category->name, 'property');
        SEOMeta::addKeyword($article->label);
        OpenGraph::setDescription($description);
        OpenGraph::setTitle($article->title);
        OpenGraph::setUrl(request()->fullUrl());
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'en-id');
        OpenGraph::addProperty('locale:alternate', ['en-us']);

        $relatedUrl = url('/') . '/storage/article-images/640x480/' . $article->image;

        if (!\Storage::exists('public/article-images/640x480/' . $article->image)) {
            $relatedUrl = url('/') . '/storage/article-images/default.png';
        }


        OpenGraph::addImage($relatedUrl);
        OpenGraph::setTitle($article->title)
            ->setDescription($description)
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
     * Build SEO By properties which already set up
     * @param \App\Models\Article $article
     * @param array $concat
     */
    public function SEOByProperty($article, $concat)
    {


        foreach ($concat as $key => $concatValue) {
            foreach ($concatValue as $key => $property) {

                if ($property->attribute_value === 'description' && $property->attribute_key !== 'itemprop') {

                    if (!$property->prefix) {
                        SEOMeta::setDescription($property->content);
                    } else if ($property->prefix === 'og') {
                        OpenGraph::setDescription($property->content);
                    } else if ($property->prefix === 'twitter') {
                        Twitter::setDescription($property->content);
                    }

                } else {
                    SEOMeta::addMeta(($property->prefix ? $property->prefix . ':' : '') . $property->attribute_value, $property->content, $property->attribute_key);
                }

            }
        }

        $relatedUrl = url('/') . '/storage/article-images/640x480/' . $article->image;

        if (!\Storage::exists('public/article-images/640x480/' . $article->image)) {
            $relatedUrl = url('/') . '/storage/article-images/default.png';
        }

        SEOMeta::addMeta('image', $relatedUrl, 'itemprop');
        Twitter::setSite(env('DEFAULT_SITE_TWITTER'));
        SEOMeta::addMeta('twitter:creator', env('DEFAULT_SITE_TWITTER'), 'name');
        Twitter::setImage($relatedUrl);
        OpenGraph::addProperty('locale', 'en-us');
        OpenGraph::addProperty('locale:alternate', ['en-us']);
        OpenGraph::setUrl(request()->fullUrl());
        OpenGraph::addImage($relatedUrl);
        SEOMeta::addMeta('article:published_time', $article->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:modified_time', $article->updated_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:author', $article->user->name, 'property');
        SEOMeta::addMeta('article:tag', '' . implode(',', $article->label) . '', 'property');
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
