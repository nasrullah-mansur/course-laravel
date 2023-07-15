<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    function index() {
        $courses = Course::all();
        return view('back.course.index', compact('courses'));
    }

    function create() {
        return view('back.course.create');
    }

    function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'title' => 'required',
            'description' => 'required',
            'total_exam' => 'required',
            'duration' => 'required',
            'technologies' => 'required',
            'student_level' => 'required',
            'requirement' => 'required',
        ]);

        $course = new Course();
        $course->name = $request->name; 
        $course->slug = Str::slug($request->name); 
        $course->image = ImageUpload($request->image, COURSE_IMAGE); 
        $course->title = $request->title; 
        $course->description = $request->description; 
        $course->total_exam = $request->total_exam; 
        $course->duration = $request->duration; 
        $course->technologies = $request->technologies; 
        $course->student_level = $request->student_level; 
        $course->requirement = $request->requirement; 
        $course->status = $request->status; 
        $course->meta = $request->meta; 
        $course->save();

        return redirect()->route('course.index')->with('success', 'Course added successfully');
    }

    function edit($id) {
        $course = Course::where('id', $id)->firstOrFail();
        return view('back.course.edit', compact('course'));
    }

    function update(Request $request, $id) {
        $course = Course::where('id', $id)->firstOrFail();

        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'total_exam' => 'required',
            'duration' => 'required',
            'technologies' => 'required',
            'student_level' => 'required',
            'requirement' => 'required',
        ]);

        

        $course->name = $request->name; 
        $course->slug = Str::slug($request->name); 
        if($request->hasFile('image')) {
            $course->image = ImageUpload($request->image, COURSE_IMAGE, $course->image); 
        }
        $course->title = $request->title; 
        $course->description = $request->description; 
        $course->total_exam = $request->total_exam; 
        $course->duration = $request->duration; 
        $course->technologies = $request->technologies; 
        $course->student_level = $request->student_level; 
        $course->requirement = $request->requirement; 
        $course->status = $request->status; 
        $course->meta = $request->meta; 
        $course->save();

        return redirect()->route('course.index')->with('success', 'Course updated successfully');
    }

    function delete(Request $request) {
        $course = Course::where('id', $request->id)->firstOrFail();
        removeImage($course->image);
                
        $course->delete();
    }
}
