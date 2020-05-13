@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Update User') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('updateUser',$user) }}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}

                        <input type="hidden" value="">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                @if(old('name'))
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
                                @else
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="off" autofocus>
                                @endif
                                
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>
                            <div class="col-md-6">
                                @if(old('email'))
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off">
                                @else
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="off">
                                @endif

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                            <div class="col-md-6">
                                @if(old('email'))
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="off">
                                @else
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" autocomplete="off">
                                @endif

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                            <div class="col-md-6">
                                @if(old('gender'))
                                    <input type="radio" name="gender" value="Male" @if(old('gender')=="Male") checked @endif>Male
                                    <br>
                                    <input type="radio" name="gender" value="Female" @if(old('gender')=="Female") checked @endif>Female
                                @else
                                    <input type="radio" name="gender" value="Male" @if($user->gender=="Male") checked @endif>Male
                                    <br>
                                    <input type="radio" name="gender" value="Female" @if($user->gender=="Female") checked @endif>Female
                                @endif

                                @error('gender')
                                    <br>
                                    <span style="color:#e3342f;font-size:80%;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                @if(old('address'))
                                    <textarea id="address" class="form-control  @error('address') is-invalid @enderror" name="address">{{ old('address') }}</textarea>
                                @else
                                    <textarea id="address" class="form-control  @error('address') is-invalid @enderror" name="address">{{ $user->address }}</textarea>
                                @endif

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profile" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>
                            <div class="col-md-6">
                                @if(old('profile'))
                                    <input id="profile" class="form-control  @error('profile') is-invalid @enderror" type="file" accept="image/*" name="profile" value="{{ old('profile') }}">
                                @else
                                    <input id="profile" class="form-control  @error('profile') is-invalid @enderror" type="file" accept="image/*" name="profile" value="{{ $user->profile }}">
                                @endif
                                
                                @error('profile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
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
