
@extends('front.component.layout')

@section('component')
<div class="container">
    <div class="profile-section">
        <h2 class="border-bottom pb-1">Profile Information</h2>
        <form action="">
            <div class="mb-2">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" >
            </div>
            
            <div class="mb-2">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>

    <div class="profile-section">
        <h2 class="border-bottom pb-1">Password Update</h2>
        <form action="">
                        
            <div class="mb-2">
                <div class="show-hide-password">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>

            <div class="mb-3">
                <div class="show-hide-password">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                </div>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
@endsection
