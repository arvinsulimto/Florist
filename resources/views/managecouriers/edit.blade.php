@extends('layouts.app')

@section('title', 'Manage Couriers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Courier</div>
                
                <div class="card-body">
                    <form method="POST" action="{{route('managecouriers/update',$couriers)}}">
                        @csrf
                        {{ method_field('PUT') }}
                        
                        <div class="form-group row">
                            <label for="courier_id" class="col-md-4 col-form-label text-md-right">{{ __('Courier ID') }}</label>
                            <div class="col-md-6">
                                <input name="courier_id" class="form-control" type="text" value="{{ $couriers->courierid }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="courier_name" class="col-md-4 col-form-label text-md-right">{{ __('Courier Name') }}</label>
                            <div class="col-md-6">
                                @if(old('courier_name'))
                                    <input id="courier_name" type="text" class="form-control @error('courier_name') is-invalid @enderror" value="{{ old('courier_name') }}" autocomplete="off" name="courier_name">
                                @else
                                    <input id="courier_name" type="text" class="form-control @error('courier_name') is-invalid @enderror" value="{{ $couriers->couriername }}" autocomplete="off" name="courier_name">
                                @endif

                                @error('courier_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shipping_cost" class="col-md-4 col-form-label text-md-right">{{ __('Shipping Cost') }}</label>
                            <div class="col-md-6">
                                @if(old('shipping_cost'))
                                    <input id="shipping_cost" type="number" min="3000" step="100" class="form-control @error('shipping_cost') is-invalid @enderror" value="{{ old('shipping_cost') }}" autocomplete="off" name="shipping_cost">
                                @else
                                    <input id="shipping_cost" type="number" min="3000" step="100" class="form-control @error('shipping_cost') is-invalid @enderror" value="{{ $couriers->price }}" autocomplete="off" name="shipping_cost">
                                @endif

                                @error('shipping_cost')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" style="width:100px;" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
