<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Schedule
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property int|null $shop_id
 * @property int|null $staff_id
 * @property Carbon|null $date
 * @property string|null $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class Schedule extends Model
{
    use SoftDeletes,HasUuids;

    protected $table = 'schedule';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'staff_id' => 'int',
        'date' => 'datetime',
    ];

    protected $fillable = [
        'merchant_id',
        'shop_id',
        'staff_id',
        'date',
        'content',
    ];
}
