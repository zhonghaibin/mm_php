<?php

namespace App\Listeners;

use App\Events\OperationEvent;
use App\Helpers\Extensions\UserExt;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;

class LoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     *
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        $user->last_login_at = Carbon::now();
        $user->last_login_ip = request()->ip();
        $user->save();
        event(new OperationEvent(UserExt::getAttribute('name'), '管理员登录',
            request()->ip(), time()));
    }
}
