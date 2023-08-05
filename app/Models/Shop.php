<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Shop
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property string|null $name
 * @property string|null $address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class Shop extends Base
{
    use SoftDeletes,HasUuids;

    protected $table = 'shop';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'name',
        'address',
    ];
}
