

@extends('front.component.layout')
@section('component')
<div class="container">
    <h1 class="mb-3 mt-5 text-center">Reset Password</h1>
    <div class="auth-section">
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="form-group row mx-0">
                <div class="col-12 px-0">
                    <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                    <span class="pb-2 d-block text-success">{{ Session::get('status') }}</span>
                    <label class="col-12 mb-2 label-control text-bold-500">
                        Email
                        <input value="{{ old('email') }}" type="email" class="form-control" name="email" />
                        @if ($errors->has('email'))
                        <small class="text-danger">{{ $errors->first('email') }}</small>
                        @endif
                    </label>
                   
                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-success">Email Password Reset Link</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
