<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pivote_family extends Model
{
    public function product()
      {
          return $this->hasOne("App\Product", 'id', 'product_id');
      }
      public function family()
      {
          return $this->hasOne("App\family", 'id', 'family_id');
      }
}
