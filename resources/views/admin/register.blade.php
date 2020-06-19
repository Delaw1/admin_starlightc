@extends('admin.layouts.defaultb')

@section('content')
<div class="main-card mb-3 card my-auto">
    <div class="card-body">
        @include('includes.success')
        @include('includes.error')
        <h5 class="card-title">Registration</h5>
        <form action="/register" method="post">
            @csrf
            <div class="form-row">
                <div class="col-md-6">
                    <div class="position-relative form-group"><label class="">First Name</label><input name="first_name" placeholder="First Name" type="text" class="form-control" required></div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative form-group"><label class="">Last Name</label><input name="last_name" placeholder="Last Name" type="text" class="form-control" required></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="position-relative form-group"><label class="">Email</label><input name="email" placeholder="Email" type="email" class="form-control" required></div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative form-group">
                        <label class="">Username</label>
                        <input name="username" placeholder="Username" type="text" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Select Department</label>
                <select class="form-control" name="department_id" required>
                    <option value="" disabled selected>Select one...</option>
                    @foreach($depts as $dept)
                    <option value="{{$dept->id}}">{{$dept->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="">Password</label>
                <input name="password" placeholder="Password" type="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="">Confirm Password</label>
                <input name="password_confirmation" placeholder="Password Confirmation" type="password" class="form-control" required>
            </div>
            <button class="mt-2 btn btn-primary">Sign up</button>
            <p>Already Registered? <a href="/login">Login to continue</a></p>
        </form>
    </div>
</div>

@endsection