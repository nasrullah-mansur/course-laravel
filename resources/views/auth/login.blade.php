
@extends('front.component.layout')
@section('component')

<div class="container">
    <h1 class="mb-3 mt-5 text-center">Log In</h1>
    <div class="auth-section">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group row mx-0">
                <div class="col-12 px-0">
                    
                    <label class="col-12 mb-2 label-control text-bold-500">
                        Email
                        <input value="{{ old('email') }}" type="email" class="form-control" name="email" />
                        @if ($errors->has('email'))
                        <small class="text-danger">{{ $errors->first('email') }}</small>
                        @endif
                    </label>
                    <label class="col-12 mb-2 label-control text-bold-500">
                        <div class="show-hide-password">
                            Password
                            <input type="password" class="form-control" name="password" />
                            @if ($errors->has('password'))
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                            @endif
                        </div>
                    </label>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Remember me 
                            </label>
                          </div>
                    </div>
                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-success">Log In</button>
                        <a class="forgot-link" href="{{ route('password.request') }}">Forgot you password?</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
