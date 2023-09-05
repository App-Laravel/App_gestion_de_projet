@extends('layouts.layout')

@section('title', "Edit User's Profile")

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/user_home.css')}}">
@endsection

@section('content')

    <div class="profile w-100 d-flex flex-column align-items-center">
        
        <h2 class="text-center mt-3 mb-5"> Modify your profile </h2>
        
        <div class="profile-body d-flex justify-content-between">

            <div class="profile-photo d-flex flex-column align-items-center justify-content-between">
                
                <div class="head w-100 d-flex flex-column align-items-center">
                    <div class="avatar w-100 d-flex justify-content-center align-items-end">
                        <div class="photo" id="holder"></div>
                        {{-- <img src="{{asset('storage/uploads/avatar/1692975375_man.png')}}" alt="user photo" class="photo"> --}}
                        <div id="lfm" data-preview="holder" class="modify-icon d-flex justify-content-center align-items-center">
                            <img src="{{asset('img/write.png')}}" alt="modify icon" class="photo-modify">                        
                        </div>               
                    </div>
                    <div class="name mt-3">
                        John Smith
                    </div>
                </div>

                <a href="#" class="btn btn-primary edit-profile">Edit profile</a>

            </div>
            
            <table class="profile-table">
                <tbody>
                    <tr class="row-stripe">
                        <td>Name</td>
                        <td>John Smith</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>Male</td>
                    </tr>
                    <tr class="row-stripe">
                        <td>Email</td>
                        <td>john@yahoo.com</td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><a href="http://">Change Password</a></td>
                    </tr>
                    <tr class="row-stripe">
                        <td>Role</td>
                        <td>User</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>11111111111</td>
                    </tr>
                    <tr class="row-stripe">
                        <td>Status</td>
                        <td>Active</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/filemanage.js') }}"></script>
@endsection