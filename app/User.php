<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
protected $primaryKey = 'userId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId','secretId','companyId','firstName','lastName','email','username','password','phoneNumber','type','	status','country','city','state','remember_token','profilePhoto','about','createdTime','modifiedTime','updated_at',
    ];
protected $table = 'jcm_users';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
