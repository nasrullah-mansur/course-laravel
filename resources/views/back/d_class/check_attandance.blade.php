@extends('back.layout.layout')

@section('content')
<section>
   <!-- Bordered striped start -->
   <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Batch No: {{ $batch->name }}</h4>
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
                      <th>Student Name</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($batch->students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>

                                @php
                                    $student_attendance = $student->attendance ? json_decode($student->attendance) : [];

                                    if(in_array($class_id, $student_attendance)) {
                                        echo('<span class="text-success">Present</span>');
                                    } else {
                                        echo('<span class="text-danger">Absent</span>');
                                    }

                                @endphp

                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="paginate-area">
                
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
        <form action="{{ route('d.class.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Class</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-12 px-0">
                            
                            <label class="col-12 label-control text-bold-500">
                                Class No
                                <input type="number" class="form-control" placeholder="Class No" name="class_no" />
                            </label>
                            <label class="col-12 label-control text-bold-500">
                                Date
                                <input type="text" class="custom-datepicker form-control" placeholder="dd/mm/yyyy" name="date" />
                                <input type="hidden" name="batch_id" value="{{$batch->id}}">
                            </label>
                            <label class="col-12 label-control text-bold-500">
                                Status
                                <select name="status" class="form-control">
                                    <option value="{{ CLASS_START }}">Start</option>
                                    <option value="{{ CLASS_END }}">End</option>
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

  <!-- Edit Modal Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('d.class.update') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Class Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-12 px-0">
                            
                            <label class="col-12 label-control text-bold-500">
                                Class No
                                <input type="number" class="form-control" placeholder="Class No" name="class_no" />
                            </label>
                            <label class="col-12 label-control text-bold-500">
                                Date
                                <input type="text" class="custom-datepicker form-control" placeholder="dd/mm/yyyy" name="date" />
                                <input type="hidden" name="batch_id" value="{{$batch->id}}">
                                <input type="hidden" name="id">
                            </label>
                            <label class="col-12 label-control text-bold-500">
                                Status
                                <select name="status" class="form-control">
                                  <option value="{{ CLASS_START }}">Start</option>
                                  <option value="{{ CLASS_END }}">End</option>
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



  <!-- Edit Modal Modal -->
  <div class="modal fade" id="presentModel" tabindex="-1" aria-labelledby="presentModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="presentModelLabel">Class Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td><strong>Total Student</strong></td>
                            <td>{{ $batch->students->count() }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total Presents</strong></td>
                            <td id="total_presents">0</td>
                        </tr>
                        <tr>
                            <td><strong>Total Absents</strong></td>
                            <td id="total_absents">0</td>
                        </tr>
                    </table>
                  </div>
                  <div class="text-center">
                    <a href="#" class="btn btn-primary">View Details</a>
                  </div>
            </div>
            
        </div>
    </div>
</div>




@endsection


@push('db_js')
    
    <script>

        // Create;
        $('.content-header-right a').on('click', function () {
            $('#exampleModal').modal('show');
        })

        // View Data;
        $('.view-data').on('click', function () {
            
            let b_id = "{{ $batch->id }}";
            let c_id = $(this).attr("data-id");

            $.ajax({
                method: 'POST',
                url: "{{ route('total.student') }}",
                data: {b_id, c_id },
                success: function(response) {
                    console.log(response);
                    $('#total_presents').text(response.total_presents);
                    $('#total_absents').text(response.total_absents);

                    $('#presentModel').modal('show');
                },
                error: function(error) {
                    console.log(error);
                }
            });

        })

        // Edit;
        $('.edit-item').on('click', function (e) {
          e.preventDefault();
          let dataId = $(this).attr("data-id");
          let classNo = $(this).attr("data-class_no");
          let date = $(this).attr("data-date");

          $('#editModal [name="id"]').val(dataId);
          $('#editModal [name="class_no"]').val(classNo);
          $('#editModal [name="date"]').val(date);


            $('#editModal').modal('show');
        })


     
     </script>
@endpush