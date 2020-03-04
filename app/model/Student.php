<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Student extends Model
{

    protected $fillable = ['user_id', 'NIS', 'name', 'gender', 'place_of_birth', 'date_of_birth', 'religion', 'phone_number', 'address', 'profile_picture', 'grade_id', 'department_id'];
    // protected $guarded = ['id', 'created_at', 'updated_at'];
    public function department()
    {
        return $this->belongsTo('App\model\Department');
    }
    public function grade()
    {
        return $this->belongsTo('App\model\Grade');
    }
    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
    // public function Operator()
    // {
    //     return $this->belongsToMany(Operator::class, 'transactions');
    // }
    public function getAvatar()
    {
        if ($this->profile_picture) {
            return asset('storage/profile_picture/' . $this->profile_picture);
        }
        if ($this->gender == 'Male') {
            return asset('storage/profile_picture/avatar-male.png');
        } else {
            return asset('storage/profile_picture/avatar-female.png');
        }
    }
}
