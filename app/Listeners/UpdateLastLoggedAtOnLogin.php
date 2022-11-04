<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Cookie;

class UpdateLastLoggedAtOnLogin
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
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $clientIP = request()->ip();

        $rol = Auth()->user()->rol_id;

        if ( $clientIP === '127.0.0.1' && $rol == 1 ) {

            Cookie::queue('origin_sesion', 'valor', 30);

        }



    }
}
