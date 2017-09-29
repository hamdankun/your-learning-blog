<?php

namespace App\Models;

use DB;
use Carbon\Carbon;
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VisitorPerDay[] $perDay
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleVisitor onWeek()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleVisitor popularArticle($scope)
 */
class ArticleVisitor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['article_id', 'total'];


    /**
     * The name of table visitor per day
     */
    CONST T_TABLE_VISITOR_PER_DAY = 'article_visitor_per_days';

    /**
     * The name of table article
     */
    CONST T_TABLE_ARTICLE = 'articles';


    /**
     * Relation with visitor per day
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function perDay()
    {
        return $this->hasMany(ArticleVisitorPerDay::class, 'visitor_id');
    }

    /**
     * Scope for get popular article
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param string $scope
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopePopularArticle($query, $scope)
    {
        $query->select(
            static::T_TABLE_ARTICLE . '.title',
            DB::raw('sum(' . static::T_TABLE_VISITOR_PER_DAY . ' .total) as total')
        )
        ->leftJoin(static::T_TABLE_VISITOR_PER_DAY, static::T_TABLE_VISITOR_PER_DAY . '.article_visitor_id', '=', $this->getTable() . '.id')
        ->rightJoin(static::T_TABLE_ARTICLE, static::T_TABLE_ARTICLE . '.id', '=', $this->getTable() . '.article_id');
 
        if ($scope === 'week') {
            return $query->onWeek();
        }    

        return $query;
    }

    /**
     * Scope for get article with scope this week
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param string $scope
     * @return \Illuminate\Database\Query\Builder
     */

    public function scopeOnWeek($query)
    {
        return $query->whereDate('date', '>=', Carbon::now()->subDays(7)->toDateString())
                ->whereDate('date', '<=', Carbon::now()->toDateString())
                ->groupBy(
                    static::T_TABLE_VISITOR_PER_DAY . '.article_visitor_id',
                    static::T_TABLE_ARTICLE . '.title'
                )
                ->orderByRaw('sum(' . static::T_TABLE_VISITOR_PER_DAY . '.total) desc')
                ->take(10);
    }

}
