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
 * Class Coupon
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property string|null $name
 * @property string|null $available_shop
 * @property int|null $shop_id
 * @property float|null $price
 * @property float|null $money
 * @property int|null $coupon_type_id
 * @property string|null $available_product
 * @property int|null $start_type
 * @property int|null $end_type
 * @property int|null $status
 * @property string|null $restriction
 * @property int|null $is_allow_give
 * @property string|null $details
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class Coupon extends Model
{
    use SoftDeletes,HasUuids;

    protected $table = 'coupon';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'price' => 'float',
        'money' => 'float',
        'coupon_type_id' => 'int',
        'start_type' => 'int',
        'end_type' => 'int',
        'status' => 'int',
        'is_allow_give' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'name',
        'available_shop',
        'shop_id',
        'price',
        'money',
        'coupon_type_id',
        'available_product',
        'start_type',
        'end_type',
        'status',
        'restriction',
        'is_allow_give',
        'details',
    ];
}
