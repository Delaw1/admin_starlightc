@extends('admin.layouts.sidebar')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>
                    </div>
                </div>

            </div>
        </div>
        <div class="main-card mb-3 card my-auto">
            <div class="card-body">
                @include('includes.success')
                @include('includes.error')
                <h5 class="card-title">Password</h5>
                <form action="/change_password" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="">Enter Current Password</label>
                        <input name="current_password" placeholder="Old Password" type="password" class="form-control" required>
                        
                    </div>
                    <div class="form-group">
                        <label class="">Enter New Password</label>
                        <input name="new_password" placeholder="New Password" type="password" class="form-control" required>
                        
                    </div>
                    <div class="form-group">
                        <label class="">Confirm New Password</label>
                        <input name="new_password_confirmation" placeholder="Confirm new password" type="password" class="form-control" required>
                    </div>

                    <button class="mt-2 btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection