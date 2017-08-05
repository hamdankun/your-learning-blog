<?php

namespace App\Http\Controllers\Admin;

use DB;
use Image;
use Storage;
use Datatables;
use App\Classes\Seo;
use App\Models\Label;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    use Seo;

    /**
     * The path view layout
     */
    CONST PATH_VIEW = 'admin.pages.article.';

    /**
     * The module name class
     */
    CONST MODULE_NAME = 'Article';

    /**
     * Prefix route name
     */
    CONST PREFIX_ROUTE_NAME = 'admin.article.';

    /**
     * Ref replacing name for transable language
     */
    CONST REPLACING_NAME = 'module';

    /**
     * Article Instance
     * @var \App\Models\Article
     */
    protected $article;


    /**
     * Init Instance
     * @param \App\Models\Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->breadcrumb(
            [$this->setObjectPath('article', static::PREFIX_ROUTE_NAME . 'index', 'fa-table', true)]
        );
        return view(static::PATH_VIEW . 'index');
    }

    /**
     * Get datatables data
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        return Datatables::of($this->article->select('id', 'title', \DB::raw('\'action\' as action')))->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->findAndSendToView(0, 'create');
    }


    public function store(ArticleRequest $request)
    {
        try {
            DB::beginTransaction();

            $article = $this->article->create($request->input());
            $this->uploadImageIfExist($article, $request);
            $this->setNotification('success', trans('general.create.success', [static::REPLACING_NAME => 'Article']));
            $callback = $this->toRoute(static::PREFIX_ROUTE_NAME . 'index');
            $this->setUpSEO($request->input('seo'), $article->id);
            $this->callEvent($request);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $this->setNotification('error', $this->errorException($e));
            $callback = redirect()->back();
        }

        return $callback;
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->findAndSendToView($id, 'create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->findAndSendToView($id, 'update');
    }

    /**
     * Find article and sent to view
     * @param  integer $id
     * @param  string $layout
     * @return \Illuminate\Http\Request
     */
    public function findAndSendToView($id, $layout)
    {
        $article = [];

        if ($layout === 'update') {
            $article = $this->article->find($id);
        }

        $categories = Category::pluck('name', 'id');
        $labels = \App\Models\Label::pluck('name');
        return view(static::PATH_VIEW . $layout, compact('article', 'categories', 'labels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        try {
            $article = $this->article->find($id);
            $article->update($request->except('id'));
            $this->uploadImageIfExist($article, $request);
            $this->setNotification('success', trans('general.created.success', [static::REPLACING_NAME => static::MODULE_NAME]));
            $callback = $this->toRoute(static::PREFIX_ROUTE_NAME . 'index');
            $this->callEvent($request);
        } catch (Exception $e) {
            $this->setNotification('error', $this->errorException($e));
            $callback = redirect()->back();
        }

        return $callback;
    }

    /**
     * Event when article created/updated
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    private function callEvent($request)
    {
        event(new \App\Events\ArticleCreatedOrUpdated($request->input('label')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->article->destroy($id);
            $message = trans('general.deleted.success', [static::REPLACING_NAME => static::MODULE_NAME]);
            $type = static::SUCCESS;
        } catch (Exception $e) {
            $message = trans('general.deleted.error', [static::REPLACING_NAME => static::MODULE_NAME]);
            $type = static::ERROR;
        }

        $this->setNotification($type, $message);
        return redirect()->back();
    }

    /**
     * Upload Imag article if exist
     *
     * @param [type] $article
     * @param Request $request
     * @return void
     */
    private function uploadImageIfExist($article, Request $request)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $extension = $request->image->extension();
            $name = $article->slug . '.' . $extension;
            $path = 'public/article-images';
            $currentOrigin = $path . '/origin/' . $article->image;
            $current640x480 = $path . '/640x480/' . $article->image;
            $current300x300 = $path . '/300x300/' . $article->image;

            if ($article->image) {
                if (Storage::exists($currentOrigin)) {
                    Storage::delete($currentOrigin);
                }

                if (Storage::exists($current640x480)) {
                    Storage::delete($current640x480);
                }

                if (Storage::exists($current300x300)) {
                    Storage::delete($current300x300);
                }
            }

            $request->image->storeAs('public/article-images/origin', $name);
            Image::make($request->file('image'))
                ->resize(640, 480)
                ->save(storage_path('app/public/article-images/640x480') . '/' . $name);
            Image::make($request->file('image'))
                ->fit(300, 300)
                ->save(storage_path('app/public/article-images/300x300') . '/' . $name);
            Image::make($request->file('image'))
                ->fit(100, 100)
                ->save(storage_path('app/public/article-images/100x100') . '/' . $name);
            $article->image = $name;
            $article->save();
        }
    }
}
