@extends('back.layout.layout', [$title = 'New Admin Add'])

@section('content')
<section>
   <!-- Bordered striped start -->
   <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">New admin add</h4>
           
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
              <form action="{{ route('admins.store') }}" method="POST">
                @csrf
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
                        </label>
                        

                        <label class="col-12 label-control text-bold-500">
                            Status
                            <select name="status" class="form-control">
                              <option value="{{ STATUS_ACTIVE }}">Active</option>
                              <option value="{{ STATUS_INACTIVE }}">Inactive</option>
                            </select>
                        </label>

                        <div class="form-footer col-12 mt-3">
                            <button type="reset" class="btn btn-secondary" >Reset</button>
                            <button type="submit" class="btn btn-primary">Save Item</button>
                        </div>
                        
                    </div>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bordered striped end -->
  </section>



@endsection
