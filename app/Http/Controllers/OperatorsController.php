<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Operator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class OperatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operators = Operator::with('user')->orderBy('name')->get();
        return view('operators.operators', ['operators' => $operators]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operators.create_operator');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new \App\User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make('admin');
        $user->role = $request->role;
        $user->save();
        $imgName = '';
        $request->request->add(['user_id' => $user->id]);
        if ($request->file('profile_picture')) {
            $imgName = \App\Helpers\User::getFileName($request, 'profile_picture');
            \App\Helpers\User::uploadFile($request, 'profile_picture', $imgName);
        }
        $request['profile_picture'] = $imgName;
        Operator::create($request->all());
        alert()->success('Operator Created Successfully', 'Thank You!')->persistent('Ok');
        return redirect('/operators');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $operator = Operator::find($id);
        return view('operators.show_operator', ['operator' => $operator]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $operator = Operator::with('user')->find($id);
        // dd($operator);
        return view('operators.edit_operator', ['operator' => $operator]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $operator = Operator::find($id);
        // dd($operator);
        $operator->name = $request->name;
        $operator->gender = $request->gender;
        $operator->religion = $request->religion;
        $operator->place_of_birth = $request->place_of_birth;
        $operator->date_of_birth = $request->date_of_birth;
        $operator->phone_number = $request->phone_number;
        $operator->address = $request->address;
        //if image changed
        if ($request->file('profile_picture')) {
            $imgName = \App\Helpers\User::getFileName($request, 'profile_picture');
            if (Storage::exists('public/profile_picture/' . $operator->profile_picture)) {
                Storage::disk('public')->delete("profile_picture/" . $operator->profile_picture);
            }
            \App\Helpers\User::uploadFile($request, 'profile_picture', $imgName);
            $operator->profile_picture = $imgName;
        }
        $operator->update();

        $user = \App\User::find($operator->user_id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->update();
        alert()->success('Operator Updated Successfully', 'Thank You!')->persistent('Ok');
        return redirect('/operators');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operator = Operator::find($id);
        if (Storage::exists('public/profile_picture/' . $operator->profile_picture)) {
            Storage::disk('public')->delete("profile_picture/" . $operator->profile_picture);
        }
        \App\User::destroy($operator->user_id);
        $operator->delete();
        alert()->success('Operator Deleted Successfully', 'Thank You!')->persistent('Ok');
        return redirect('/operators');
    }
}
