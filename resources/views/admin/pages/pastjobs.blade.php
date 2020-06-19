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

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Clients
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="active btn btn-focus">All Month</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Title</th>
                                    <th class="text-center">User</th>
                                    <th class="text-center">file</th>
                                    <!-- <th class="text-center">Price</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($orders) > 0)
                                @foreach($orders as $order)
                                <tr>
                                    <td class="text-center text-muted">#{{ $order->id }}</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img width="40" class="rounded-circle" src="/assets/images/avatars/4.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $order->title }}</div>
                                                    <div class="widget-subheading opacity-7"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-success" href="/storage/{{$order->filepath}}">Download</a>
                                    </td>
                                    <!-- <td class="text-center">
                                        {{ $order->price }}
                                    </td> -->
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('script')
    <script src="/js/code.js"></script>
    @endsection