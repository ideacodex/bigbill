<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailShoppings extends Model
{
    public function Shopping()
    {
        return $this->belongsTo("App\Shopping", 'id', 'shopping_id');
    }

    public function product(){
        return $this->hasOne("App\Product", 'id', 'product_id');
    }
}
