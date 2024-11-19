<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'phone_number',
        'profile',
        'lang',
        'subscription',
        'subscription_expire_date',
        'parent_id',
        'is_active',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function totalUser()
    {
        return User::whereNotIn('type', ['super admin','owner','trainer','trainee'])->where('parent_id',$this->id)->count();
    }
    public function totalTrainer()
    {
        return User::whereIn('type', ['trainer'])->where('parent_id',$this->id)->count();
    }
    public function totalTrainee()
    {
        return User::whereIn('type', ['trainee'])->where('parent_id',$this->id)->count();
    }
    public function totalContact()
    {
        return Contact::where('parent_id', '=', parentId())->count();
    }

    public function roleWiseUserCount($role)
    {
        return User::where('type', $role)->where('parent_id',parentId())->count();
    }
    public static function getDevice($user)
    {
        $mobileType = '/(?:phone|windows\s+phone|ipod|blackberry|(?:android|bb\d+|meego|silk|googlebot) .+? mobile|palm|windows\s+ce|opera mini|avantgo|mobilesafari|docomo)/i';
        $tabletType = '/(?:ipad|playbook|(?:android|bb\d+|meego|silk)(?! .+? mobile))/i';
        if(preg_match_all($mobileType, $user))
        {
            return 'mobile';
        }
        else
        {
            if(preg_match_all($tabletType, $user)) {
                return 'tablet';
            } else {
                return 'desktop';
            }

        }
    }



    public function subscriptions()
    {
        return $this->hasOne('App\Models\Subscription','id','subscription');
    }

    public static $gender=[
        'Male'=>'Male',
        'Female'=>'Female',
    ];

    public function trainerDetail()
    {
        return $this->hasOne(TrainerDetail::class);
    }
    public function traineeDetail()
    {
        return $this->hasOne(TraineeDetail::class);
    }

    public function classAssign()
    {
        $classesId=ClassAssign::where('assign_id',$this->id)->get()->pluck('classes_id');
        $classes=Classes::whereIn('id',$classesId)->get()->pluck('title');
        return $classes;
    }


    public static $systemModules=[
        'user',
        'trainer',
        'trainee',
        'class',
        'category',
        'workout',
        'membership',
        'health',
        'attendance',
        'invoice',
        'expense',
        'finance type',
        'contact',
        'note',
        'logged history',
        'settings',
    ];
}
