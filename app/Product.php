<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

     public $timestamps = false;
    //  protected $path = ['file'];
    protected $fillable = ['file'];

     public function companies(){
          return $this->hasOne("App\Company", 'id', 'company_id');
      }
      public function company()
      {
          return $this->hasOne("App\Company", 'id', 'company_id');
      }
}
