<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ratting
 *
 * @property int $id
 * @property int|null $article_id
 * @property float|null $value
 * @property float|null $count
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ratting whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ratting whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ratting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ratting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ratting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ratting whereValue($value)
 * @mixin \Eloquent
 */
class Ratting extends Model
{
    //
}
