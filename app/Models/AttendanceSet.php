<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AttendanceSet
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property int|null $shop_id
 * @property string|null $lnt
 * @property string|null $lat
 * @property int|null $meter
 * @property int|null $is_can_late
 * @property int|null $can_late_minute
 * @property int|null $can_leave_early_minute
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class AttendanceSet extends Base
{
    use SoftDeletes,HasUuids;

    protected $table = 'attendance_set';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'meter' => 'int',
        'is_can_late' => 'int',
        'can_late_minute' => 'int',
        'can_leave_early_minute' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'shop_id',
        'lnt',
        'lat',
        'meter',
        'is_can_late',
        'can_late_minute',
        'can_leave_early_minute',
    ];
}
