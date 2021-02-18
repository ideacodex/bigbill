<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentSuscription extends Model
{
    public function suscriptions()
    {
        return $this->hasOne("App\Suscription", 'id', 'suscription_id');
    }

    protected $dates = ['date_expiration'];
}
