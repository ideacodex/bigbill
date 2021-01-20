<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function findByName($q){
        return $this->model->where('name', 'like', "%$q%")
            ->get(); 
        return $this->model->where('lastname', 'like', "%$q%")
            ->get(); 
    }
}
