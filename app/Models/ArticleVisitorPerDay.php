<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VisitorPerDay
 *
 * @property int $id
 * @property int|null $visitor_id
 * @property int|null $total
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorPerDay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorPerDay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorPerDay whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorPerDay whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorPerDay whereVisitorId($value)
 * @mixin \Eloquent
 * @property string|null $date
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VisitorDetail[] $detail
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorPerDay whereDate($value)
 * @property int|null $article_visitor_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleVisitorPerDay whereArticleVisitorId($value)
 */
class ArticleVisitorPerDay extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['article_visitor_id', 'date', 'total'];

    /**
     * Relation with visitor detail
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detail()
    {
        return $this->hasMany(ArticleVisitorDetail::class, 'visitor_per_day_id');
    }
}
