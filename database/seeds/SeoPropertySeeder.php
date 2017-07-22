<?php

use Illuminate\Database\Seeder;
use App\Models\SeoProperty;

class SeoPropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SeoProperty::insert([
            [
                'name' => 'meta',
                'input' => '<textarea type="text" name="seo_config[meta][]" class="form-control"></textarea>',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'property',
                'input' => '<textarea type="text" name="seo_config[property][]" class="form-control"></textarea>',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'type',
                'input' => '<textarea type="text" name="seo_config[type][]" class="form-control"></textarea>',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        ]);
    }
}
