<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VisitorDetail
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $date
 * @property string|null $page
 * @property int|null $total
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail whereUpdatedAt($value)
 */
class VisitorPerDay extends Model
{
    /**
     * The fillable columns
     *
     * @var array
     */
    protected $fillable = ['date', 'page', 'total', 'browser'];
}
