<?php

namespace App\Http\Requests;

use App\model\Student;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudent extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // User::
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'username' => 'required|unique:users',
            'email' => 'required|unique:users|email:rfc,dns',
            'NIS' => 'required|unique:students|numeric|digits_between:6,11',
            'name' => 'required|string',
            'gender' => 'required|not_in:0',
            'religion' => 'required|not_in:0',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required|date',
            'grade' => 'required|not_in:0',
            'department' => 'required|not_in:0',
            'phone_number' => 'required|numeric|digits_between:10,15',
        ];
        if ($this->isMethod('PUT')) {
            $student = Student::find($this->route('student'));
            $user = User::find($student->user_id);
            $rules['NIS'] = 'required|numeric|digits_between:6,11|unique:students,NIS,' . $student->id;
            $rules['email'] = 'required|email:rfc,dns|unique:users,email,' . $user->id;
            $rules['username'] = 'required|unique:users,username,' . $user->id;
        }
        return $rules;
    }
}
