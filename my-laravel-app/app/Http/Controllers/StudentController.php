<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Validate\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();

        return view ('student.index', compact ('studentss'));
    }

    public function create()
    {
        return view ('student.create');
    }
    
    public function store(Request $request)
    {
        $validated =$request->validate ([
            'student_number'=>
            'required|string|max:50|unique:students.student_number',
            'first_name'=> 'required|string|max:255',
            'last_name'=> 'required|string|max:255',
            'email'=> 'required|string|max:255|unique:student,email',
            'course'=> 'required|string|max:255',
        ]);
            Student:create($validated);

            return redirect()->route('student.index')
            ->with ('success', 'Student added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view ('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view ('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'student_number'=>[
                'requred',
                'string',
                'max:50',
                Rule:: unique('students','student_number')->ignore($student->id),
            ],
            'first_name'=> 'required|string|max:255',
            'last_name'=> 'required|string|max:255',
            'email'=>[
                'required',
                'email' => [
                    'required',
                    'string',
                    'max:50',
                    Rule::unique('students', 'student_number')->ignore($student->id),
                ],
                'first_name'=>'required|string|max:255',
                'last_name'=>'required|string|max:255',
                'email'=> [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('students','email')->ignore($student->id),
                ],
                    'course'=> 'required|string|max:255',
            ]
        ]);
            $student->update($validated);

            return redirect()->route('student.index')
            ->with('success','student updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('student.index')
        ->with ('success','student deleted successfully!');
    }
}
