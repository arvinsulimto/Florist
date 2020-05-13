@extends('layouts.app')

@section('title', 'Manage Flowers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Insert Flower</div>

                <div class="card-body">
                    <form method="POST" action="{{route('manageflowers/store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="flower_name" class="col-md-4 col-form-label text-md-right">{{ __('Flower Name') }}</label>
                            <div class="col-md-6">
                                <input id="flower_name" type="text" class="form-control @error('flower_name') is-invalid @enderror" value="{{ old('flower_name') }}" autocomplete="off" name="flower_name">

                                @error('flower_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Flower Price') }}</label>
                            <div class="col-md-6">
                                <input id="price" type="number" min="10000" step="100" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" autocomplete="off" name="price">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stock" class="col-md-4 col-form-label text-md-right">{{ __('Flower Stock') }}</label>
                            <div class="col-md-6">
                                <input id="stock" type="number" min="1" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}" autocomplete="off" name="stock">

                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="flower_type" class="col-md-4 col-form-label text-md-right">{{ __('Flower Type') }}</label>
                            <div class="col-md-6">
                                <select id="flower_type" class="form-control @error('flower_type') is-invalid @enderror" value="{{ old('flower_type') }}" name="flower_type">
                                    @foreach($flowertypes as $flowertypes1)
                                        @if (old('flower_type') == $flowertypes1->typeid)
                                            <option value="{{ $flowertypes1->typeid }}" selected>{{$flowertypes1->typename}}</option>
                                        @else
                                            <option value="{{ $flowertypes1->typeid }}">{{$flowertypes1->typename}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('flower_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <textarea id="description" class="form-control  @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                            <div class="col-md-6">
                                <input id="image" class="form-control  @error('image') is-invalid @enderror" type="file" accept="image/*" value="{{ old('image') }}" name="image">
                                
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" style="width:100px;" class="btn btn-primary">
                                    {{ __('Insert') }}
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
