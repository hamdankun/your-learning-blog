<?php
namespace App\Classes;

use Carbon\Carbon;
use App\Models\SeoConfigArticle as SEOArticle;

trait Seo {

    public function setUpSEO($properties, $articleId) {
        $seoPropertiesData = [];
        foreach ($properties['type'] as $key => $type) {
            $seoPropertiesData[$key]['article_id'] = $articleId;
            $seoPropertiesData[$key]['category'] = $properties['category'][$key];
            $seoPropertiesData[$key]['type'] = $type;
            $seoPropertiesData[$key]['description'] = $properties['value'][$key];
            $seoPropertiesData[$key]['created_at'] = Carbon::now();
            $seoPropertiesData[$key]['updated_at'] = Carbon::now();
        }

        SEOArticle::insert($seoPropertiesData);
    }
}