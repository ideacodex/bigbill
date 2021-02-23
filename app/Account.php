<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $timestamps = false;

    public function account_types(){
        return $this->hasOne("App\AccountType", 'id', 'status_id');
    }
    protected $fillable = [
        'user_id', 'total', 'product_id'
    ];
    public function types()
    {
        return $this->hasOne("App\AccountType", 'id', 'status_id');
    }

    public function user()
    {
        return $this->hasOne("App\User", 'id', 'user_id');
    }

    public function customer()
    {
        return $this->hasOne("App\Customer", 'id', 'customer_id');
    }

    public function detail()
    {
        return $this->hasMany("App\DetailBill", 'invoice_id');
    }
}
