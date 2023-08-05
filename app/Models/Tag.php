<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tag
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property int|null $shop_id
 * @property int|null $tags_type_id
 * @property string|null $name
 * @property string|null $color
 * @property int|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class Tag extends Base
{
    use SoftDeletes,HasUuids;

    protected $table = 'tags';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'tags_type_id' => 'int',
        'status' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'shop_id',
        'tags_type_id',
        'name',
        'color',
        'status',
    ];
}
