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
 * Class VipProjectAppointment
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property int|null $shop_id
 * @property int|null $vip_id
 * @property int|null $staff_id
 * @property int|null $project_id
 * @property Carbon|null $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class VipProjectAppointment extends Model
{
    use SoftDeletes,HasUuids;

    protected $table = 'vip_project_appointment';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'vip_id' => 'int',
        'staff_id' => 'int',
        'project_id' => 'int',
        'date' => 'datetime',
    ];

    protected $fillable = [
        'merchant_id',
        'shop_id',
        'vip_id',
        'staff_id',
        'project_id',
        'date',
    ];
}
