<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suscription extends Model
{
    //
    public function user()
    {
        return $this->hasOne("App\User", 'id', 'user_id');
    }

    protected $dates = ['date_expiration'];

}
