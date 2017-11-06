<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SeoStatic
 *
 * @property int $id
 * @property string|null $type
 * @property string|null $attribute_key
 * @property string|null $attribute_name
 * @property string|null $attribute_content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoStatic whereAttributeContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoStatic whereAttributeKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoStatic whereAttributeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoStatic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoStatic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoStatic whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoStatic whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoStatic aboutUs()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoStatic contactUs()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoStatic deleteUnUsedAttribute($type, $exclude)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoStatic getByType($type)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoStatic home()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoStatic privacyPolice()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SeoStatic siteMap()
 */
class SeoStatic extends Model
{
    /**
     * The fillable colums model
     *
     * @var array
     */
    protected $fillable = ['type', 'attribute_key', 'attribute_name', 'attribute_content'];

    /**
     * The name of Home page 
     */
    const HOME = 'home';

    /**
     * The name of site map page
     */
    const SITE_MAP = 'site-map';

    /**
     * The name of privacy police page
     */
    const PRIVACY_POLICE = 'privacy-police';

    /**
     * The name of contact us page
     */
    const CONTACT_US = 'contact-us';

    /**
     * The name of about page
     */
    const ABOUT = 'about-us';


    /**
     * Get properties by type
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param string $type
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeGetByType($query, $type)
    {
        return $query->where('type', $type)->orderBy('attribute_key');
    }
    
    /**
     * Scope for get page properties
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeHome($query) {
        return $query->where('type', static::HOME)->orderBy('attribute_key', 'asc');
    }

    /**
     * Scope for get site map properties
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeSiteMap($query) {
        return $query->where('type', static::SITE_MAP)->orderBy('attribute_key', 'asc');
    }

    /**
     * Scope for get Privacy Police page
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     * @return void
     */
    public function scopePrivacyPolice($query) {
        return $query->where('type', static::PRIVACY_POLICE)->orderBy('attribute_key', 'asc');
    }
    
    /**
     * Scope for get Contact us properties
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     * @return void
     */
    public function scopeContactUs($query) {
        return $query->where('type', static::CONTACT_US)->orderBy('attribute_key', 'asc');
    }

    /**
     * Scope for get About us properties
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     * @return void
     */
    public function scopeAboutUs($query) {
        return $query->where('type', static::ABOUT)->orderBy('attribute_key', 'asc');
    }

    public function scopeDeleteUnUsedAttribute($query, $type, $exclude) {
        return $query->where('type', $type)->whereNotIn('id', $exclude)->delete();
    } 
}