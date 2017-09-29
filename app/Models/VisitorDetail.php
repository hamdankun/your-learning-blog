<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VisitorDetail
 *
 * @property int $id
 * @property int $page
 * @property string $ip_address
 * @property string|null $browser
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail whereBrowser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VisitorDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class VisitorDetail extends Model
{
    /**
     * The fillable column
     *
     * @var array
     */
    protected $fillable = ['page', 'ip_address', 'browser', 'date'];


    /**
     * Scope for get browser usage visitor
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param string $scope
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeBrowserUsage($query, $scope)
    {
        $query->select(
            $this->getTable() . '.browser as label',
            \DB::raw('count(' . $this->getTable() . '.page) as value')
        );
 
        if ($scope === 'week') {
            return $query->onWeek();
        }    

        return $query;
    }

    /**
     * Scope for get popular article
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param string $scope
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeOnWeek($query)
    {
        return $query->whereDate('date', '>=', Carbon::now()->subDays(7)->toDateString())
                ->whereDate('date', '<=', Carbon::now()->toDateString())
                ->groupBy($this->getTable() . '.browser');
    }
}
