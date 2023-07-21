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
 * Class Paid
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property int|null $shop_id
 * @property int|null $paid_shop_id
 * @property int|null $paid_type
 * @property string|null $paid_content
 * @property int|null $paid_type_id
 * @property float|null $money
 * @property Carbon|null $paid_at
 * @property int|null $staff_id
 * @property string|null $attachment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class Paid extends Model
{
    use SoftDeletes,HasUuids;

    protected $table = 'paid';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'paid_shop_id' => 'int',
        'paid_type' => 'int',
        'paid_type_id' => 'int',
        'money' => 'float',
        'paid_at' => 'datetime',
        'staff_id' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'shop_id',
        'paid_shop_id',
        'paid_type',
        'paid_content',
        'paid_type_id',
        'money',
        'paid_at',
        'staff_id',
        'attachment',
    ];
}
