<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Label
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Label whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Label whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Label whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Label whereUpdatedAt($value)
 */
class Label extends Model
{
    /**
     * The fillable colums
     * @var array
     */
    protected $fillable = ['name'];
}
