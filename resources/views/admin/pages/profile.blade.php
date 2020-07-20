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
        <div class="container emp-profile">
            <div class="row">
                <div class="col-sm-4">
                    <div class="profile-img">
                        
                        <img id="img" src="{{ Auth::User()->picture ? ''.Auth::User()->picture : '/assets/images/avatars/1.jpg'}}" alt="" />
                        <div class="file btn btn-lg btn-primary">
                            Change Photo
                            <input onchange="changeProfilePicture()" type="file" id="picture" name="picture" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="profile-head">
                        <h5>
                            {{ Auth::User()->last_name }} {{ Auth::User()->first_name }}
                        </h5>
                        <p class="proile-rating">Completed Jobs : <span>{{ count($completed) }}/{{ count($total) }}</span></p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                        </ul>
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Username</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <p>{{ Auth::User()->username }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <p>{{ Auth::User()->last_name }} {{ Auth::User()->first_name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <p>{{ Auth::User()->email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Profession</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <p>{{ Auth::User()->role }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <button onclick="redirect('/edit_profile')" class="profile-edit-btn">Edit Profile</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">

                </div>
                <div class="col-sm-8">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="/js/code.js"></script>
@endsection