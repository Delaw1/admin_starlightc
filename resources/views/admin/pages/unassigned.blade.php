@extends('admin.layouts.sidebar')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        @if(count($projects) > 0)
        @include('includes.success')
        @include('includes.error')
        @foreach($projects as $order)
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="card-title">{{ $order->title }}</h5>
                    </div>
                    <div class="col-lg-6 col-xl-4">
                        <div class="card mb-3 widget-content bg-premium-dark">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Price</div>
                                    <div class="widget-subheading"></div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-warning"><span>${{ $order->price }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <p>
                    {{ $order->description}}
                </p>
                <form action="/assign" method="post">
                    @csrf()
                    <div class="form-row">
                        <input type="hidden" name="order_id" value="{{ $order->id }}" />
                        <div class="form-group">
                            <label class="">Assign writer:</label>
                            <select name="writer_id" class="form-control" required>
                                
                            <option value="" disabled selected>Select one...</option>
                                @if(count($writers) != 0)
                                @foreach($writers as $writer)
                                <option value="{{ $writer->user_id }}">{{ $writer->user->last_name }} {{ $writer->user->first_name }}</option>
                                @endforeach
                                @else
                                <option disabled>No writer available</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-primary">Assign</button>
                </form>

            </div>
        </div>
        @endforeach
        @else
        <div class="card-body">
            <h5 class="card-title">All Projects are assigned</h5>
            <p>
                Await
            </p>
        </div>
        @endif
    </div>
</div>
@endsection