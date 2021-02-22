<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function company()
    {
        return $this->hasOne("App\Company", 'id', 'company_id');
    }
}
