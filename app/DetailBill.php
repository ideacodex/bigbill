<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailBill extends Model
{
    protected $fillable = [
        'user_id', 'company_id', 'total', 'product_id'
    ];

    public function product(){
        return $this->hasOne("App\Product", 'id', 'product_id');
    }

    public function InvoiceBill(){
        return $this->belongsTo("App\InvoiceBill" ,'id', 'invoice_id');
    }
}
