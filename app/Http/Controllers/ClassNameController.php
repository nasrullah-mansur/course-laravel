<?php

namespace App\Http\Controllers;

use App\Models\ClassName;
use App\Models\ClassTopic;
use App\Models\Course;
use Illuminate\Http\Request;

class ClassNameController extends Controller
{
    function index($course_id) {
        $courseName = Course::where('id', $course_id)->firstOrFail();
        $class_names = ClassName::where('course_id', $course_id)->orderBy('serial')->get();
        return view('back.course.class_name.index', compact('class_names', 'course_id', 'courseName'));
    }

    function store(Request $request) {
        $request->validate([
            'course_id' => 'required|numeric',
            'title' => 'required',
            'serial' => 'required|numeric'
        ]);

        $class_name = new ClassName();
        $class_name->course_id = $request->course_id;
        $class_name->title = $request->title;
        $class_name->serial = $request->serial;
        $class_name->save();

        return redirect()->route('admin.class.name.index', $request->course_id)->with('success', 'A New Class Name Added');
    }

    function all_update(Request $request) {
       
        if(isset($request->ids)) {
            foreach($request->ids as $key => $id) {
                $class_name = ClassName::where('id', $id)->firstOrFail();
                $exist = $request->titles[$key];

                if(!$exist) {
                    $class_name->delete();
                } else {
                    $class_name->title = $request->titles[$key];
                    $class_name->course_id = $request->course_ids[$key];
                    $class_name->serial = $request->serials[$key];
                    $class_name->save();
                }
            }
            return redirect()->route('admin.class.name.index', $request->course_ids[0])->with('success', 'All Items updated successfully');
        }

        return redirect()->back();
        
    }

    function delete(Request $request) {
        $class_name = ClassName::where('id', $request->id)->firstOrFail();
        

        $topics = ClassTopic::where('class_name_id', $class_name->id)->get();
        foreach($topics as $topic) {
            $topic->delete();
        }

        $class_name->delete();
    }
}
