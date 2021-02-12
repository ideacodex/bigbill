<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    protected $fillable = [
        'name','phone', 'pbx', 'address','company_id'
    ];
    public function company(){
        return $this->hasOne('App\Company', 'id', 'company_id');
    }
    
}
