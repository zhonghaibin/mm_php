<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property string $id
 * @property int|null $merchant_id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string|null $username
 * @property string|null $password
 * @property string|null $phone
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 */
class User extends Base
{
    use SoftDeletes,HasFactory,HasUuids,HasApiTokens;

    protected $table = 'users';

    public $incrementing = false;

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'merchant_id',
        'name',
        'email',
        'email_verified_at',
        'username',
        'password',
        'phone',
        'remember_token',
    ];
}
