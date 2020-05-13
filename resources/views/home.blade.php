@extends('layouts.app')

@section('title', 'Online Florist')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(Auth::check())
            @if(Auth::user()->role=='Admin')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Home</div>

                        @if($flowers->count() == 0)
                            <div class="card-body">
                                <div class="alert alert-info" role="alert">Flowers not found</div>
                            </div>
                        @else
                            <div class="card-body">
                                <form method="GET" action="/search">
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
                                                        <form method="post" action="{{route('/destroy',$flowers1->flowerid)}}" enctype="multipart/form-data">
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
            @elseif(Auth::user()->role=='Member')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Home</div>

                        @if($flowers->count() == 0)
                            <div class="card-body">
                                <div class="alert alert-info" role="alert">Flowers not found</div>
                            </div>
                        @else
                            <div class="card-body">
                                <form method="GET" action="/search">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="buy-page-container">
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
                                                            <a href="/catalog/{{$flowers1->flowerid}}/detail" class="btn btn-primary margin-horizontal">Details</a>
                                                            
                                                            @if($flowers1->stock == 0)
                                                                <form method="post" action="{{route('catalog/add',$flowers1->flowerid)}}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('put')
                                                                    <button disabled type="submit" class="btn btn-secondary margin-horizontal">Add to Cart</button>
                                                                </form>
                                                            @else
                                                                <form method="post" action="{{route('catalog/add',$flowers1->flowerid)}}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('put')
                                                                    <button type="submit" class="btn btn-primary margin-horizontal">Add to Cart</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {{ $flowers->links() }}
                        @endif
                    </div>
                </div>
            @endif
        @else
            <div class="col-md-4 card">
                <div class="card-body">
                    <h1 class="display-5">Welcome to</h1>
                    <h1 class="display-5">Online Florist</h1>
                    <p class="lead margin-ver">Please login/register first.</p>
                    <hr class="my-4">
                    <a class="btn btn-outline-primary btn-lg" href="{{ route('login') }}">{{ __('Login') }}</a>
                    <a class="btn btn-outline-primary btn-lg" href="{{ route('register') }}">{{ __('Register') }}</a>
                </div>
            </div>
            <div class="col-md-8">
                <div id="loginCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                    <ol class="carousel-indicators">
                        <li data-target="#loginCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#loginCarousel" data-slide-to="1"></li>
                        <li data-target="#loginCarousel" data-slide-to="2"></li>
                        <li data-target="#loginCarousel" data-slide-to="3"></li>
                        <li data-target="#loginCarousel" data-slide-to="4"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/storage/carousels/bq1.jpg" class="d-block w-100" alt="Bouquet 1">
                        </div>
                        <div class="carousel-item">
                            <img src="/storage/carousels/bq2.jpg" class="d-block w-100" alt="Bouquet 2">
                        </div>
                        <div class="carousel-item">
                            <img src="/storage/carousels/bq3.jpg" class="d-block w-100" alt="Bouquet 3">
                        </div>
                        <div class="carousel-item">
                            <img src="/storage/carousels/bq4.jpg" class="d-block w-100" alt="Bouquet 4">
                        </div>
                        <div class="carousel-item">
                            <img src="/storage/carousels/bq5.jpg" class="d-block w-100" alt="Bouquet 5">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#loginCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#loginCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
