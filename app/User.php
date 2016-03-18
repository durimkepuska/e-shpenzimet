<?php

namespace App;
use Auth;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;



class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','role_id','department_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    //Relations...
    public function role()
    {
       return $this->hasOne('App\Role','id');
    }

    public function department()
    {
        return $this->hasOne('App\Department','id');
    }
    public function expenditure()
    {
        return $this->hasMany('App\Expenditure');
    }

    //check the user role...
    public function isAdmin()
    {
        if( Auth::user()->role_id == 1 ){
            return true;
        } else {
          return false;
        }
    }
    public function isDrejtor()
    {
        if( Auth::user()->role_id == 2 ){
            return true;
        }
        return false;
    }
    public function isKoordinator()
    {
        if( Auth::user()->role_id == 3 ){
            return true;
        }
        return false;
    }



}
