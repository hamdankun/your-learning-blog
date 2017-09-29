<?php

namespace App\Http\Controllers\Admin;

use DB;
use Exception;
use Carbon\Carbon;
use App\Models\SeoStatic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SeoStaticContentRequest;

class SeoStaticContentController extends Controller
{
    /**
     * The path view layout
     */
    CONST PATH_VIEW = 'admin.pages.settings.seo-static-content.';


    /**
     * Display page seo content
     *
     * @return void
     */
    public function index()
    {
        $seo = $this->getSeo();
        return view(static::PATH_VIEW . 'index', ['seo' => $seo]);
    }

    /**
     * Get seo static page
     *
     * @return stdClass
     */
    private function getSeo()
    {
        $seo = new \stdClass();
        $seo->home = SeoStatic::home()->get();
        $seo->siteMap = SeoStatic::siteMap()->get();
        $seo->privacyPolice = SeoStatic::privacyPolice()->get();
        $seo->contactUs = SeoStatic::contactUs()->get();
        $seo->aboutUs = SeoStatic::aboutUs()->get();
        return $seo;
    }

    public function store(SeoStaticContentRequest $request) 
    {

        try {
            DB::beginTransaction();
            $this->storeToHome($request->home);
            $this->storeToSiteMap($request->site_map);
            $this->storeToPrivacyPolice($request->privacy_police);
            $this->storeToContactUs($request->contact_us);
            $this->storeToAboutUs($request->about_us);
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode()  ? $e->getCode() : 0);
        } 
        
        return response()->json($request->all());
    }

    private function storeToHome($home)
    {
        $this->storeAttribute(SeoStatic::HOME, $home);
    }

    private function storeToSiteMap($siteMap)
    {    
        $this->storeAttribute(SeoStatic::SITE_MAP, $siteMap);
    }

    private function storeToPrivacyPolice($privacyPolice)
    {
        $this->storeAttribute(SeoStatic::PRIVACY_POLICE, $privacyPolice);
    }

    private function storeToContactUs($contactUs)
    {
        $data = $this->storeAttribute(SeoStatic::CONTACT_US, $contactUs);
    }

    private function storeToAboutUs($about)
    {
        $data = $this->storeAttribute(SeoStatic::ABOUT, $about);
    }
    

    private function storeAttribute($type, $attributes)
    {
        $keyAttr = $attributes['attribute_key'];
        $nameAttr = $attributes['attribute_name'];                
        $contentAttr = $attributes['attribute_content'];
        $length = count($keyAttr);
        $data = [];
        $exclude = [];
        for($i = 0; $i < $length; $i++) {
            $seo = SeoStatic::firstOrNew([
                'type' => $type,
                'attribute_key' => $keyAttr[$i],
                'attribute_name' => $nameAttr[$i]
            ]);
            $seo->attribute_content = $contentAttr[$i];
            $seo->save();
            $exclude[] = $seo->id;
        }
        SeoStatic::deleteUnUsedAttribute($type, $exclude);
    }
}
