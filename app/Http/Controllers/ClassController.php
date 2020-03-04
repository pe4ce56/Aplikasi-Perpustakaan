<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = \App\model\Grade::all();
        $departments = \App\model\Department::all();
        return view('class.index', ['grades' => $grades, 'departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('class');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->__App == 'grade') {
            \App\model\Grade::create($request->all());
            alert()->success('Grade Successfully Created', 'Thank You !')->persistent('OK');
        } else {
            \App\model\Department::create($request->all());
            alert()->success('Department Successfully Created', 'Thank You !')->persistent('OK');
        }
        return redirect('class');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('class');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('class');
    }

    public function getDataGrade($id)
    {
        return json_encode(\App\model\Grade::find($id));
    }
    public function getDataDepartment($id)
    {
        return json_encode(\App\model\Department::find($id));
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
        if ($request->__App == 'grade') {
            $grade = \App\model\Grade::find($id);
            $grade->name = $request->name;
            $grade->update();

            alert()->success('Grade Successfully Updated', 'Thank You !')->persistent('OK');
        } else {
            $department = \App\model\Department::find($id);
            $department->name = $request->name;
            $department->update();

            alert()->success('Department Successfully Updated', 'Thank You !')->persistent('OK');
        }

        return redirect('class');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->__App == 'grade') {
            \App\model\Grade::destroy($id);
            alert()->success('Grade Successfully Deleted', 'Thank You !')->persistent('OK');
        } else {
            \App\model\Department::destroy($id);
            alert()->success('Department Successfully Deleted', 'Thank You !')->persistent('OK');
        }
        return redirect('class');
    }
}
