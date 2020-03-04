<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\Storage;

class User
{

    public static function userLogined()
    {
        $user = Auth::user();
        if ($user->role == 'admin' || $user->role == 'operator') {
            $data = array(
                'name' => $user->operator->name,
                'avatar' => call_user_func(
                    function () use ($user) {
                        if ($user->operator->profile_picture) {
                            return asset('storage/profile_picture/' . $user->operator->profile_picture);
                        } else {
                            if ($user->operator->gender == 'Male') {
                                return asset('storage/profile_picture/avatar-male.png');
                            }
                            return asset('storage/profile_picture/avatar-female.png');
                        }
                    }
                )
            );
            return $data;
        }

        $data = array(
            'name' => $user->student->name,
            'avatar' => call_user_func(
                function () use ($user) {
                    if ($user->student->profile_picture) {
                        return asset('storage/profile_picture/' . $user->student->profile_picture);
                    } else {
                        if ($user->student->gender == 'Male') {
                            return asset('storage/profile_picture/avatar-male.png');
                        }
                        return asset('storage/profile_picture/avatar-female.png');
                    }
                }
            )
        );

        return $data;
    }

    public static function getLabel($name)
    {
        $strName = explode('_', $name);
        return ucwords(implode(' ', $strName));
    }

    public static function uploadFile($request, $name, $imgName, $width = 500, $heigth = 500, $directory = "profile_picture")
    {
        $file = $request->file($name);
        //resize img with encode data;
        $image_resize = Image::make($file, $imgName)->fit($width, $heigth)->encode();
        //upload img
        Storage::disk('public')->put($directory . '/' . $imgName, $image_resize);
    }
    public static function getFileName($request, $name)
    {
        $file = $request->file($name);
        $temp = explode('.', $file->getClientOriginalName());
        $extension = end($temp);
        return md5(date('dmYhis') . $file->getClientOriginalName()) . '.' . $extension;
    }
}
