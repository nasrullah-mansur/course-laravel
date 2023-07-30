@extends('back.layout.layout', [$title = 'All Batches', $add_btn = 'Add new batch', $add_btn_link = '#'])

@section('content')
<section>
   <!-- Bordered striped start -->
   <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">ALL BATCHES</h4>
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
          
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Starting Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($batches as $batch)
                <tr>
                  <th>{{ $loop->iteration }}</th>
                  <td>{{ $batch->name }}</td>
                  <td>{{ $batch->starting_date }}</td>
                  <td>{{ $batch->status }}</td>
                  <td>
                    <div class="d-flex action-btn">
                      <a data-id="{{ $batch->id }}" data-name="{{ $batch->name }}" data-starting_date="{{ $batch->starting_date }}" class="btn btn-icon btn-success edit-item" style="margin-right: 5px;" href=""><i class="ft-edit"></i></a> 
                  </div>
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
  <!-- Bordered striped end -->
  </section>



  <!-- Add Modal Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('batch.store') }}" method="POST">
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
                                Starting Date
                                <input type="text" class="form-control" placeholder="dd/mm/yyyy" name="starting_date" />
                            </label>
                            <label class="col-12 label-control text-bold-500">
                                Status
                                <select name="status" class="form-control">
                                    <option value="{{STATUS_ACTIVE}}">Active</option>
                                    <option value="{{ STATUS_INACTIVE }}">Inctive</option>
                                    <option value="{{ STATUS_COMPLETED }}">Completed</option>
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
        <form action="{{ route('batch.update') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
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
                                <input type="hidden" name="id" />
                            </label>
                            <label class="col-12 label-control text-bold-500">
                                Starting Date
                                <input type="text" class="form-control" placeholder="dd/mm/yyyy" name="starting_date" />
                            </label>
                            <label class="col-12 label-control text-bold-500">
                                Status
                                <select name="status" class="form-control">
                                  <option value="{{STATUS_ACTIVE}}">Active</option>
                                  <option value="{{ STATUS_INACTIVE }}">Inctive</option>
                                  <option value="{{ STATUS_COMPLETED }}">Completed</option>
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
          let dataName = $(this).attr("data-name");
          let dataStartingDate = $(this).attr("data-starting_date");

          $('#editModal [name="id"]').val(dataId);
          $('#editModal [name="name"]').val(dataName);
          $('#editModal [name="starting_date"]').val(dataStartingDate);


            $('#editModal').modal('show');
        })


         
     
     </script>
@endpush