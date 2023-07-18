<?php

namespace App\Http\Controllers;

use App\Models\ClassName;
use App\Models\ClassTopic;
use Illuminate\Http\Request;

class ClassTopicController extends Controller
{
    function index($class_id) {
        $className = ClassName::where('id', $class_id)->firstOrFail();
        $class_topics = ClassTopic::where('class_name_id', $class_id)->orderBy('serial')->get();
        return view('back.course.class_topic.index', compact('class_topics', 'class_id', 'className'));
    }

    function store(Request $request) {
        $request->validate([
            'class_name_id' => 'required|numeric',
            'title' => 'required',
            'serial' => 'required|numeric',
        ]);

        $class_topic = new ClassTopic();
        $class_topic->class_name_id = $request->class_name_id;
        $class_topic->title = $request->title;
        $class_topic->serial = $request->serial;
        $class_topic->save();

        return redirect()->route('admin.class.topic.index', $request->class_name_id)->with('success', 'Class topic added successfully');
    }


    function all_update(Request $request) {
       
        if(isset($request->ids)) {
            foreach($request->ids as $key => $id) {
                $exist = $request->titles[$key];
                $class_name = ClassTopic::where('id', $id)->firstOrFail();

                if(!$exist) {
                    $class_name->delete();
                } else {
                    $class_name->title = $request->titles[$key];
                    $class_name->class_name_id = $request->class_name_ids[$key];
                    $class_name->serial = $request->serials[$key];
                    $class_name->save();
                }

            }
            return redirect()->route('admin.class.topic.index', $request->class_name_ids[0])->with('success', 'All Items updated successfully');
        } 

        return redirect()->back();
    }

    function delete(Request $request) {
        $class_topic = ClassTopic::where('id', $request->id)->firstOrFail();
        $class_topic->delete();
    }

}
