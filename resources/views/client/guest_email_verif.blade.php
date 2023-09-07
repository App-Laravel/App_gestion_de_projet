@extends('layouts.app')

@section('content')
<div class="container container-reset-password">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>
                
                <div class="card-body">                   

                    @if (session('already'))
                        <div class="alert alert-success" role="alert">
                            Your email has already been verified. Please do not try again.
                        </div>
                    @endif

                    @if (session('expired'))
                        <div class="alert alert-warning" role="alert">
                            The email verification request has been expired.
                        </div>
                        <div>
                            You can require the email verification as logging in to your account:
                            <a href="{{ route('login') }}">Log in</a>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            Your email has been successfully verified.
                        </div>
                        <div>
                            You can now log in to your account.
                            <a href="{{ route('login') }}">Log in</a>
                        </div>
                    @endif

                    @if (session('fail'))
                        <div class="alert alert-warning" role="alert">
                            The email verification has been failed.
                        </div>
                        <div>
                            You can proceed the email verification again with the login:
                            <a href="{{ route('login') }}">Log in</a>
                        </div>
                    @endif

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
