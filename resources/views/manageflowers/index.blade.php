@extends('layouts.app')

@section('title', 'Manage Flowers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Manage Flowers</div>

                <div class="card-body">
                    <a class="btn btn-primary btn-block"href="{{route('manageflowers/create')}}">{{ __('Insert Flowers') }}</a>
                </div>

                @if($flowers->count() == 0)
                    <div class="card-body">
                        <div class="alert alert-info" role="alert">No flowers available</div>
                    </div>
                @else
                    <div class="card-body">
                        <form method="GET" action="/manageflowers/search">
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="row">   
                            @foreach($flowers as $flowers1)
                                <div class="col-sm-3">
                                    <div class="card margin-vertical">
                                        <img src="/storage/{{ $flowers1->image }}" class="card-img-top" alt="{{ $flowers1->flowername }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $flowers1->flowername }}</h5>
                                            <p class="card-text desc">{{ $flowers1->description }}</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="btn-toolbar">
                                                <a href="/manageflowers/{{$flowers1->flowerid}}/edit" class="btn btn-primary margin-horizontal">Edit</a>
                                                <form method="post" action="{{route('manageflowers/destroy',$flowers1->flowerid)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger margin-horizontal">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{ $flowers->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection