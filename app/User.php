<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use  Notifiable;
    use SoftDeletes;
    const super_admin=1;
    const admin = 2;
    const manager = 3;
    const operator = 4;
    const business = 5;

    const active_user=1;
    const inactive_user=0;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function business_info()
    {
        return $this->hasOne('App\BusinessInfo');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    function getFullNameAttribute()
    {
        return ucfirst($this->name) . ' ' . ucfirst($this->surname);
    }



    public function isSuperUser()
    {
        return($this->role == \App\User::super_admin);
    }

    public function isAdmin()
    {
        return($this->role == \App\User::admin);
    }


    public function isManager()
    {
        return($this->role == \App\User::manager);
    }

    public function isOperator()
    {
        return($this->role ==\App\User::operator);
    }

    public function hasRole($roles)
    {
        // Check if the user is a root account
        if( $this->getUserRole() == \App\User::super_admin) {
            return true;
        }

        if(is_array($roles))
        {
            foreach($roles as $need_role){
                if($this->checkIfUserHasRole($need_role)) {

                    return true;
                }
            }
        }

        else
        {
            return $this->checkIfUserHasRole($roles);
        }

        return false;
    }


    private function getUserRole()
    {
        return $this->role;
    }


    private function checkIfUserHasRole($need_role)
    {
        return (strtolower($need_role) == strtolower($this->role)) ? true : false;
    }

}
