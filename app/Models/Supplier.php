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
 * Class Supplier
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property int|null $shop_id
 * @property string|null $name
 * @property string|null $contacts
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $balance_type
 * @property int|null $balance_day
 * @property string|null $bank_name
 * @property string|null $bank_no
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class Supplier extends Model
{
    use SoftDeletes,HasUuids;

    protected $table = 'supplier';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'balance_day' => 'int',
    ];

    protected $fillable = [
        'merchant_id',
        'shop_id',
        'name',
        'contacts',
        'phone',
        'address',
        'balance_type',
        'balance_day',
        'bank_name',
        'bank_no',
    ];
}
