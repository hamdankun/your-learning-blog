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
 */
class Article extends Model implements AuditableContract
{
    use Sluggable, Auditable;

    /**
     * The fillable columns model
     * @var array
     */
    protected $fillable = ['title', 'user_id', 'content', 'label', 'slug', 'category_id', 'description'];

    CONST T_CATEGORY = 'categories';


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
        return $query->where('id', $operator, $id)->orderBy('id', $direction)->limit($limit);
    }
}
