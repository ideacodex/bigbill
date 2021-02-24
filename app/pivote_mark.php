<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pivote_mark extends Model
{
    public function product()
      {
          return $this->hasOne("App\Product", 'id', 'product_id');
      }
      public function mark()
      {
          return $this->hasOne("App\mark", 'id', 'family_id');
      }
}
