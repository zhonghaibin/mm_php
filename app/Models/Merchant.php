<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Merchant
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class Merchant extends Base
{
    use SoftDeletes,HasUuids;

    protected $table = 'merchant';

    protected $casts = [
        'user_id' => 'int',
    ];

    protected $fillable = [
        'name',
        'user_id',
    ];
}
