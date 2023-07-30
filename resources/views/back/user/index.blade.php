@extends('back.layout.layout', [$title = 'Admin Panel', $add_btn = 'Add new admin', $add_btn_link = route('admins.create')])

@section('content')
<section>
   <!-- Bordered striped start -->
   <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Admin Panel</h4>
           
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
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Status</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->phone ? $admin->phone : 'Empty' }}</td>
                        <td>{{ $admin->status }}</td>
                        <td>{{ $admin->created_at->format('d M Y') }}</td>
                        <td>
                          @if (Auth::user()->email === $admin->email)
                          <span class="btn btn-icon btn-success">YOU</span>
                            
                            @else
                            <a class="btn btn-icon btn-success edit-item" style="margin-right: 5px;" href="{{ route('admins.edit', $admin->id) }}"><i class="ft-edit"></i></a>
                            <a data-id="{{ $admin->id }}" class="btn btn-icon btn-danger delete-data" style="margin-right: 5px;" href="#"><i class="ft-trash-2"></i></a>
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



@endsection
