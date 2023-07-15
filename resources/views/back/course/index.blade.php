@extends('back.layout.layout', [$title = 'All Course', $add_btn = 'Add new course', $add_btn_link = route('course.create')])

@section('content')
<section id="html5">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">All Course</h4>
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
            <div class="card-body card-dashboard main-content">
                <div class="row">
                                        

                    @foreach ($courses as $course)
                    <div class="col-lg-4">
                        <div class="card borderd" >
                            <div class="card-content">
                              <div class="card-body">
                                <a href="#">
                                    <img class="card-img img-fluid mb-1" src="{{asset($course->image)}}" alt="{{$course->name}}">
                                </a>
                                <h3 class="text-center">
                                    <a href="#">{{$course->name}}</a>
                                </h3>
                                <div class="text-center ">
                                    <a href="{{route('admin.class.name.index', $course->id)}}">Add Classes</a>
                                    <span>|</span>
                                    <a href="{{route('course.edit', $course->id)}}" class="text-warning">Edit</a>
                                    <span>|</span>
                                    <a data-id="{{$course->id}}" href="#" class="text-danger delete-data">Delete</a>
                                </div>
                                
                              </div>
                            </div>
                          </div>
                    </div>
                    @endforeach
                    
                    
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


@push('db_js')
    
    <script>
        
         // Delete Data;
         $('.main-content').on('click', '.delete-data', function(e) {
             e.preventDefault();
             let deleteRoute = "{{ route('course.delete') }}";
                 let delteteDataId = $(this).attr("data-id");
                 swal({
                     title: "Are you sure?",
                     text: "You will not be able to recover this imaginary item!",
                     icon: "warning",
                     showCancelButton: true,
                     buttons: {
                         cancel: {
                             text: "No, cancel please!",
                             value: null,
                             visible: true,
                             className: "btn-warning",
                             closeModal: false,
                         },
                         confirm: {
                             text: "Yes, delete it!",
                             value: true,
                             visible: true,
                             className: "",
                             closeModal: false,
                         },
                     },
                 }).then((isConfirm) => {
                     if (isConfirm) {
                         $.ajax({
                             type: "POST",
                             url: deleteRoute,
                             data: {
                                 id: delteteDataId,
                             },
                             success: function(response){
                              swal({
                                        icon: "success",
                                        title: "Deleted!",
                                        text: "Your imaginary file has been deleted.",
                                        showConfirmButton: true,
                                        closeModal: false,
                                    });
        
                                    setTimeout(() => {
                                        location.reload();
                                    }, 3000);
                                 
                             }
                         });
                     } else {
                         swal({
                             icon: "error",
                             title: "Cancelled!",
                             text: "Your imaginary file is safe :",
                             timer: 2000,
                             showConfirmButton: true,
                         });
                     }
                 });
         });
     
     </script>
@endpush