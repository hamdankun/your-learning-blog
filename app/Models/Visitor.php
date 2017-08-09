<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Visitor
 *
 * @property int $id
 * @property int|null $article_id
 * @property int|null $total
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Visitor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['article_id', 'total'];


    /**
     * Relation with visitor per day
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function perDay()
    {
        return $this->hasMany(VisitorPerDay::class, 'visitor_id');
    }

}
