<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Package
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property string|null $name
 * @property int|null $shop_id
 * @property int|null $套餐分类
 * @property float|null $price
 * @property string|null $content
 * @property string|null $give
 * @property string|null $status
 * @property string|null $picture
 * @property string|null $details
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class Package extends Base
{
    use SoftDeletes,HasUuids;

    protected $table = 'package';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        '套餐分类' => 'int',
        'price' => 'float',
    ];

    protected $fillable = [
        'merchant_id',
        'name',
        'shop_id',
        '套餐分类',
        'price',
        'content',
        'give',
        'status',
        'picture',
        'details',
    ];
}
