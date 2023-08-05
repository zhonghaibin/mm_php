<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClassroomTimeSet
 *
 * @property int $id
 * @property int|null $merchant_id
 * @property int|null $shop_id
 * @property string|null $rang_time
 * @property int|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class ClassroomTimeSet extends Base
{
    use SoftDeletes,HasUuids;

    protected $table = 'classroom_time_set';

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'status' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'shop_id',
        'rang_time',
        'status',
    ];
}
