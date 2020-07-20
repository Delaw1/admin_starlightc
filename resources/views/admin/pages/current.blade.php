@extends('admin.layouts.sidebar')

@section('content')

<div class="app-main__outer">
    <div class="app-main__inner">
        @if($stat->current)
        @include('includes.success')
        @include('includes.error')
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                    <h5 class="card-title">{{ $stat->order->title }}</h5>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                    <!-- <div class="card mb-3 widget-content bg-premium-dark">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Price</div>
                                <div class="widget-subheading"></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-warning"><span>${{ $stat->order->price }}</span></div>
                            </div>
                        </div>
                    </div> -->
                </div>
                </div>
               
                
                @if($stat->submitted)
                <div class="mb-2 mr-2 badge badge-info">Awaiting admin approval</div>
                @endif
                <p>
                    {{ $stat->order->description}}
                </p>
                <form action="/submitfile" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="position-relative row form-group">
                        <label class="col-sm-2 col-form-label">File</label>
                        <div class="col-sm-10">
                            <input name="project" type="file" class="form-control-file" required>
                            <small class="form-text text-muted">Submit the completed project to the admin</small>
                        </div>
                    </div>
                    <button class="mt-2 btn btn-primary">Submit to admin</button>
                </form>
            </div>
        </div>
        @else
        <div class="card-body">
            <h5 class="card-title">No Active Project</h5>
            <p>
                Await
            </p>
        </div>
        @endif
    </div>
</div>

@endsection