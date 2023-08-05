<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class IntegralRuleClear
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property string|null $name
 * @property string|null $clear_rule
 * @property Carbon|null $clear_at
 * @property Carbon|null $last_edit_at
 * @property Carbon|null $created_at
 * @property int|null $user_id
 * @property int|null $status
 * @property int|null $shop_id
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class IntegralRuleClear extends Base
{
    use SoftDeletes,HasUuids;

    protected $table = 'integral_rule_clear';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'clear_at' => 'datetime',
        'last_edit_at' => 'datetime',
        'user_id' => 'int',
        'status' => 'int',
        'shop_id' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'name',
        'clear_rule',
        'clear_at',
        'last_edit_at',
        'user_id',
        'status',
        'shop_id',
    ];
}
