<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "companies";
    protected $fillable = [
       'id', 'name', 'nit', 'phone', 'address'
    ];


    public function branch_offices(){
        return $this->belongsTo("App\BranchOffice", 'id','company_id');
    }
    public function user(){
        return $this->belongsTo("App\User", 'id','company_id');
    }



}

