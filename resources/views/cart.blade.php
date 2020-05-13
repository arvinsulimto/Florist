@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cart</div>

                @if($flowers->count()==0)
                    <div class="card-body">
                        <div class="alert alert-info" role="alert">No products available</div>
                    </div>
                @else
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Picture</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($flowers as $flower)
                                    <tr>
                                        <td>
                                            <div class="images-profile col-lg-1">
                                                <img src="/storage/{{ $flower->image }}" alt="{{ $flower->flowername }}" width="100px" height="100px">
                                            </div>
                                        </td>
                                        <td>{{ $flower->flowername }}</td>
                                        <td>{{ $flower->quantity }}</td>
                                        <td>Rp {{ $flower->price }}</td>
                                        <td>Rp {{ $flower->price * $flower->quantity }}</td>
                                        <td>
                                            <div class="btn-toolbar">
                                                <form method="post" action="{{route('cart/destroy', $flower->flowerid)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">Remove</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form method="POST" action="{{route('cart/checkout')}}" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="btn-toolbar">
                                <div class="col-md-7">
                                    <p class="lead float-right">Couriers</p>
                                </div>
                                <div class="col-md-4">
                                    <select id="courier" class="form-control @error('courier') is-invalid @enderror" value="{{ old('courier') }}" name="courier">
                                        @foreach($couriers as $courier)
                                            @if (old('courier') == $courier->courierid)
                                                <option value="{{ $courier->courierid }}" selected>{{$courier->couriername}} - {{$courier->price}}</option>
                                            @else
                                                <option value="{{ $courier->courierid }}">{{$courier->couriername}} - {{$courier->price}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('courier')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="btn-toolbar margin-ver">
                                <div class="col-md-7">
                                    <p class="lead float-right">Total Price</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="lead">Rp {{ $totals }}</p>
                                </div>
                            </div>
                            <div class="btn-toolbar float-right margin-nav">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-lg">Checkout</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
