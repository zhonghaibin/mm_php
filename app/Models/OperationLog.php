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
 * Class OperationLog
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property int|null $event_type
 * @property string|null $content
 * @property Carbon|null $created_at
 * @property int|null $shop_id
 * @property int|null $user_id
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class OperationLog extends Model
{
    use SoftDeletes,HasUuids;

    protected $table = 'operation_log';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'event_type' => 'int',
        'shop_id' => 'int',
        'user_id' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'event_type',
        'content',
        'shop_id',
        'user_id',
    ];
}
