@extends('admin.layouts.sidebar')

@section('content')

<?php
if (Auth::User()->account_number == null) {
    $state = "Add";
} else {
    $state = "Edit";
}
?>

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
                <h5 class="card-title">{{ $state }} Account Details</h5>
                <form action="/account_details" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Enter Password</label>
                        <input name="current_password" type="password" class="form-control" required autofocus>

                    </div>
                    <div class="form-group">
                        <label for="account_name">Account Name</label>
                        <input name="account_name" value="{{ Auth::User()->account_name }}" type="text" class="form-control" required>

                    </div>
                    <div class="form-group">
                        <label for="account_number">Account Number</label>
                        <input name="account_number" value="{{ Auth::User()->account_number }}" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="bank_name">Bank Name</label>
                        <input id="bank_name" type="text" class="form-control" name="bank_name" required value="{{Auth::User()->bank_name}}">
                    </div>

                    <button class="mt-2 btn btn-primary">{{$state}} details</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection