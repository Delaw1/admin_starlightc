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
                    <div>{{ $desc }}
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
                    <div>
                        <!-- @include('includes.success') -->
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
                                @if(count($writers) > 0)
                                @foreach($writers as $writer)
                                <tr>
                                    <td class="text-center text-muted">#{{ $writer->id }}</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img width="40" class="rounded-circle" src="/assets/images/avatars/4.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $writer->first_name }} {{ $writer->last_name }}</div>
                                                    <div class="widget-subheading opacity-7">{{ $writer->email }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $writer->workerstat->jobs }}</td>
                                    <td class="text-center">
                                        @if($writer->approved == 0)
                                        <div class="badge badge-warning">Pending</div>
                                        @else
                                        <div class="badge badge-success">Approved</div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($writer->approved == 0)
                                        <button onclick="redirect('/approve_writer/{{ $writer->id }}')" type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">Approve</button>
                                        @else
                                        <button onclick="redirect('/suspend_writer/{{ $writer->id }}')" type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm">Suspend</button>
                                        @endif
                                    </td>
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
</div>
<script src="/http://maps.google.com/maps/api/js?sensor=true"></script>

@endsection

@section('script')
<script src="/js/code.js"></script>
@endsection