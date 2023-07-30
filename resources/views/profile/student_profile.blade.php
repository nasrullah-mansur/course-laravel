
@extends('front.component.layout')

@section('component')
<div class="container">
    <div class="profile-section">
        <h2 class="border-bottom pb-1">Profile Information</h2>
        <form action="{{route('student.profile_info.update')}}" method="POST">
            @csrf
            <div class="mb-2">
                <label for="name" class="form-label">Name</label>
                <input value="{{ $student->name }}" type="text" class="form-control" id="name" name="name" >
                @if ($errors->has('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>
            
            <div class="mb-2">
                <label for="email" class="form-label">Email address</label>
                <input value="{{ $student->email }}" type="email" class="form-control" id="email" name="email">
                @if ($errors->has('email'))
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                @endif
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input value="{{ $student->phone }}" type="text" class="form-control" id="phone" name="phone">
                @if ($errors->has('phone'))
                    <small class="text-danger">{{ $errors->first('phone') }}</small>
                @endif
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>

    <div class="profile-section">
        <h2 class="border-bottom pb-1">Password Update</h2>
        <form action="{{ route('student.password.update') }}" method="POST">
            @csrf                        
            <div class="mb-2">
                <div class="show-hide-password">
                    <span class="show-hide-icon more-down">SHOW</span>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @if ($errors->has('password'))
                        <small class="text-danger">{{ $errors->first('password') }}</small>
                    @endif
                </div>
            </div>

            <div class="mb-3">
                <div class="show-hide-password">
                    <span class="show-hide-icon more-down">SHOW</span>
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                    @if ($errors->has('confirm_password'))
                        <small class="text-danger">{{ $errors->first('confirm_password') }}</small>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>

    <div class="profile-section">
        <h2 class="border-bottom pb-1">Image Update</h2>
        <form action="{{route('student.image.update')}}" method="POST" enctype="multipart/form-data">
            @csrf                      
            
            <div class="mb-3 image-preview">
                <img width="150" src="{{ asset($student->image ? $student->image : 'back/images/portrait/small/avatar-s-1.png') }}" alt="">
                <div class="file-upload">
                    <label for="image" class="form-label">Select Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if ($errors->has('image'))
                        <small class="text-danger">{{ $errors->first('image') }}</small>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
@endsection
