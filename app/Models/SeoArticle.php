<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Seo
 *
 * @property int $id
 * @property int|null $article_id
 * @property string|null $type
 * @property string $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Article|null $article
 * @property int|null $seo_property_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoConfigArticle whereSeoPropertyId($value)
 */
class SeoArticle extends Model
{
    /**
     * The fillable colums
     * @var array
     */
    protected $fillable = ['article_id', 'type', 'attribute_key', 'attribute_value', 'content', 'prefix'];

    /**
     * Relation With Article
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
