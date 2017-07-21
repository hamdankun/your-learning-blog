<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Datatables;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{

    /**
     * The path view layout
     */
    CONST PATH_VIEW = 'admin.pages.category.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $this->breadcrumb(
            [$this->setObjectPath('category', 'admin.category.index', 'fa-table', true)]
        );
        return view(static::PATH_VIEW.'index');
    }

    /**
     * Get datatables data
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        return Datatables::of(Category::select('id', 'name', \DB::raw('\'action\' as action')))->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(static::PATH_VIEW.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            Category::create($request->only('name'));
            $this->setNotification('success', 'Category Has Been Created');
            $callback = $this->toRoute('admin.category.index');
        } catch (Exception $e) {
            $this->setNotification('error', $this->errorException($e));
            $callback = redirect()->back();
        }

        return $callback;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view(static::PATH_VIEW.'.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view(static::PATH_VIEW.'.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = Category::find($id);
            $category->update($request->only('name'));
            $this->setNotification('success', 'Category Has Been Updated');
            $callback = $this->toRoute('admin.category.index');
        } catch (Exception $e) {
            $this->setNotification('error', $this->errorException($e));
            $callback = redirect()->back();
        }

        return $callback;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Category::destroy($id);
            $message = 'Category has been deleted';
            $type = 'success';
        } catch (Exception $e) {
            $message = 'Fail to delete category';
            $type = 'error';
        }

        session()->flash('notification.message', $message);
        session()->flash('notification.type', $type);

        return redirect()->back();

    }
}
