<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     public $timestamps = false;

     public function companies(){
          return $this->hasOne("App\Company", 'id', 'company_id');
      }
}
