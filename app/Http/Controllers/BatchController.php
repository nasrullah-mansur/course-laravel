<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\DClass;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    function index() {
        $batches = Batch::all();
        return view('back.batch.index', compact('batches'));
    }

    function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'starting_date' => 'required',
            'status' => 'required'
        ]);

        $batch = new Batch();
        $batch->name = $request->name;
        $batch->slug = Str::slug($request->name);
        $batch->starting_date = $request->starting_date;
        $batch->status = $request->status;
        $batch->save();

        return redirect()->route('batch.index')->with('success', 'Batch added successfully');
    }


    function update(Request $request) {
        $request->validate([
            'name' => 'required',
            'starting_date' => 'required',
            'status' => 'required'
        ]);

        $batch = Batch::where('id', $request->id)->firstOrFail();
        $batch->name = $request->name;
        $batch->slug = Str::slug($request->name);
        $batch->starting_date = $request->starting_date;
        $batch->status = $request->status;
        $batch->save();

        return redirect()->route('batch.index')->with('success', 'Batch updated successfully');
    }


    function delete(Request $request) {
        $batch = Batch::where('id', $request->id)->firstOrFail();

        $d_classes = DClass::where('batch_id', $batch->id)->get();

        if($d_classes->count() === 0) {
            $batch->delete();
        } else {
            return 'sorry';
        }

    }
}
