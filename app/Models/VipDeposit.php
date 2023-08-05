<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class VipDeposit
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property int|null $shop_id
 * @property int|null $vip_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class VipDeposit extends Base
{
    use SoftDeletes,HasUuids;

    protected $table = 'vip_deposit';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'vip_id' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'shop_id',
        'vip_id',
    ];
}
