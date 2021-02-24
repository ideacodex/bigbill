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

    public function invoiceTypes()
    {
        if ($this->invoice_type == 0) {
            return "Factura sin iva";
        }elseif ($this->invoice_type == 1){
            return "Factura con iva";
        }
    }

    public function appliedPrices()
    {
        if ($this->applied_price == 1) {
            return "Precio especial";
        } elseif($this->applied_price == 2) {
            return "Precio al contado";
        } elseif($this->applied_price == 3){
            return "Precio de crédito"; 
        }
        
    }
}
