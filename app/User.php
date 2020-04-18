<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function personal_profile(){
        return $this->hasOne('\App\EmployeePersonalDetail');
    }
    public function cb_profile(){
        return $this->hasOne('\App\EmployeeCbProfile');
    }
    public function previous_employment(){
        return $this->hasOne('\App\EmployeePreviousEmployment');
    }
    public function cb_appraisal_detail(){
        return $this->hasOne('\App\EmployeeCbAppraisalDetail');
    }
    public function resignation(){
        return $this->hasOne('\App\Resignation');
    }

    public function employee(){
        return $this->hasOne('\App\EmployeeCbProfile');
    }
}
