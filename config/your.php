<?php

return [

    /*
    |--------------------------------------------------------------------------
    | The application
    |--------------------------------------------------------------------------
    */
    'app' => [
        'name' => env('APP_NAME'),
        'url_domain' => env('APP_URL_DOMAIN'),
        'bio' => 'Your Learning Adalah website yang didirikan pada tahun 2017 oleh hamdan hanafi,
              bertujuan untuk membantu orang-orang belajar dalam dunia programing. semua developer bisa datang kemari
              untuk mencari tahu dan mendapatkan hal baru tentang programing.'
    ],

    /*
    |--------------------------------------------------------------------------
    | App Url paths
    |--------------------------------------------------------------------------
    */
    'base' => [
        'img_upload_path'   => env('BASE_IMG_UPLOAD_PATH'),
        'path_storage'      => env('BASE_PATH_STORAGE')
    ],

    /*
    |--------------------------------------------------------------------------
    | Dist path asset publi html
    |--------------------------------------------------------------------------
    */
    'dist_path' => env('DIST_PATH'),
    /*
    |--------------------------------------------------------------------------
    | Language default
    |--------------------------------------------------------------------------
    */
    'default_lang' => env('DEFAULT_LANG'),

    /*
    |--------------------------------------------------------------------------
    | mix path storage for load in js resources
    |--------------------------------------------------------------------------
    */
    'mix_base_path_storage' => env('MIX_BASE_PATH_STORAGE'),

    /*
    |--------------------------------------------------------------------------
    | default paginate limit frontend
    |--------------------------------------------------------------------------
    */
    'front_article_paginate' => env('FRONT_ARTICLE_PAGINATE'),

    /*
    |--------------------------------------------------------------------------
    | limit popular article data
    |--------------------------------------------------------------------------
    */
    'popular_article_limit' => env('POPULAR_ARTICLE_LIMIT'),

    /*
    |--------------------------------------------------------------------------
    | mix path storage for load in js resources
    |--------------------------------------------------------------------------
    */
    'default_site_twitter' => env('DEFAULT_SITE_TWITTER')
];
