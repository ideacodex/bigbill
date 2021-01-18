<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceBill extends Model
{
    protected $fillable = [
        'user_id', 'company_id', 'total'
    ];

    public function product(){
        return $this->hasOne("App\Product", 'id', 'id_product');
    }
}
