<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailShoppings extends Model
{
    public function Shopping()
    {
        return $this->belongsTo("App\Shopping", 'id', 'shopping_id');
    }
}
