@extends('layouts.layout')

@section('content')
<div class="container container-reset-password change-pwd">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (session('msg'))
                <div class="alert alert-success text-center" role="alert"> {{ session('msg') }} </div>
            @endif

            @if (session('msg-error'))
                <div class="alert alert-warning text-center" role="alert"> {{ session('msg-error') }} </div>
            @endif
            
            <div class="card">
                <div class="card-header mb-3">{{ __('Modify Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.handleChangePassword') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="currentpassword" class="col-md-4 col-form-label text-md-end">{{ __('Current password') }}</label>

                            <div class="col-md-6">
                                <input id="currentpassword" type="password" name="currentpassword" class="form-control @error('currentpassword') is-invalid @enderror" required autocomplete="current-password">

                                @error('currentpassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('New password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm new password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Modify Password') }}
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
