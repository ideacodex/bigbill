<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pivote_family extends Model
{

    public function products()
       {
           return $this->hasOne("App\Product", 'id', 'product_id');
       }
     public function families()
       {
         return $this->hasOne("App\Family", 'id', 'family_id');
       }

}
