<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;   

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'lastname', 'role_id', 'status_id', 'score_id', 'check_terms','branch_id'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function score(){
        return $this->belongsTo("App\Score", 'score_id');
    }
    public function status(){
        return $this->belongsTo("App\Status", 'status_id');
    }
    public function branch_offices(){
        return $this->belongsTo("App\BranchOffice", 'branch_id');
    }    

    public function findForPassport($username)
    {
        return User::orWhere('email', $username)->orWhere('phone', $username)->first();
    }
    public function companies(){
        return $this->belongsTo("App\Company", 'company_id');
    }
    public function company(){
        return $this->hasOne("App\Company", 'id', 'company_id');
    }
    public function customer()
    {
        return $this->hasOne("App\Customer", 'id', 'customer_id');
    }
    public function detail()
    {
        return $this->hasMany("App\DetailBill", 'invoice_id');
    }

    public function suscriptions(){
        return $this->belongsTo("App\Suscription", 'id', 'user_id');
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }    
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                 return true; 
            }   
        }
        return false;
    }
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}
