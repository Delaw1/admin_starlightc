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
                <h5 class="card-title">Profile</h5>
                <form action="/edit_profile" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label class="">First Name</label><input name="first_name" value="{{ Auth::User()->first_name }}" type="text" class="form-control" required></div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label class="">Last Name</label><input name="last_name" value="{{ Auth::User()->last_name }}" type="text" class="form-control" required></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label class="">Email</label><input name="email" value="{{ Auth::User()->email }}" type="email" class="form-control" required></div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label class="">Username</label>
                                <input name="username" value="{{ Auth::User()->username }}" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <button class="mt-2 btn btn-primary">Edit Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

