@extends('layouts.layout')

@section('title', 'User Projects')
    
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/project.css')}}">
@endsection

@section('content')

    <div class="projects d-flex flex-column align-items-center w-100">

        <div class="header w-100">
            
            <div class="label d-flex flex-column align-items-start">
                <div class="label-top d-flex">
                    <img src="{{asset('img/rocket.png')}}" alt="" srcset="">
                    <div>My Projects</div>
                </div>
                <div class="info-project">
                    You have <span class="text-primary font-weight-bold">5</span> open projects
                </div>
            </div>
            <div class="functions w-100 d-flex nowrap justify-content-between">
                <div class="w-75">
                    <form action="" method="GET" class="w-100 d-flex align-items-center">
                        <label for="search" class="d-none"></label>
                        <input type="search" id="search" name="search" class="form-control w-100" value="{{old('search')}}" placeholder="Search...">
                        <button type="submit"><img src="{{asset('img/search.png')}}" alt="search icon" srcset=""></button>
                    </form>
                </div>
                <div class="filter">
                    <div class="dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('img/filter.png')}}" alt="" srcset="">                        
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Name</a></li>                        
                        <li><a class="dropdown-item" href="#!">Owner</a></li>
                        <li><a class="dropdown-item" href="#!">Priority</a></li>
                        <li><a class="dropdown-item" href="#!">Due date</a></li>

                    </ul>
                </div>
            </div>
            
            <a href="{{route('user.projects.add')}}" class="add-project">
                <div class="add btn btn-primary">
                    <img src="{{asset('img/plus.png')}}" alt="" srcset="">
                    Project
                </div>
            </a>

        </div>

        <div class="cards w-100 mt-4 p-4 d-flex justify-content-between flex-wrap">

            <div class="pj-card mb-4 d-flex flex-column align-items-center">

                <div class="card-bloc d-flex justify-content-between align-items-center">
                    <div class="creator"> 
                        Created by: You 
                    </div>
                    <div class="btn btn-danger"> High </div>
                    <div class="btn btn-success">31/08/2023 - 26/09/2023</div>
                </div>

                <div class="card-bloc d-flex justify-content-between align-items-center mt-1">
                    <a href="{{route('user.projects.detail', ['id'=>1])}}" class="card-title"> 
                        Project 1 name
                    </a>
                    <div class="assigned"> 
                        <div class="d-flex justify-content-end align-items-center">
                            @auth
                                <span class="owner">You</span>
                            @endif
                            <span class="member"><img src="{{asset('img/man.png')}}" alt="" srcset=""></span>
                            <span class="member"><img src="{{asset('img/man.png')}}" alt="" srcset=""></span>
                        </div>
                    </div>
                </div>

                <div class="card-bloc d-flex justify-content-between align-items-center mt-1">
                    <div class="card-project d-flex align-items-center">
                        <span>50%</span> 
                        <progress class="project-progress" min="0" max="100" value="50"></progress>
                    </div>
                    <div class="actions"> 
                        <a href="{{route('user.projects.edit', ['id'=>1])}}"><img src="{{asset('img/edit.png')}}" alt="" srcset=""></a>
                        <a href="#"><img src="{{asset('img/delete.png')}}" alt="" srcset=""></a>
                    </div>
                </div>
            </div>

            <div class="pj-card mb-4 d-flex flex-column align-items-center">

                <div class="card-bloc d-flex justify-content-between align-items-center">
                    <div class="creator"> 
                        Created by: You 
                    </div>
                    <div class="btn btn-danger"> High </div>
                    <div class="btn btn-success">31/08/2023 - 26/09/2023</div>
                </div>

                <div class="card-bloc d-flex justify-content-between align-items-center mt-1">
                    <a href="#" class="card-title"> 
                        Task 1 name Task name 
                    </a>
                    <div class="assigned"> 
                        <div class="d-flex justify-content-end align-items-center">
                            @auth
                                <span class="owner">You</span>
                            @endif
                            <span class="member"><img src="{{asset('img/man.png')}}" alt="" srcset=""></span>
                            <span class="member"><img src="{{asset('img/man.png')}}" alt="" srcset=""></span>
                        </div>
                    </div>
                </div>

                <div class="card-bloc d-flex justify-content-between align-items-center mt-1">
                    <a href class="card-project d-flex align-items-center">
                        <span>50%</span> 
                        <progress class="project-progress" min="0" max="100" value="50"></progress>
                    </a>
                    <div class="actions"> 
                        <a href="#"><img src="{{asset('img/edit.png')}}" alt="" srcset=""></a>
                        <a href="#"><img src="{{asset('img/delete.png')}}" alt="" srcset=""></a>
                    </div>
                </div>
            </div>

            <div class="pj-card mb-4 d-flex flex-column align-items-center">

                <div class="card-bloc d-flex justify-content-between align-items-center">
                    <div class="creator"> 
                        Created by: You 
                    </div>
                    <div class="btn btn-danger"> High </div>
                    <div class="btn btn-success">31/08/2023 - 26/09/2023</div>
                </div>

                <div class="card-bloc d-flex justify-content-between align-items-center mt-1">
                    <a href="#" class="card-title"> 
                        Task 1 name Task name 
                    </a>
                    <div class="assigned"> 
                        <div class="d-flex justify-content-end align-items-center">
                            @auth
                                <span class="owner">You</span>
                            @endif
                            <span class="member"><img src="{{asset('img/man.png')}}" alt="" srcset=""></span>
                            <span class="member"><img src="{{asset('img/man.png')}}" alt="" srcset=""></span>
                        </div>
                    </div>
                </div>

                <div class="card-bloc d-flex justify-content-between align-items-center mt-1">
                    <a href class="card-project d-flex align-items-center">
                        <span>50%</span> 
                        <progress class="project-progress" min="0" max="100" value="50"></progress>
                    </a>
                    <div class="actions"> 
                        <a href="#"><img src="{{asset('img/edit.png')}}" alt="" srcset=""></a>
                        <a href="#"><img src="{{asset('img/delete.png')}}" alt="" srcset=""></a>
                    </div>
                </div>
            </div>



        </div>

    </div>

@endsection
