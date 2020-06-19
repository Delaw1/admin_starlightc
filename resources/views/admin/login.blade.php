@extends('admin.layouts.defaultb')

@section('content')
<div class="card">
    <div class="card-body">
        @include('includes.success')
        @include('includes.error')
        <h5 class="card-title">Login</h5>
        <form action="/login" method="post">
        @csrf
            <div class="form-group"><label class="">Email</label><input name="email" placeholder="Email" type="email" class="form-control"></div>
            <div class="form-group"><label class="">Password</label><input name="password" placeholder="Password" type="pasword" class="form-control"></div>

            <button class="mt-2 btn btn-primary">Sign in</button>
            <p>Not Registered? <a href="/register">Register to continue</a></p>
        </form>
    </div>
</div> 
@endsection