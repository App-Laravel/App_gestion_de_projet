@extends('layouts.layout')

@section('title', 'User Profile')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/user_home.css')}}">
@endsection

@section('content')

    <div class="profile w-100 d-flex flex-column align-items-center">
        
        <h2 class="text-center mt-3 mb-5"> Profile </h2>
        
        <div class="w-90 d-flex justify-content-between">

            <div class="w-25 d-flex flex-column align-items-center justify-content-between">
                
                <div class="head w-100 d-flex flex-column align-items-center">
                    <div class="avatar w-100 d-flex justify-content-center align-items-end">
                        <div class="photo">
                            @if (!empty($user->avatar))
                                <img src="{{asset($user->avatar)}}" alt="user photo">
                            @endif                            
                        </div>
                    </div>
                    <div class="name mt-3">
                        {{ ucwords($user->name) }}
                    </div>
                </div>

                <a href="{{ route('user.editProfile') }}" class="btn btn-primary edit-profile">Edit profile</a>


            </div>
            
            <table class="profile-table w-65">
                <tbody>
                    <tr class="row-stripe">
                        <td>Name</td>
                        <td>{{ ucwords($user->name) }}</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>{{ $user->gender ? displayGender($user->gender) : '----------' }}</td>
                    </tr>
                    <tr class="row-stripe">
                        <td>Email</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><a href="{{ route('user.changePassword') }}" class="card-link">Change Password</a></td>
                    </tr>
                    <tr class="row-stripe">
                        <td>Role</td>
                        <td>{{ displayRole($user->role) }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{ !empty($user->phone) ? $user->phone : '----------' }}</td>
                    </tr>
                    <tr class="row-stripe">
                        <td>Status</td>
                        <td>{{ displayStatus($user->status) }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

@endsection