<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id', 'company_id'
    ];

    public function company()
    {
        return $this->hasOne("App\Company", 'id', 'company_id');
    }

    public function user()
    {
        return $this->hasOne("App\User", 'id', 'user_id');
    }

    public function bills()
    {
        return $this->hasMany("App\InvoiceBill",'customer_id');
    }

}
