<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::get();
        return response()->json($students);
        // return $students;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'name'      => 'required|min:4',
                'course'    => 'required',
                'email'     => 'required|email'
            ]);

            if ($validator->passes()) {
                $student            = new Student();
                $student->name      = $request->name;
                $student->course    = $request->course;
                $student->email     = $request->email;
                $student->phone     = $request->phone;
                $student->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Student added successfully',
                ],200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        try {
            $student = Student::where('id', $id)->first();
            return response()->json($student,200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {
            $validator = Validator::make($request->all(),[
                'name'      => 'required|min:4',
                'course'    => 'required',
                'email'     => 'required|email'
            ]);

            if ($validator->passes()) {
                $student            = Student::where('id', $id)->first();
                $student->name      = $request->name;
                $student->course    = $request->course;
                $student->email     = $request->email;
                $student->phone     = $request->phone;
                $student->save();
                // $student->update($request->all());

                return response()->json([
                    'status' => true,
                    'message' => 'Data updated successfully',
                ],200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        if($student) {
            $student->delete();
            return response()->json([
                'status'    => true,
                'message'   => 'Record deleted'
            ],200);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Record not found'
            ],404);
        }
    }
}
