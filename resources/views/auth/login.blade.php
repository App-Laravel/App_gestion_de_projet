<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - Login </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
    <script type="text/javascript" defer src="{{asset('js/app.js')}}"></script>

</head>
<body>

    <div class="login-page">

        <div class="login-form">

            <h1 class="login-label font-weight-bold text-align-center"> Sign In </h1>

            <form method="POST" action="{{ route('login') }}" class="d-flex flex-column col-7">  
    
                <div class="mb-4">
                    <label for="email"> {{ __('Email Address') }} </label>
    
                    <div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                </div>
    
                <div class="mb-4">
                    <label for="password"> {{ __('Password') }} </label>
                    <div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
    
                <div class="row justify-content-between mb-4">
                    <div class="col-5 px-0 remember">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                            <div class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </div>
                        </div>
                    </div>

                    @if (Route::has('password.request'))
                    <a class="forgot-password col-6 btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                    @endif
                </div>                

                <button type="submit" class="btn btn-primary">
                        {{ __('Sign In') }}
                </button>
    
                <h5 class="mt-5"> 
                    <span>Don’t have an account?</span> 
                    <a href="{{route('register')}}" class="link-offset-1 ">Create new one</a>
                </h5>

                @csrf
                @method('POST')
            </form>

        </div>
        
        <div class="welcome-container">
            <img src="{{asset('img/login_img_small.png')}}" alt="login welcome image" srcset="">
        </div>
      
    </div>
    
</body>
</html>




