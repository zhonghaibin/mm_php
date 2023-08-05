<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;

/**
 * Class PasswordResetToken
 *
 * @property string $email
 * @property string $token
 * @property Carbon|null $created_at
 */
class PasswordResetToken extends Base
{
    protected $table = 'password_reset_tokens';

    protected $primaryKey = 'email';

    public $incrementing = false;

    public $timestamps = false;

    protected $hidden = [
        'token',
    ];

    protected $fillable = [
        'token',
    ];
}
