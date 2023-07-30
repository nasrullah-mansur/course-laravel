@extends('front.component.layout')
@section('component')

<div class="container">
    <h1 class="mb-3 mt-5 text-center">Reset Password</h1>
    <div class="auth-section">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-group row mx-0">
                <div class="col-12 px-0">
                    
                    <label class="col-12 mb-2 label-control text-bold-500">
                        Email
                        <input value="{{ old('email') ?? $request->email }}" type="email" class="form-control" name="email" />
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
                    <label class="col-12 mb-2 label-control text-bold-500">
                        <div class="show-hide-password">
                            Confirm Password
                            <input type="password" class="form-control" name="password_confirmation" />
                            @if ($errors->has('password_confirmation'))
                            <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                            @endif
                        </div>
                    </label>
                    
                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-success">Reset Password</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
