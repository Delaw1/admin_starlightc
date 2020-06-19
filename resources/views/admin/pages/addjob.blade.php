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
        <div class="container">
            @include('includes.success')
            @include('includes.error')

            @if($section->currency == "cent")
            <div class="row">
                <div class="col-sm-6">
                    <p class="size">Product price: <span class="total_price">$ 0</span></p>
                </div>
                <div class="col-sm-6 end">
                    <p class="size-15">Time Frame: <span class="time_frame">0 hours</span></p>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-md-6">
                    <p>Product price: <span class="">$ {{$section->price}}</span></p>
                </div>
                <div class="col-md-6 end">
                    <p>Time Frame: <span class="">24 hours</span></p> 
                </div>
            </div>
            @endif

            <form method="post" action="/addorder">
                {{ csrf_field() }}
                <div class="form-row">
                    <input type="hidden" name="section_id" value="{{$section->id}}" />
                    @if($section->currency == "cent")
                    <div class="form-group col-md-6">
                        <label for="inputTitle">Title</label>
                        <input name="title" type="text" class="form-control" value="{{ old('title') }}" id="inputTitle" placeholder="Title" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputWords">Number of words</label>
                        <input name="words" type="text" class="form-control word" id="inputWords" value="{{ old('words') }}" placeholder="Number of words" required>
                    </div>
                    @else
                    <div class="form-group col-md-12">
                        <label for="inputTitle">Title</label>
                        <input name="title" type="text" class="form-control" value="{{ old('title') }}" id="inputTitle" placeholder="Title" required>
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="inputDescription">Description</label>
                    <textarea name="description" type="text" class="form-control" id="inputDescription" placeholder="Enter more details about the project" required>{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Add to cart</button>
            </form>
        </div>
    </div>
</div>
@endsection

@if($section->currency == "cent")
@section('script')
<script src="/js/jquery.min.js"></script>
<script src="/js/code.js"></script>
<script type="text/javascript">
    $(document).ready(() => {
        setInterval(function() {
            $word = document.querySelector(".word").value
            calculatePrice($word, '{{$section->price}}')
        }, 100)
    })
</script>
@endsection
@endif