<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\model\Student;
use Illuminate\Support\Facades\Hash;
use Exception;
use App\Http\Requests\StoreStudent;
use App\Helpers\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use UxWeb\SweetAlert\SweetAlert;

class StudentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('department')->with('grade')->get();

        return view('students.students', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $grades = \App\model\Grade::all();

        $gradesView = [];

        foreach ($grades as $grade) {
            $gradesView[$grade->id] = $grade->name;
        }

        $departments = \App\model\Department::all();
        foreach ($departments as $department) {
            $departmentsView[$department->id] = $department->name;
        }
        $data = [
            'grades' => $gradesView,
            'departments' => $departmentsView
        ];
        return view('students.create_student', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudent $request)
    {
        try {
            // save to user for login
            $user = new \App\User;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make("stemdasi");
            $user->role = "student";
            $user->save();
            // add to tbl student
            $request->request->add(['user_id' => $user->id]);
            $imgName = '';
            if ($request->file('profile_picture')) {
                $imgName = User::getFileName($request, 'profile_picture');
                User::uploadFile($request, 'profile_picture', $imgName);
            }
            $request['profile_picture'] = $imgName;
            $request['department_id'] = $request->department;
            $request['grade_id'] = $request->grade;

            Student::create($request->all());
            alert()->success('Student Created Successfully', 'Thank You!')->persistent('Ok');
            return redirect('/students');
        } catch (Exception $e) {

            alert()->success('Student Failed to Create', 'Oops!')->persistent('Ok');
            return redirect('/students');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        if ($student) {
            $user = \App\User::find($student->user_id);
            if ($student) {
                return view('students.show_student', ['student' => $student, 'user' => $user]);
            } else {
                return redirect('students');
            }
        } else {
            return redirect('students');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // storeData to comboBox
        $student = Student::with('grade')->with('department')->find($id);
        if ($student) {
            $grades = \App\model\Grade::all();
            $gradesView = [];
            foreach ($grades as $grade) {
                $gradesView[$grade->id] = $grade->name;
            }
            $departments = \App\model\Department::all();
            foreach ($departments as $department) {
                $departmentsView[$department->id] = $department->name;
            }
            //getting data

            $user = \App\User::find($student->user_id);

            $data = [
                'user' => $user,
                'student' => $student,
                'grades' => $gradesView,
                'departments' => $departmentsView
            ];
            return view('students.edit_student', $data);
        } else {
            return redirect('students');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStudent $request, $id)
    {

        $student = Student::find($id);

        $rules = \App\User::validation($student->user_id);

        try {

            $student->NIS = $request->NIS;
            $student->name = $request->name;
            $student->gender = $request->gender;
            $student->religion = $request->religion;
            $student->place_of_birth = $request->place_of_birth;
            $student->date_of_birth = $request->date_of_birth;
            $student->phone_number = $request->phone_number;
            $student->address = $request->address;
            $student->department_id = $request->department;
            $student->grade_id = $request->grade;
            //if image changed
            if ($request->file('profile_picture')) {
                $imgName = User::getFileName($request, 'profile_picture');
                if (Storage::exists('public/profile_picture/' . $student->profile_picture)) {
                    Storage::disk('public')->delete("profile_picture/" . $student->profile_picture);
                }
                User::uploadFile($request, 'profile_picture', $imgName);
                $student->profile_picture = $imgName;
            }
            $student->update();
            $user = \App\User::find($student->user_id);
            $user->username = $request->username;
            $user->email = $request->email;
            $user->update();
            alert()->success('Student Updated Successfully', 'Thank You!')->persistent('OK');
            return redirect('/students');
        } catch (Exception $e) {

            alert()->error('Student Failed to Update', 'Oops!')->persistent('OK');
            return redirect('/students');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $student =  Student::find($id);
            if (Storage::exists('public/profile_picture/' . $student->profile_picture)) {

                Storage::disk('public')->delete("profile_picture/" . $student->profile_picture);
            }
            $user = \App\User::find($student->user_id);
            $student->delete();
            $user->delete();
            alert()->success('Student Deleted Successfully', 'Thank You!')->persistent('OK');
            return redirect('/students');
        } catch (Exception $e) {
            alert()->error('Student Failed to Delete', 'Oops!')->persistent('OK');
            return redirect('/students');
        }
    }

    public function myProfile()
    {
        $student = auth()->user()->student;
        return view('students.show_student', ['student' => $student]);
    }


    public function getStudents(Request $request)
    {
        $search = $request->term;
        try {
            $students = Student::where('name', 'like', "%$search%")->orWhere('NIS', 'like', "%$search%")->get();
            $setRow = [];
            if ($students) {
                foreach ($students as $student) {

                    $row['label'] = $student->NIS;
                    $row['id'] = $student->id;
                    $row['NIS'] = $student->NIS;
                    $row['name'] = $student->name;
                    if ($student->profile_picture) {
                        $row['image'] = asset('storage/profile_picture') .  $student->profile_picture;
                    } else {
                        $row['image'] = asset('storage/profile_picture/avatar-female.png');
                        if ($student->gender == 'Male') {
                            $row['image'] = asset('storage/profile_picture/avatar-male.png');
                        }
                    }
                    $setRow[] = $row;
                }
            }
            return json_encode($setRow);
        } catch (Exception $e) {
            return $e;
        }
    }
}
