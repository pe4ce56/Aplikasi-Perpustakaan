<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    protected $fillable = ['user_id', 'name', 'gender', 'religion', 'place_of_birth', 'date_of_birth', 'phone_number', 'address', 'profile_picture'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


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
