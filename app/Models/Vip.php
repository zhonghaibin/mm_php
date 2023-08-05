<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Vip
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property int|null $shop_id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $card_no
 * @property float|null $money
 * @property int|null $integral
 * @property int|null $arrears
 * @property int|null $source_id
 * @property string|null $birthday
 * @property string|null $consultant
 * @property string|null $cks
 * @property int|null $is_bind_wx
 * @property int|null $is_bind_qywx
 * @property int|null $grade_id
 * @property Carbon|null $expiry_date
 * @property int|null $status
 * @property int|null $sex
 * @property string|null $password
 * @property int|null $vip_type
 * @property int|null $referees_id
 * @property Carbon|null $pregnancy
 * @property string|null $address
 * @property int|null $embryo_num
 * @property Carbon|null $delivery_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class Vip extends Base
{
    use SoftDeletes,HasUuids;

    protected $table = 'vip';

    public $incrementing = false;

    protected $casts = [
        'merchant_id' => 'int',
        'shop_id' => 'int',
        'money' => 'float',
        'integral' => 'int',
        'arrears' => 'int',
        'source_id' => 'int',
        'is_bind_wx' => 'int',
        'is_bind_qywx' => 'int',
        'grade_id' => 'int',
        'expiry_date' => 'datetime',
        'status' => 'int',
        'sex' => 'int',
        'vip_type' => 'int',
        'referees_id' => 'int',
        'pregnancy' => 'datetime',
        'embryo_num' => 'int',
        'delivery_date' => 'datetime',
    ];

    protected $hidden = [
        'password',
    ];

    protected $fillable = [
        'merchant_id',
        'shop_id',
        'name',
        'phone',
        'card_no',
        'money',
        'integral',
        'arrears',
        'source_id',
        'birthday',
        'consultant',
        'cks',
        'is_bind_wx',
        'is_bind_qywx',
        'grade_id',
        'expiry_date',
        'status',
        'sex',
        'password',
        'vip_type',
        'referees_id',
        'pregnancy',
        'address',
        'embryo_num',
        'delivery_date',
    ];
}
