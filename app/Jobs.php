<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Jobs extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jobId', 'userId', 'companyId','pay_id','amount','p_Category','title','jType','department','category','subCategory','careerLevel','experience','vacancies','description','skills','qualification','jobType','jobShift','minSalary','maxSalary','currency','benefits','country','city','state','expiryDate','status','createdTime'
    ];

   
}
