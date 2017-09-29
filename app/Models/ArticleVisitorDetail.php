<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VisitorDetail
 *
 * @property int $id
 * @property int|null $visitor_per_day_id
 * @property string $ip_address
 * @property string $page
 * @property string|null $browser
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail whereBrowser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail whereVisitorPerDayId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\VisitorPerDay|null $perDay
 * @property int|null $article_visitor_per_day_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleVisitorDetail whereArticleVisitorPerDayId($value)
 */
class ArticleVisitorDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['article_visitor_per_day_id', 'ip_address', 'page', 'browser'];

    /**
     * Relation with visitor per day
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function perDay()
    {
        return $this->belongsTo(ArticleVisitorPerDay::class, 'article_visitor_per_day_id');
    }
}
