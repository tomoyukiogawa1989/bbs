<?php

namespace App\Models;

use Carbon\Carbon; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserConfirmation extends Authenticatable 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'token', 'confirmed_at', 'created_at'
    ];

    protected $dates = [ 
        'confirmed_at',
        'created_at',
    ];

    public function makeConfirmationToken($key) { 
        $this->token = hash_hmac(
            'sha256',
            str_random(40).$this->email,
            $key
        );
        return $this->token;
    }
 
    public function confirm() { 
        $this->confirmed_at = Carbon::now();
        $this->confirmation_token = '';
    }
 
    public function isConfirmed() { 
        return ! empty($this->confirmed_at);
    }

}
 