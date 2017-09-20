<?php

use App\Models\SeoStatic;
use Illuminate\Database\Seeder;

class SeoStaticPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = $this->properties();
        $pages = $this->pages();

        SeoStatic::truncate();

        foreach($pages as $key => $page) {
            foreach($properties as $key => $property) {

                if ($property['name'] === 'og:url') {
                    $content = $page['url_page'];
                } else {
                    $content = $property['content'];
                }

                if ($property['name'] === 'og:title') {
                    $content = $page['title'];
                }

                SeoStatic::create([
                    'type' => $page['type'],
                    'attribute_key' => $property['key'],
                    'attribute_name' => $property['name'],
                    'attribute_content' => $content
                ]);
                
            }
        }
    }

    public function pages() 
    {
        return [
            [
                'type' => 'home',
                'title' => 'Home',
                'url_page' => env('APP_URL_DOMAIN')
            ],
            [
                'type' => 'site-map',
                'title' => 'Site Map',
                'url_page' => env('APP_URL_DOMAIN') . '/site-map'
            ],
            [
                'type' => 'privacy-police',
                'title' => 'Privacy Police',
                'url_page' => env('APP_URL_DOMAIN') . '/privacy-police'
            ],
            [
                'type' => 'about-us',
                'title' => 'About Us',
                'url_page' => env('APP_URL_DOMAIN') . '/about-us'
            ],
            [
                'type' => 'contact-us',
                'title' => 'Contact Us',
                'url_page' => env('APP_URL_DOMAIN') . '/contact-us'
            ],
            [
                'type' => 'privacy-police',
                'title' => 'Privac Police',
                'url_page' => env('APP_URL_DOMAIN') . '/about-us'
            ],
        ];
    }

    public function properties()
    {
        return [
            [
                'key' => 'name',
                'name' => 'description',
                'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt'
            ],
            [
                'key' => 'itemprop',
                'name' => 'name',
                'content' => ''
            ],
            [
                'key' => 'itemprop',
                'name' => 'description',
                'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt'
            ],
            [
                'key' => 'itemprop',
                'name' => 'image',
                'content' => ''
            ],
            [
                'key' => 'name',
                'name' => 'twitter:card',
                'content' => '@HanafiKun',
            ],
            [
                'key' => 'name',
                'name' => 'twitter:site',
                'content' => '@yourLearning',
            ],
            [
                'key' => 'name',
                'name' => 'twitter:title',
                'content' => 'Your Learning App',
            ],
            [
                'key' => 'name',
                'name' => 'twitter:description',
                'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt'                
            ],
            [
                'key' => 'name',
                'name' => 'twitter:creator',
                'content' => '@HanafiKun',
            ],
            [
                'key' => 'name',
                'name' => 'twitter:image:src',
                'content' => env('APP_URL_DOMAIN') . '/images/logo.png',
            ],
            [
                'key' => 'property',
                'name' => 'og:title',
                'content' => 'Home'
            ],
            [
                'key' => 'property',
                'name' => 'og:type',
                'content' => 'article'
            ],
            [
                'key' => 'property',
                'name' => 'og:url',
                'content' => '',
            ],
            [
                'key' => 'property',
                'name' => 'og:image',
                'content' => env('APP_URL_DOMAIN') . '/images/logo.png',
            ],
            [
                'key' => 'property',
                'name' => 'og:description',
                'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt'
            ],
            [
                'key' => 'property',
                'name' => 'og:site_name',
                'content' => 'Your Learning Web App'
            ],
            [
                'key' => 'property',
                'name' => 'fb:admins',
                'content' => 'hamdan.hanafi.98'
            ]
        ];
    }
}
