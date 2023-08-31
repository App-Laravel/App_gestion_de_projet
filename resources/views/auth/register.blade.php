<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - Sign Up </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
    <script type="text/javascript" defer src="{{asset('js/app.js')}}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}

</head>
<body>

    <div class="login-page">

        <div class="login-form">

            <h1 class="signup-label font-weight-bold text-align-center"> Sign Up </h1>

            <form method="POST" action="{{ route('register') }}" class="d-flex flex-column col-7" enctype="multipart/form-data">
                
                <div class="mb-2">
                    <label for="name"> {{ __('Name') }} </label>
    
                    <div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                </div>
    
                <div class="mb-2">
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
    
                <div class="mb-2">
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

                <div class="mb-2">
                    <label for="password-confirm"> {{ __('Confirm Password') }} </label>

                    <div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                  
                <div class="mb-2">
                    <label for="formFile">Select an avatar (optional)</label>
                    <input type="file" id="formFile" name="avatar" 
                            class="form-control @error('avatar') is-invalid @enderror 
                                                @if (session('upload_error')) is-invalid @endif " 
                            lang="en"
                            accept=".png, .jpg, .jpeg, .gif"
                            value="{{ old('avatar') }}">
                    
                    @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    @if (session('upload_error'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ session('upload_error') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">
                        {{ __('Sign Up') }}
                </button>
    
                <h5 class="mt-4 have-account"> 
                    <span>Already have an account?</span> 
                    <a href="{{route('login')}}" class="link-offset-1 ">Sign in</a>
                </h5>

                @csrf
                
            </form>

        </div>
        
        <div class="welcome-container">
            <img src="{{asset('img/signup_img_small.png')}}" alt="register image" srcset="">
        </div>
      
    </div>
    
</body>
</html>