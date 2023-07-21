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
 * Class ValueCard
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property string|null $name
 * @property string|null $available_shop
 * @property int|null $shop_id
 * @property float|null $price
 * @property float|null $money
 * @property int|null $value_card_type_id
 * @property string|null $available_product
 * @property int|null $start_type
 * @property int|null $end_type
 * @property string|null $buy_give_product
 * @property string|null $renew_give_product
 * @property int|null $status
 * @property string|null $details
 * @property int|null $is_limit
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class ValueCard extends Model
{
    use SoftDeletes,HasUuids;

    protected $table = 'value_card';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'price' => 'float',
        'money' => 'float',
        'value_card_type_id' => 'int',
        'start_type' => 'int',
        'end_type' => 'int',
        'status' => 'int',
        'is_limit' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'name',
        'available_shop',
        'shop_id',
        'price',
        'money',
        'value_card_type_id',
        'available_product',
        'start_type',
        'end_type',
        'buy_give_product',
        'renew_give_product',
        'status',
        'details',
        'is_limit',
    ];
}
