<?php

namespace App\Classes;

use SEOMeta;
use OpenGraph;
use Twitter;
use Carbon\Carbon;
use App\Models\SeoStatic;
use App\Models\SeoArticle as SEOArticle;
use Intervention\Image\Response;

trait Seo
{


    /**
     * Set up SEO property article
     * @param array $properties
     * @param integer $articleId
     */
    public function saveSEO($properties, $articleId, $insertMode = true)
    {
        $seoProperties = $this->moveToValue($properties, $articleId, $insertMode);
        if (count($seoProperties) > 0) {
            SEOArticle::insert($seoProperties);
        }
    }

    /**
     * Loop properties and put to value
     * @param  array $properties
     * @param  id $articleId
     * @return array
     */
    public function moveToValue($properties, $articleId, $insertMode)
    {
        $contents = $properties['content'];
        $attributeKeys = $properties['attribute_key'];
        $attributeValues = $properties['attribute_value'];
        $prefixs = $properties['prefix'];
        $categories = $properties['category'];
        $placeholders = $properties['placeholder'];
        $inputTypes = $properties['input_type'];
        $data = [];
        $exclude = [];
        foreach ($attributeKeys as $key => $attributeKey) {

            if (!empty($attributeKeys) && !empty($attributeValues[$key]) && !empty($contents[$key])) {
                if ($insertMode) {
                    $data[] = [
                        'article_id' => $articleId,
                        'type' => 'meta',
                        'attribute_key' => $attributeKey,
                        'attribute_value' => $attributeValues[$key],
                        'content' => $contents[$key],
                        'prefix' => $prefixs[$key],
                        'category' => $categories[$key],
                        'input_type' => $inputTypes[$key],
                        'placeholder' => $placeholders[$key],
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString(),
                    ];
                } else {
                    $seo = SEOArticle::firstOrNew([
                       'article_id' => $articleId, 
                       'attribute_key' => $attributeKey,
                       'attribute_value' => $attributeValues[$key],
                       'prefix' => $prefixs[$key],
                       'category' => $categories[$key],
                    ]);
                    $seo->type = 'meta';
                    $seo->input_type = $inputTypes[$key];
                    $seo->content = $contents[$key];
                    $seo->placeholder = $placeholders[$key];
                    $seo->save();
                    $exclude[] = $seo->id;
                }
            }

        }

        if (!$insertMode) {
            SEOArticle::where('article_id', $articleId)->whereNotIn('id', $exclude)->delete();
        }

        return $data;
    }

    /**
     * Build seo for static page
     *
     * @param string $page
     * @param string $titlePage
     * @return void
     */
    public function buildSeoStaticPage($page, $titlePage = '')
    {
        $properties = \Cache::remember('seo-static-page-' . app('request')->fullUrl(), 5, function() use($page) {
            return SeoStatic::getByType($page)->get(); 
        });
        if ($properties) {
            SEOMeta::setTitle(ucwords($titlePage ? $titlePage : $page));
            foreach($properties as $key => $property) {
                SEOMeta::addMeta($property->attribute_name, $property->attribute_content, $property->attribute_key);                    
            }
        }
    }
}