@extends('back.layout.layout', [$title = 'Create a new course']);


@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title" id="basic-layout-square-controls">Create a new course</h4>
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
          <form class="form" action="{{route('course.store')}}" method="POST" enctype="multipart/form-data">
           
            @csrf
            <div class="form-body">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control square {{ $errors->has('name') ? 'is-invalid' : ''}} " placeholder="Name" name="name">
                @if ($errors->has('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
              </div>

              

              <fieldset class="form-group">
                <div class="image-preview hide" >
                    <img style="max-width: 120px;" src="{{ asset('back/images/gallery/1.jpg') }}" alt="image">
                </div>
                <label for="basicInputFile">Choose Image</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input image-input-show" id="image" name="image">
                  <label class="custom-file-label" for="image">Choose file</label>
                </div>
                @if($errors->has('image'))
                <small class="text-danger">{{ $errors->first('image') }}</small>
                @endif
              </fieldset>

              <fieldset class="form-group">
                <label for="title">Title</label>
                <textarea id="title" rows="5" class="form-control" name="title" placeholder="Title"></textarea>
                @if($errors->has('title'))
                <small class="text-danger">{{ $errors->first('title') }}</small>
                @endif
              </fieldset>

              <fieldset class="form-group">
                <label for="description">Description</label>
                <textarea id="description" rows="5" class="form-control" name="description" placeholder="Description"></textarea>
                @if($errors->has('description'))
                <small class="text-danger">{{ $errors->first('description') }}</small>
                @endif
              </fieldset>

              <div class="form-group">
                <label for="total_exam">Total Exam</label>
                <input type="number" id="total_exam" class="form-control square {{ $errors->has('total_exam') ? 'is-invalid' : ''}} " placeholder="Total Exam" name="total_exam">
                @if ($errors->has('total_exam'))
                    <small class="text-danger">{{ $errors->first('total_exam') }}</small>
                @endif
              </div>

              <div class="form-group">
                <label for="duration">Duration</label>
                <input type="text" id="duration" class="form-control square {{ $errors->has('duration') ? 'is-invalid' : ''}} " placeholder="Duration" name="duration">
                @if ($errors->has('duration'))
                    <small class="text-danger">{{ $errors->first('duration') }}</small>
                @endif
              </div>

              <div class="form-group">
                <label for="technologies">Technologies</label>
                <input type="text" id="technologies" class="form-control square {{ $errors->has('technologies') ? 'is-invalid' : ''}} " placeholder="Technologies" name="technologies">
                @if ($errors->has('technologies'))
                    <small class="text-danger">{{ $errors->first('technologies') }}</small>
                @endif
              </div>

              <div class="form-group">
                <label for="student_level">Student Lavel</label>
                <input type="text" id="student_level" class="form-control square {{ $errors->has('student_level') ? 'is-invalid' : ''}} " placeholder="Student Lavel" name="student_level">
                @if ($errors->has('student_level'))
                    <small class="text-danger">{{ $errors->first('student_level') }}</small>
                @endif
              </div>

              <div class="form-group">
                <label for="requirement">Requirement</label>
                <input type="text" id="requirement" class="form-control square {{ $errors->has('requirement') ? 'is-invalid' : ''}} " placeholder="Requirement" name="requirement">
                @if ($errors->has('requirement'))
                    <small class="text-danger">{{ $errors->first('requirement') }}</small>
                @endif
              </div>

              <fieldset class="form-group">
                <label for="meta">Meta</label>
                <textarea id="meta" rows="5" class="form-control" name="meta" placeholder="Meta"></textarea>
                @if($errors->has('meta'))
                <small class="text-danger">{{ $errors->first('meta') }}</small>
                @endif
              </fieldset>


              

              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="{{ STATUS_ACTIVE }}">Public</option>
                    <option value="{{ STATUS_INACTIVE }}">Save Draft</option>
                </select>
              </div>
                            
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary" style="margin-right: 5px; ">
                  <i class="fa fa-check-square-o"></i> Save
                </button>
              <button type="reset" class="btn btn-warning">
                <i class="ft-x"></i> Reset
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection