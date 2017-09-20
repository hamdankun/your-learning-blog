<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RattingDetail
 *
 * @property int $id
 * @property int|null $ratting_id
 * @property int|null $user_id
 * @property string|null $date
 * @property float|null $value
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RattingDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RattingDetail whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RattingDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RattingDetail whereRattingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RattingDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RattingDetail whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RattingDetail whereValue($value)
 * @mixin \Eloquent
 */
class RattingDetail extends Model
{
    //
}
