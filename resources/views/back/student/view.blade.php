@extends('back.layout.layout', [$title = "Student Attendance Info", $add_btn = 'Edit attendance', $add_btn_link = '#'])

@section('content')
<section>
   <!-- Bordered striped start -->
   <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Student Name: {{ $student->name }}</h4>
          <br>
          <p>Batch: {{ $batch->name }}</p>
          <p>Total Class: {{ $d_class->count() }}</p>
          <p>Total Present: {{ $student->present }}</p>
          <p>Total Absent: {{ $d_class->count() - ($student->present - $running_class_count)}}</p>
          <br>
          
          <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
          <div class="heading-elements">
            <ul class="list-inline mb-0">
              <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
              <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
              <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
              <li><a data-action="close"><i class="ft-x"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="card-content collapse show">
          
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Class No.</th>
                      <th>Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($d_class as $d)
                        <tr>
                            <td>Class No: {{$d->class_no}}</td>
                            <td>{{ $d->date }}</td>
                            <td>
                                @if (in_array($d->id, $student_attendance))
                                    Present
                                @else
                                Absent
                                @endif
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
            </div>
          
        </div>
      </div>
    </div>
  </div>
  <!-- Bordered striped end -->
  </section>



  <!-- Add Modal Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('student.attendance.update.by.admin') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Attendance Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-12 px-0">
                            
                            <label class="col-12 label-control text-bold-500">
                                Class No
                                <select name="class_no" class="form-control">
                                    @foreach ($d_class as $dc)
                                    <option value="{{ $dc->id }}">Class {{ $dc->class_no }}</option>
                                    @endforeach
                                </select>
                            </label>

                            <input type="hidden" value="{{ $student->id }}" name="student_id">
                            
                            <label class="col-12 label-control text-bold-500">
                                Attendance
                                <select name="attendance" class="form-control">
                                  <option value="p">Present</option>
                                  <option value="a">Absent</option>
                                </select>
                            </label>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Item</button>
                </div>
            </div>
        </form>
    </div>
</div>





@endsection


@push('db_js')
    
    <script>

        // Create;
        $('.content-header-right a').on('click', function () {
            $('#exampleModal').modal('show');
        })

        


     
     </script>
@endpush