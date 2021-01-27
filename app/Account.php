<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $timestamps = false;

    public function account_types(){
        return $this->hasOne("App\AccountType", 'id', 'status_id');
    }
}
