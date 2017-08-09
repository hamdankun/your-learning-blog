<?php

namespace App\Models;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * App\Models\Article
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property int|null $user_id
 * @property int|null $category_id
 * @property string|null $content
 * @property string|null $label
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUserId($value)
 * @property string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article findSimilarSlugs(\Illuminate\Database\Eloquent\Model $model, $attribute, $config, $slug)
 * @property string|null $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereImage($value)
 * @property string|null $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SeoArticle[] $SEO
 * @property-read \Illuminate\Database\Eloquent\Collection|\OwenIt\Auditing\Models\Audit[] $audits
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article comparisonClause($id, $direction = 'desc', $operator = '<', $limit = 1)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article findNextData($id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article findPrevData($id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article findSimiliar($queryString = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article getByCategory($slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article jsonPublicColumn()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article publicColumn()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article recent()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article takeSlugArticleAndCategory()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article withCategory()
 */
class Article extends Model implements AuditableContract
{
    use Sluggable, Auditable;

    /**
     * The fillable columns model
     * @var array
     */
    protected $fillable = ['title', 'user_id', 'content', 'label', 'slug', 'category_id', 'description'];

    /**
     * Category table name
     */
    CONST T_CATEGORY = 'categories';

    /**
     * Visitor table name
     */
    CONST T_VISITOR = 'visitors';

    /**
     * Set the label array to json
     *
     * @param  string $value
     * @return void
     */
    public function setLabelAttribute($value)
    {
        $this->attributes['label'] = json_encode($value);
    }

    /**
     * Get the label json to array
     *
     * @param  string $value
     * @return array
     */
    public function getLabelAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Remove space on end character
     * @param string $value
     * @return string
     */
    public function setTitleAttribute($value)
    {
        return $this->attributes['title'] = trim($value);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    /**
     * Life cycle eloquent models
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (\Auth::user()) {
                $model->user_id = \Auth::user()->id;
            }
        });
    }

    /**
     * Relation with category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Relation with user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation with seo config article
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SEO()
    {
        return $this->hasMany(SeoArticle::class, 'article_id');
    }

    /**
     * Relation with visitor
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function visitor()
    {
        return $this->hasOne(Visitor::class, 'article_id');
    }

    /**
     * Scope for get article by category
     * @param  \Illuminate\Database\Query\Builder $query
     * @param  string $slug
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeGetByCategory($query, $slug)
    {
        if ($slug !== 'all') {
            return $query->withCategory()
                ->where(static::T_CATEGORY . '.slug', $slug);
        }
    }

    /**
     * Scope for query join with category
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeWithCategory($query)
    {
        return $query
            ->join(static::T_CATEGORY, static::T_CATEGORY . '.id', '=', $this->getTable() . '.category_id');
    }

    /**
     * Scope for get article with visitor
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeWithVisitor($query)
    {
        return $query
            ->leftJoin(static::T_VISITOR, static::T_VISITOR . '.article_id', '=', $this->getTable() . '.id');
    }

    /**
     * Scope for get column article and visitor
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeArticleVisitorColumn($query)
    {
        $query
            ->select(
                $this->getTable() . '.id',
                $this->getTable() . '.title',
                $this->getTable() . '.image',
                static::T_VISITOR . '.total'
            );
    }

    /**
     * Scope for get public column visible
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopePublicColumn($query)
    {
        return $query
            ->select(
                $this->getTable() . '.id',
                $this->getTable() . '.title',
                $this->getTable() . '.content',
                $this->getTable() . '.label',
                $this->getTable() . '.image',
                $this->getTable() . '.category_id'
            );
    }

    /**
     * Scope for get public column visible for json request
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeJsonPublicColumn($query)
    {
        return $query
            ->select(
                $this->getTable() . '.title',
                $this->getTable() . '.content',
                $this->getTable() . '.label',
                $this->getTable() . '.image'
            );
    }

    /**
     * Scope for get slug article and slug category
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeTakeSlugArticleAndCategory($query)
    {
        return $query
            ->addSelect($this->getTable() . '.slug as article_slug',
                static::T_CATEGORY . '.slug as category_slug');
    }

    /**
     * Scope for get get similiar article base on query string
     * @param  \Illuminate\Database\Query\Builder $query
     * @param  string $queryString
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeFindSimiliar($query, $queryString = '')
    {
        if ($queryString) {
            return $query->where($this->getTable() . '.title', 'like', '%' . $queryString . '%');
        }

        return $query;
    }

    /**
     * Get previous data
     * @param  \Illuminate\Database\Query\Builder $query
     * @param  integer $id
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeFindPrevData($query, $id)
    {
        return $query->comparisonClause($id);
    }

    /**
     * Get next data
     * @param  \Illuminate\Database\Query\Builder $query
     * @param  integer $id
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeFindNextData($query, $id)
    {
        return $query->comparisonClause($id, 'asc', '>');
    }

    /**
     * Scope for get data prev/next base on condition
     * @param  \Illuminate\Database\Query\Builder $query
     * @param  integer $id
     * @param  string $direction
     * @param  string $operator
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeComparisonClause($query, $id, $direction = 'desc', $operator = '<', $limit = 1)
    {
        return $query->where('id', $operator, $id)->orderBy('id', $direction)->limit($limit)->with('category');
    }

    /**
     * Scope for get recent article
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'asc')->with('category')->limit(5);
    }

    /**
     * Scope for get popular article
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopePopular($query)
    {
        return $query->withVisitor()
            ->withCategory()
            ->articleVisitorColumn()
            ->takeSlugArticleAndCategory()
            ->orderBy(static::T_VISITOR . '.total', 'desc');
    }

    /**
     * Sort by article
     * @param \Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Database\Query\Builder $criteriaS
     */
    public function scopeSortBy($query, $direction)
    {
        if (in_array($direction, ['asc', 'desc'])) {
            $query->orderBy($this->getTable() . '.created_at', $direction);
        } else {
            $query->withVisitor();
//                ->orderBy(static::T_VISITOR . '.total', 'desc');
        }

        return $query;
    }
}
