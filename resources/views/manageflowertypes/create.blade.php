@extends('layouts.app')

@section('title', 'Manage Flower Types')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Insert Flower Type</div>

                <div class="card-body">
                    <form method="POST" action="{{route('manageflowertypes/store')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="flower_type" class="col-md-4 col-form-label text-md-right">{{ __('Flower Type Name') }}</label>
                            <div class="col-md-6">
                                <input id="flower_type" type="text" class="form-control @error('flower_type') is-invalid @enderror" value="{{ old('flower_type') }}" autocomplete="off" name="flower_type">

                                @error('flower_type')
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
