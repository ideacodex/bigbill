<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class family extends Model
{
    public function company()
      {
          return $this->hasOne("App\Company", 'id', 'company_id');
      }
}
