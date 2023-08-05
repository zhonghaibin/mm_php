<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class VipGrade
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property int|null $shop_id
 * @property int|null $sort
 * @property string|null $name
 * @property string|null $upgrade_rule
 * @property string|null $effective_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class VipGrade extends Base
{
    use SoftDeletes,HasUuids;

    protected $table = 'vip_grade';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'sort' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'shop_id',
        'sort',
        'name',
        'upgrade_rule',
        'effective_at',
    ];
}
