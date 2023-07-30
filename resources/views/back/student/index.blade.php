@extends('back.layout.layout', [$title = $batch->name, $add_btn = 'Add new student', $add_btn_link = '#'])

@section('content')
<section>
   <!-- Bordered striped start -->
   <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Batch No: {{ $batch->name }}</h4>
          <br>
          <p>Total Student: {{ $students->count() }}</p> 
          <p>Completed Classes: {{ $completed_class_count }}</p> 
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
                      <th>Image</th>
                      <th>Student Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Present</th>
                      <th>Absent</th>
                      <th>Join Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>
                                <img style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;" src="{{ asset($student->image ? $student->image : 'back/images/portrait/small/avatar-s-1.png') }}" alt="{{ $student->name }}">
                            </td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->present }}</td>
                            <td>{{ $completed_class_count - (($student->present) - $running_class_count) }}</td>
                            <td>{{ $student->created_at->format('d M Y') }}</td>
                            <td>{{ $student->status }}</td>
                            <td>
                                <div class="d-flex action-btn">
                                    <a data-id="{{ $student->id }}" data-name="{{ $student->name }}" data-email="{{ $student->email }}" data-phone="{{ $student->phone }}" class="btn btn-icon btn-success edit-item" style="margin-right: 5px;" href=""><i class="ft-edit"></i></a>
                                    <a data-id="{{ $student->id }}" class="btn btn-icon btn-info view-data" style="margin-right: 5px;" href="{{ route('student.attendance.info', [$batch->id, $student->id]) }}"><i class="ft-eye"></i></a> 
                                </div>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="paginate-area">
                    {{ $students->onEachSide(5)->links() }}
                </div>
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
        <form action="{{ route('student.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-12 px-0">
                            
                            <label class="col-12 label-control text-bold-500">
                                Name
                                <input type="text" class="form-control" placeholder="Name" name="name" />
                            </label>
                            <label class="col-12 label-control text-bold-500">
                                Email
                                <input type="email" class="form-control" placeholder="Email" name="email" />
                            </label>
                            <label class="col-12 label-control text-bold-500">
                                Phone
                                <input type="text" class="form-control" placeholder="Phone" name="phone" />
                                <input type="hidden" value="{{ $batch->slug }}" name="slug" />
                                <input type="hidden" value="{{ $batch->id }}" name="batch_id" />
                            </label>

                            <label class="col-12 label-control text-bold-500">
                                Status
                                <select name="status" class="form-control">
                                  <option value="{{ STATUS_ACTIVE }}">Active</option>
                                  <option value="{{ STATUS_INACTIVE }}">Inactive</option>
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
        <form action="{{ route('student.update.admin') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-12 px-0">
                            
                            <label class="col-12 label-control text-bold-500">
                                Name
                                <input type="text" class="form-control" placeholder="Name" name="name" />
                            </label>
                            <label class="col-12 label-control text-bold-500">
                                Email
                                <input type="email" class="form-control" placeholder="Email" name="email" />
                            </label>
                            <label class="col-12 label-control text-bold-500">
                                Phone
                                <input type="text" class="form-control" placeholder="Phone" name="phone" />
                                <input type="hidden" value="{{ $batch->slug }}" name="slug" />
                                <input type="hidden" value="{{ $batch->id }}" name="batch_id" />
                                <input type="hidden" name="id" />
                            </label>

                            <label class="col-12 label-control text-bold-500">
                                Status
                                <select name="status" class="form-control">
                                  <option value="{{ STATUS_ACTIVE }}">Active</option>
                                  <option value="{{ STATUS_INACTIVE }}">Inactive</option>
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

        // Edit;
        $('.edit-item').on('click', function (e) {
          e.preventDefault();
          let dataId = $(this).attr("data-id");
          let sName = $(this).attr("data-name");
          let sEmail = $(this).attr("data-email");
          let sPhone = $(this).attr("data-phone");

          $('#editModal [name="id"]').val(dataId);
          $('#editModal [name="name"]').val(sName);
          $('#editModal [name="email"]').val(sEmail);
          $('#editModal [name="phone"]').val(sPhone);


            $('#editModal').modal('show');
        })


     
     </script>
@endpush