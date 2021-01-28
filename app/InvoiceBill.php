<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceBill extends Model
{
    protected $fillable = [
        'user_id', 'company_id', 'total', 'product_id'
    ];

    public function product(){
        return $this->hasOne("App\Product", 'id', 'id_product');
    }

    public function company(){
        return $this->hasOne("App\Company", 'id', 'company_id');
    }

    public function user(){
        return $this->hasOne("App\User", 'id', 'user_id');
    }
}
