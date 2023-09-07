@extends('layouts.layout')

@section('title', "Edit User's Profile")

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/user_home.css')}}">
@endsection

@section('content')

    <div class="profile w-100 d-flex flex-column align-items-center">
        
        <h2 class="text-center mt-3 mb-5"> Modify your profile </h2>

        <div class="w-90">

            <form action="{{ route('user.handleEditProfile') }}" method="POST" class="w-100 d-flex justify-content-between">
                
                <div class="w-25 d-flex flex-column align-items-center justify-content-between">
                    
                    <div class="head w-100 d-flex flex-column align-items-center">
                        <div class="avatar w-100 d-flex justify-content-center align-items-end">
                            <div class="photo" id="holder">
                                @if (!empty($user->avatar))
                                    <img src="{{asset($user->avatar)}}" alt="user photo">
                                @endif                 
                            </div>
                            <input type="hidden" name="avatar" id="path-to-image" class="d-none">                   
                            <div id="lfm" data-preview="holder" data-input="path-to-image" class="modify-icon d-flex justify-content-center align-items-center">
                                <img src="{{asset('img/write.png')}}" alt="modify icon" class="photo-modify">                        
                            </div>               
                        </div>
                        <div class="name mt-3">
                            {{ ucwords($user->name) }}
                        </div>
                    </div>

                    <div class="d-flex w-100 justify-content-evenly">
                        <input type="submit" value="Confirm" class="btn btn-primary edit-profile">
                        <a href="{{ route('user.profile') }}" class="btn btn-danger edit-profile">Cancel</a>
                    </div>

                </div>
                
                <table class="profile-table-edit w-65">
                    <tbody>
                        <tr>
                            <td colspan="2" class="td-alert">
                                @if (session('msg'))
                                    <div class="alert alert-success text-center" role="alert"> {{ session('msg') }} </div>
                                @endif
                    
                                @if (session('msg-error'))
                                    <div class="alert alert-warning text-center" role="alert"> {{ session('msg-error') }} </div>
                                @endif
                            </td>
                        </tr>
                        <tr class="row-stripe">
                            <td width="20%"><label for="name">Name</label></td>
                            <td>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $user->name }}" required placeholder="Name..." autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td><label for="gender">Gender</label></td>
                            <td class="d-flex flex-column">
                                <div class="d-flex">
                                    <div class="male">
                                        <input type="radio" name="gender" id="gender" class="form-radio" value="1" {{ (old('gender') == 1 || $user->gender == 1) ? 'checked' : false }}>
                                        <span>Male</span>
                                    </div>
                                    <div class="female mx-5">
                                        <input type="radio" name="gender" id="gender" class="form-radio" value="2" {{ (old('gender') == 2 || $user->gender == 2) ? 'checked' : false }}>
                                        <span>Female</span>
                                    </div>
                                </div>
                                @error('gender')
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                                
                            </td>
                        </tr>
                        <tr class="row-stripe">
                            <td><label for="email">Email</label></td>
                            <td>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?? $user->email }}" required placeholder="Email..." autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><a href="{{ route('user.changePassword') }}" class="card-link">Change Password</a></td>
                        </tr>                    
                        <tr class="row-stripe">                        
                            <td><label for="phone">Phone</label></td>
                            <td>
                                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') ?? $user->phone }}" placeholder="Phone..." autocomplete="tel">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                @csrf
                @method('POST')
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/portrait_manage.js') }}"></script>
@endsection