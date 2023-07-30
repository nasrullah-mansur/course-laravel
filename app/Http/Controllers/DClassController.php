<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\DClass;
use Illuminate\Http\Request;

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
        $batch = Batch::where('slug', $slug)->firstOrFail();

        $d_classes = DClass::where('batch_id', $batch->id)->orderBy('created_at', 'DESC')->paginate(20);

        return view('back.d_class.index', compact('d_classes', 'batch'));
    }
}
