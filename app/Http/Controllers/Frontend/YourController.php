<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class YourController extends Controller
{
    /**
     * The path view layout
     */
    CONST PATH_VIEW = 'frontend.pages.your.';

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
        $this->buildSeoStaticPage('home', 'Ngulikers Programing');
        $this->audit();
        return view(static::PATH_VIEW . 'index', compact('articles'));
    }

    /**
     * Display about us page
     * @return \Illuminate\Http\Response
     */
    public function aboutUs()
    {
        $this->activeCategory('about-us');
        $this->buildSeoStaticPage('about-us');
        $this->audit();
        return view(static::PATH_VIEW . 'about-us');
    }

    /**
     * Display site map page
     *
     * @return \Illuminate\Http\Response
     */
    public function siteMap()
    {
        $this->buildSeoStaticPage('site-map', 'Site Map');
        $this->audit();
        return view(static::PATH_VIEW . 'site-map');
    }

    /**
     * Display privacy policy page
     *
     * @return void
     */
    public function privacyPolicy()
    {
        $this->buildSeoStaticPage('privacy-police', 'Privacy Policy');
        $this->audit();        
        return view(static::PATH_VIEW . 'privacy-policy');
    }

    /**
     * Display contact us page
     *
     * @return void
     */
    public function contactUs()
    {
        $this->buildSeoStaticPage('contact-us', 'Contact Us');
        $this->audit();        
        return view(static::PATH_VIEW . 'contact-us');
    }

    public function postContactUs()
    {
        $this->setNotification('success', 'Pesan Berhasil Dikirim, Terima Kasih');
        return redirect()->back();
    }   

    /**
     * Audit visitor
     *
     * @return void
     */
    private function audit()
    {
        (new \App\Classes\AuditVisitor());        
    }
}
