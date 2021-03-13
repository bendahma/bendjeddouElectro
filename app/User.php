<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Client;
use App\Manager;
use App\Order;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [] ;

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
