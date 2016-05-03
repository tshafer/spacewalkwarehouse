<?php
namespace Wash;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Wash\Support\Traits\Attributes;
use Wash\Support\Traits\Linkable;
use Wash\Support\Traits\Sortable;


class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{

    use Authenticatable, Authorizable, CanResetPassword, Linkable, Sortable, Attributes;

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
    protected $fillable = [
      'first_name',
      'last_name',
      'email',
      'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @param $value
     */
    public function setPhotoAttribute($value)
    {
        if (isset($this->attributes['photo']) && $this->attributes['photo'] != '') {
            $filename = public_path() . '/uploads/' . $this->attributes['photo'];

            if (File::exists($filename)) {
                File::delete($filename);
            }
        }

        if ($value == '') {
            $this->attributes['photo'] = '';
        } else {
            $filename = time() . $value->getClientOriginalName();

            $value->move(public_path() . '/uploads/', $filename);

            $this->attributes['photo'] = $filename;
        }
    }


    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Hash the User's Password
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

}
