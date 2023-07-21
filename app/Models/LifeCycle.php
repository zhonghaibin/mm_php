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
 * Class LifeCycle
 *
 * @property int $id
 * @property int|null $merchant_id
 * @property int|null $shop_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class LifeCycle extends Model
{
    use SoftDeletes,HasUuids;

    protected $table = 'life_cycle';

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'shop_id',
    ];
}
