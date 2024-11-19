<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraineeDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_id', 'name', 'email', 'dob', 'parent_name', 'gender', 
        'address', 'category', 'membership_plan', 'membership_start_date', 'phone_number', 'age',
        'trainer_assign', 'fitness_goal', 'country', 'state', 'city', 'zip_code', 'membership_expiry_date'
    ];
    

    public static $status = [
        1=>'Active',
        0=> 'Inactive',
    ];

    public function categorys()
    {
        return $this->hasOne('App\Models\Category','id','category');
    }

    public function membership()
    {
        return $this->hasOne('App\Models\Membership','id','membership_plan');
    }

    public function userDetail()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function trainers()
    {
        return $this->hasOne('App\Models\User','id','trainer_assign');
    }
}
