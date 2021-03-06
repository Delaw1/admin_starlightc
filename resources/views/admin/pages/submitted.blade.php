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
                    <h5 class="card-title">{{ $project->order->title }}</h5>
                    <p>User: {{ $project->order->user->first_name }} {{ $project->order->user->last_name }}</p>
                    <p>Writer: {{ $project->order->writer->first_name }} {{ $project->order->writer->last_name }}</p>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-premium-dark">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Price</div>
                                <div class="widget-subheading"></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-warning"><span>${{ $project->order->price }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
               
                
        
                <p>
                    {{ $project->order->description}}
                </p>
                <a href="/storage/{{$project['filepath']}}" download="{{$project->order->title}}"><i class="fa fa-download"></i></a>
                @if($project->order->user_id == Auth::User()->id)
                <a href="/approve/{{$project->id}}" class="btn btn-info">Completed</a>
                @else
                <a href="/approve/{{$project->id}}" class="btn btn-info">Approve and send to user</a>
                @endif
            </div>
        </div>
        @endforeach
        @else
        <div class="card-body">
            <h5 class="card-title">No Submitted Project to approve</h5>
            <p>
                Await
            </p>
        </div>
        @endif
    </div>
</div>
@endsection