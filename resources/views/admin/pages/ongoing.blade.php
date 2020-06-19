@extends('admin.layouts.sidebar')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner"> 
        @if(count($projects) > 0)
        @include('includes.success')
        @include('includes.error')
        @foreach($projects as $project)
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                    <h5 class="card-title">{{ $project->title }}</h5>
                    <p>User: {{ $project->user->first_name }} {{ $project->user->last_name }}</p>
                    <p>Writer: {{ $project->writer->first_name }} {{ $project->writer->last_name }}</p>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-premium-dark">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Price</div>
                                <div class="widget-subheading"></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-warning"><span>${{ $project->price }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
               
                
        
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.
                    {{ $project->description}}
                </p>
            </div>
        </div>
        @endforeach
        @else
        <div class="card-body">
            <h5 class="card-title">No Ongoing Project</h5>
            <p>
                Await
            </p>
        </div>
        @endif
    </div>
</div>
@endsection