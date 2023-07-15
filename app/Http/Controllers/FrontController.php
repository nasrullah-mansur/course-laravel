<?php

namespace App\Http\Controllers;

use App\Models\ClassName;
use App\Models\Course;

class FrontController extends Controller
{
    function index() {
        $courses = Course::all();
        return view('welcome', compact('courses'));
    }

    function course($slug) {
        $course = Course::where('slug', $slug)->firstOrFail();

        $classes = ClassName::with('topics')
        ->where('course_id', $course->id)
        ->orderBy('serial')
        ->get();

        return view('front.course', compact('classes', 'course'));
    }
}
