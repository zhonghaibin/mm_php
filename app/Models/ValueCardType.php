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
 * Class ValueCardType
 *
 * @property int $id
 * @property int|null $merchant_id
 * @property string|null $name
 * @property int|null $shop_id
 * @property int|null $pid
 * @property int|null $sort
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class ValueCardType extends Model
{
    use SoftDeletes,HasUuids;

    protected $table = 'value_card_type';

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'pid' => 'int',
        'sort' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'name',
        'shop_id',
        'pid',
        'sort',
    ];
}
