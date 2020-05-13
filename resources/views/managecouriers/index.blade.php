@extends('layouts.app')

@section('title', 'Manage Couriers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Manage Couriers</div>
                
                <div class="card-body">
                    <a class="btn btn-primary btn-block"href="{{route('managecouriers/create')}}">{{ __('Insert Couriers') }}</a>
                </div>

                @if($couriers->count() == 0)
                    <div class="card-body">
                        <div class="alert alert-info" role="alert">No couriers available</div>
                    </div>
                @else
                    <div class="card-body">
                        <form method="GET" action="/managecouriers/search">
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
                            @foreach($couriers as $couriers1)
                                <div class="col-sm-3">
                                    <div class="card margin-vertical">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">{{ $couriers1->couriername }}</h5>
                                            <h6 class="card-title">Cost: Rp {{ $couriers1->price }}</h6>
                                            <div class="btn-toolbar d-flex justify-content-center">
                                                <a href="/managecouriers/{{$couriers1->courierid}}/edit" class="btn btn-primary margin-horizontal">Edit</a>
                                                <form method="post" action="{{route('managecouriers/destroy',$couriers1->courierid)}}" enctype="multipart/form-data">
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
                    {{ $couriers->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
