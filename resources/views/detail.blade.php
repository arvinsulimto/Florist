@extends('layouts.app')

@section('title', 'Flower Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Flower Details</div>
                
                <div class="card-body modal-body row">
                    <div class="col-md-4">
                        <img src="/storage/{{ $flowers->image }}" class="d-block w-100" alt="{{ $flowers->flowername }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h1 class="display-5">{{ $flowers->flowername }}</h1>
                            <p class="lead">{{ $flowers->description }}</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="lead">Rp {{ $flowers->price }}</p>
                                </div>
                                <div class="col-md-3 mt-auto">
                                    <form method="POST" action="{{route('catalog/insert',$flowers)}}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        
                                        @if($flowers->stock == 0)
                                            <div class="input-group mb-3">
                                                <input disabled id="quantity" type="number" value="" min="0" max="{{ $flowers->stock }}" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" autocomplete="off" name="quantity">

                                                @error('quantity')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <div class="input-group-append">
                                                    <button disabled type="submit" class="btn btn-secondary">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="input-group mb-3">
                                                <input id="quantity" type="number" value="1" min="1" max="{{ $flowers->stock }}" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" autocomplete="off" name="quantity">

                                                @error('quantity')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection