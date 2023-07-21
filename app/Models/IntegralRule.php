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
 * Class IntegralRule
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property string|null $name
 * @property int|null $shop_id
 * @property string|null $integral_rule
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * @property int|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class IntegralRule extends Model
{
    use SoftDeletes,HasUuids;

    protected $table = 'integral_rule';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'status' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'name',
        'shop_id',
        'integral_rule',
        'start_date',
        'end_date',
        'status',
    ];
}
