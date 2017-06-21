<?php

namespace App;

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
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    /** =============================================================================
     *  RELATIONSHIPS
     *  ============================================================================= */

    /**
     * Define Eloquent Relationship
     * One-to-Many
     *
     * @return mixed
     */
    public function usermenu() {
        return $this->hasMany('App\Usermenu');
    }

    /**
     * Define Eloquent Relationship
     * One-to-Many
     *
     * @return mixed
     */
    public function node() {
        return $this->hasMany('App\node');
    }


    /** =============================================================================
     *  FUNCTIONALITY
     *  ============================================================================= */

    /**
     * Associate a usermenu to a user.
     *
     * @return object
     */
    public function associateUsermenu($usermenu) {
        return $this->usermenu()->save($usermenu);
    }

    /**
     * Return the number of Usermenu's that are associated with the User.
     *
     * @return integer
     */
    public function countMenus() {
        return $this->usermenu()->count();
    }

    /**
     * Creates the user folder for their images if it doesn't exist.
     *
     * @return string userpath
     */
    public static function createUserHolocronDirectory($user)
    {

        $userpath = '/holocrons/' . md5($user);

        $fullpath = base_path() . '/public' . $userpath;

        if(!is_dir($fullpath)){
            mkdir($fullpath, 0755);
        }

        return $userpath;

    }

    /**
     * @param $user
     * @return string
     */
    public static function userHolocronDirectory($user)
    {
        return '/holocrons/' . md5($user);
    }
}
