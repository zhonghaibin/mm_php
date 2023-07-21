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
 * Class Good
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property int|null $shop_id
 * @property string|null $name
 * @property string|null $available_shop
 * @property float|null $price
 * @property int|null $unit_id
 * @property int|null $goods_type_id
 * @property int|null $status
 * @property string|null $goods_no
 * @property int|null $brand_id
 * @property string|null $form
 * @property string|null $capacity
 * @property Carbon|null $expiration_date
 * @property string|null $picture
 * @property string|null $details
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class Good extends Model
{
    use SoftDeletes,HasUuids;

    protected $table = 'goods';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'price' => 'float',
        'unit_id' => 'int',
        'goods_type_id' => 'int',
        'status' => 'int',
        'brand_id' => 'int',
        'expiration_date' => 'datetime',
    ];

    protected $fillable = [
        'merchant_id',
        'shop_id',
        'name',
        'available_shop',
        'price',
        'unit_id',
        'goods_type_id',
        'status',
        'goods_no',
        'brand_id',
        'form',
        'capacity',
        'expiration_date',
        'picture',
        'details',
    ];
}
