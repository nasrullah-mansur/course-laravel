@extends('back.layout.layout', [$title = $batch->name, $add_btn = 'Add new class', $add_btn_link = '#'])

@section('content')
<section>
   <!-- Bordered striped start -->
   <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Batch No: {{ $batch->name }}</h4>
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
                      <th>Class No</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($d_classes as $d_class)
                        <tr>
                            <td>Class No: {{ $d_class->class_no }}</td>
                            <td>{{ $d_class->date }}</td>
                            <td>{{ $d_class->status }}</td>
                            <td>
                                <div class="d-flex action-btn">
                                    <a data-id="{{ $d_class->id }}" data-date="{{ $d_class->date }}" data-class_no="{{ $d_class->class_no }}" class="btn btn-icon btn-success edit-item" style="margin-right: 5px;" href=""><i class="ft-edit"></i></a>
                                    <a data-id="{{ $d_class->id }}" class="btn btn-icon btn-info view-data" style="margin-right: 5px;" href="#"><i class="ft-eye"></i></a> 
                                </div>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="paginate-area">
                {{ $d_classes->onEachSide(5)->links() }}
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Class Info</h5>
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
          let classNo = $(this).attr("data-class_no");
          let date = $(this).attr("data-date");

          $('#editModal [name="id"]').val(dataId);
          $('#editModal [name="class_no"]').val(classNo);
          $('#editModal [name="date"]').val(date);


            $('#editModal').modal('show');
        })


     
     </script>
@endpush