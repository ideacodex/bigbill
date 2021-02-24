<?php

namespace App;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;

class InvoiceBill extends Model
{

    protected $fillable = [
        'user_id', 'company_id', 'total', 'product_id'
    ];

    public function company()
    {
        return $this->hasOne("App\Company", 'id', 'company_id');
    }

    public function branch_office()
    {
        return $this->hasOne("App\BranchOffice", 'id', 'branch_id');
    }

    public function user()
    {
        return $this->hasOne("App\User", 'id', 'user_id');
    }

    public function customer()
    {
        return $this->hasOne("App\Customer", 'id', 'customer_id');
    }

    public function detail()
    {
        return $this->hasMany("App\DetailBill", 'invoice_id');
    }

    public function settings()
    {
        return $this->hasOne("App\Setting", 'id', 'setting_id');
    }
}
