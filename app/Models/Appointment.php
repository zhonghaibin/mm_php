<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Appointment
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property int|null $shop_id
 * @property string|null $title
 * @property int|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class Appointment extends Base
{
    use SoftDeletes,HasUuids;

    protected $table = 'appointment';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'status' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'shop_id',
        'title',
        'status',
    ];
}
