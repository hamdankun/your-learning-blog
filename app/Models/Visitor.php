<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Visitor
 *
 * @property int $id
 * @property string|null $date
 * @property string|null $page
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $total
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor allOfTime()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor fiveDayAgo()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor previousMonth()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor today()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor yesterday()
 */
class Visitor extends Model
{
    /**
     * The fillable columns
     *
     * @var array
     */
    protected $fillable = ['date', 'total'];


    /**
     * Scope for get all count visitior today
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeToday($query)
    {
        return $query->whereDate('date', Carbon::now()->toDateString());
    }

    /**
     * Scope for get all count visitior yesterday
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeYesterday($query)
    {
        return $query->whereDate('date', '<=',Carbon::now()->subDays(1)->toDateString())
                 ->whereDate('date', '>=',Carbon::now()->subDays(1)->toDateString());
    }

    /**
     * Scope for get all count visitior previous month
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopePreviousMonth($query)
    {
        return $query->whereDate('date', '<=', Carbon::now()->lastOfMonth()->subMonth(1))
                ->whereDate('date', '>=', Carbon::now()->firstOfMonth()->subMonth(1))
                ->orderBy('date', 'desc');
    }

    /**
     * Scope for get all count visitior all of time
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeAllOfTime($query)
    {
        return $query->whereDate('date', '<=',Carbon::now()->subDays(2)->toDateString())
                ->orderBy('date', 'desc');
    }

    /**
     * Get visitor five day ago
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeFiveDayAgo($query)
    {
        return $query->select($this->transformDate('date'), 'total')
                ->whereDate('date', '<=', Carbon::now()->toDateString())
                 ->whereDate('date', '>=', Carbon::now()->subDays(5)->toDateString())
                 ->orderBy('date', 'asc')
                 ->take(5);
    }

    public function transformDate($column, $defaultFormat = '%d/%m')
    {
        return \DB::raw('date_format(' . $column . ', "' . $defaultFormat . '") as date');
    }
}
