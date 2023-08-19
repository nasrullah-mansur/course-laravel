<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\DClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DClassController extends Controller
{
    function index() { // this is search page, index page bellow;
        $batches = Batch::orderBy('created_at', 'DESC')->get();
        return view('back.d_class.find_classes', compact('batches'));
    }

    function store(Request $request) {
        $request->validate([
            'batch_id' => 'required',
            'class_no' => 'required|numeric',
            'date' => 'required',
            'status' => 'required'
        ]);

        $batch = Batch::where('id', $request->batch_id)->firstOrFail();

        $d_class = new DClass();
        $d_class->batch_id = $request->batch_id;
        $d_class->class_no = $request->class_no;
        $d_class->date = $request->date;
        $d_class->status = $request->status;
        $d_class->save();


        return redirect()->route('d.class.get.classes', $batch->slug)->with('success', 'New class added successfully');
    }


    function update(Request $request) {

        $request->validate([
            'batch_id' => 'required',
            'class_no' => 'required|numeric',
            'date' => 'required',
            'status' => 'required'
        ]);

        $batch = Batch::where('id', $request->batch_id)->firstOrFail();

        $d_class = DClass::where('id', $request->id)->firstOrFail();
        $d_class->batch_id = $request->batch_id;
        $d_class->class_no = $request->class_no;
        $d_class->date = $request->date;
        $d_class->status = $request->status;
        $d_class->save();


        return redirect()->route('d.class.get.classes', $batch->slug)->with('success', 'New class added successfully');
    }




    function find_classes(Request $request) {
        $id = $request->batch_id;
        $batch = Batch::where('id', $id)->firstOrFail();
        return redirect()->route('d.class.get.classes', $batch->slug);
    }

    function get_classes($slug) { // this is main index view;
       $batch = Batch::with('students')->where('slug', $slug)->firstOrFail();
        
      $d_classes = DClass::where('batch_id', $batch->id)
       ->orderBy('created_at', 'DESC')
       ->paginate(20);

        return view('back.d_class.index', compact('d_classes', 'batch'));
    }

    // Daily Class Info;
    function total_student(Request $request) {
        $batch_id = $request->b_id;
        $class_id = $request->c_id;

        $total_present = 0;

        $students = Student::where('batch_id', $batch_id)->get();

        foreach($students as $item) {
            $att = $item->attendance;

            if($att != null) {
                if(in_array($class_id, json_decode($att))) {
                    $total_present = $total_present + 1;
                }
            }

        }

        $data = [
            'total_presents' => $total_present,
            'total_absents' => $students->count() - $total_present
        ];

        return $data;
    }

    function class_attendance ($batch_id, $class_id) {
        $batch = Batch::with('students')->where('id', $batch_id)->firstOrFail();

        return view('back.d_class.check_attandance', compact('batch', 'class_id'));
    }
}
