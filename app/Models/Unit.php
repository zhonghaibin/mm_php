<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Unit
 *
 * @property int $id
 * @property int|null $merchant_id
 * @property int|null $shop_id
 * @property string|null $name
 * @property int|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class Unit extends Base
{
    use SoftDeletes,HasUuids;

    protected $table = 'unit';

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'status' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'shop_id',
        'name',
        'status',
    ];
}
