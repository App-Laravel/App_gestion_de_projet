@extends('layouts.layout')

@section('title', 'User Homepage')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/user_styles.css')}}">
@endsection

@section('content')

    <div class="dashboard d-flex">
        <img src="{{asset('img/dashboard.png')}}" alt="user dashboard icon" srcset="">
        <h2> Overview </h2>
    </div>

@endsection