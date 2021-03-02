<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    //  protected $path = ['file'];
    protected $fillable = ['file'];

     public function companies(){
          return $this->hasOne("App\Company", 'id', 'company_id');
      }
      public function company()
      {
          return $this->hasOne("App\Company", 'id', 'company_id');
      }

      public function pivotFamily()
    {
        return $this->hasMany("App\pivote_family", 'product_id');
    }

    public function pivotMark()
    {
        return $this->hasMany("App\pivote_mark", 'product_id');
    }
}
