<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return student::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> "required|string",
            "email"=>"required|email|unique:students",
            "address"=>"required|min:6"
        ]);

        // return $request->all();

        return student::create(["name"=>$request->name,"email"=>$request->email,"address"=>$request->address]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return student::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = student::find($id);
        $request->validate([
            "name"=> "required|string",
            "email"=>"required|email",
            "address"=>"required|min:6"
        ]);
        return $student->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = student::find($id);
        return $student->delete($id);
    }
}
