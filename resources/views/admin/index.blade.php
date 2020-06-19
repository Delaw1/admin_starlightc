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
                    <div>Analytics Dashboard
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Orders</div>
                            <div class="widget-subheading"></div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ count($total_orders) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-arielle-smile">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Clients</div>
                            <div class="widget-subheading">Total Clients Profit</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>$ {{ $total_orders->sum('price') }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Writers</div>
                            <div class="widget-subheading">Total number of writers</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ count($total_writers) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-premium-dark">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Products Sold</div>
                            <div class="widget-subheading">Revenue streams</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-warning"><span>$14M</span></div>
                        </div>
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
                                    <th>Name</th>
                                    <th class="text-center">Orders</th>
                                    <th class="text-center">Cart</th>
                                    <th class="text-center">Total Spent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                <tr>
                                    <td class="text-center text-muted">#{{ $client->id }}</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img width="40" class="rounded-circle" src="/assets/images/avatars/2.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $client->first_name }} {{ $client->last_name }}</div>
                                                    <div class="widget-subheading opacity-7">{{ $client->email }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ count($client->order) }}</td>
                                    <td class="text-center">
                                        {{ count($client->cart) }}
                                    </td>
                                    <td class="text-center">
                                        $ {{ $client->order->sum('price') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-block text-center card-footer">
                        <button onclick="redirect('/clients')" class="btn-wide btn btn-success">View All</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Client</div>
                                <div class="widget-subheading">Total number of clients</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-success">{{ count($total_clients) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Projects</div>
                                <div class="widget-subheading">Projects awaiting your approval</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-warning">{{ count($awaiting) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Projects</div>
                                <div class="widget-subheading">Number of approved projects</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-danger">{{ count($approved) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Writers
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="active btn btn-focus">All Month</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('includes.success')
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th class="text-center">Total jobs</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($writers as $writer)
                                @if($writer->user->role != 'admin')
                                <tr>
                                    <td class="text-center text-muted">#{{ $writer->user->id }}</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img width="40" class="rounded-circle" src="/assets/images/avatars/3.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $writer->user->first_name }} {{ $writer->user->last_name }}</div>
                                                    <div class="widget-subheading opacity-7">{{ $writer->user->email }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $writer->jobs }}</td>
                                    <td class="text-center">
                                        @if($writer->user->approved == 0)
                                        <div class="badge badge-warning">Pending</div>
                                        @else
                                        <div class="badge badge-success">Approved</div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($writer->user->approved == 0)
                                        <button onclick="redirect('/approve_writer/{{ $writer->user->id }}')" type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">Approve</button>
                                        @else
                                        <button onclick="redirect('/suspend_writer/{{ $writer->user->id }}')" type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm">Suspend</button>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-block text-center card-footer">
                        <button onclick="redirect('/writers')" class="btn-wide btn btn-success">View All</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="/http://maps.google.com/maps/api/js?sensor=true"></script>

@endsection

@section('script')
<script src="/js/code.js"></script>
@endsection