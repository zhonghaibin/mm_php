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
 * Class Project
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property int|null $project_type_id
 * @property string|null $name
 * @property int|null $department_id
 * @property float|null $price
 * @property int|null $status
 * @property string|null $service_time
 * @property int|null $is_course
 * @property int|null $is_online_appointment
 * @property float|null $experience_price
 * @property string|null $picture
 * @property string|null $details
 * @property int|null $shop_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class Project extends Model
{
    use SoftDeletes,HasUuids;

    protected $table = 'project';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'project_type_id' => 'int',
        'department_id' => 'int',
        'price' => 'float',
        'status' => 'int',
        'is_course' => 'int',
        'is_online_appointment' => 'int',
        'experience_price' => 'float',
        'shop_id' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'project_type_id',
        'name',
        'department_id',
        'price',
        'status',
        'service_time',
        'is_course',
        'is_online_appointment',
        'experience_price',
        'picture',
        'details',
        'shop_id',
    ];
}
