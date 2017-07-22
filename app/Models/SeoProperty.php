<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SeoProperty
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $input
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoProperty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoProperty whereInput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoProperty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoProperty whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SeoProperty extends Model
{
    /**
     * The fillable colums
     * @var array
     */
    protected $fillable = ['name', 'input'];

    
}
