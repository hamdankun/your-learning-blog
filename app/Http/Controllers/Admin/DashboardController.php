<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display Dashboard page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->breadcrumb();
        return view('admin.pages.dashboard');
    }
}
