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
                    <img src="{{asset('img/rocket.png')}}" alt="avatar rocket" >
                    <div>My Projects</div>
                </div>
                <div class="info-project">
                    You have <span class="text-primary font-weight-bold">{{ getProjects()->count() }}</span> open projects
                </div>
            </div>
            <div class="functions w-100 d-flex nowrap justify-content-between">
                <div class="w-75">
                    <form action="" method="GET" class="w-100 d-flex align-items-center">
                        <label for="keyword" class="d-none"></label>
                        <input type="text" id="keyword" name="keyword" class="form-control w-100" value="{{old('keyword')}}" placeholder="Search...">
                        <button type="submit"><img src="{{asset('img/search.png')}}" alt="search icon" ></button>
                    </form>
                </div>
                <div class="filter">
                    <div class="dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('img/filter.png')}}" alt="filter icon" >                        
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="projectFilter dropdown-item" href="name" >Name</a></li>                        
                        <li><a class="projectFilter dropdown-item" href="creator_id" >Owner</a></li>
                        <li><a class="projectFilter dropdown-item" href="priority" >Priority</a></li>
                        <li><a class="projectFilter dropdown-item" href="due_date" >Due date</a></li>

                    </ul>
                </div>
            </div>
            
            <div class="add-project">
                <a href="{{route('user.projects.add')}}" class="add btn btn-primary">
                    <img src="{{asset('img/plus.png')}}" alt="add project icon" >
                    Project
                </a>
            </div>

        </div>

        @if (session('msg'))
            <div class="alert alert-success" role="alert"> {{ session('msg') }} </div>
        @endif

        @if (session('msg-error'))
            <div class="alert alert-warning" role="alert"> {{ session('msg-error') }} </div>
        @endif

        <div class="cards w-100 mt-4 px-4 d-flex justify-content-between flex-wrap">

            @if ($projects->count() > 0)

            @foreach ($projects as $project)               
            
            <div class="pj-card mb-4 d-flex flex-column align-items-center">

                <div class="card-bloc d-flex justify-content-between align-items-center">
                    <div>
                        Created by: {{ getCreatorName($project->creator_id) }} 
                    </div>
                    <div class="status-date d-flex justify-content-between">
                        <div class="btn {{ getPriorityClass($project->priority) }}"> {{ getPriority($project->priority) }} </div>
                        <div class="btn {{ ($project->due_date < now()) ? 'btn-danger' : 'btn-success' }}">{{ dateDisplay($project->start_date) }} - {{ dateDisplay($project->due_date) }}</div>
                    </div>
                    
                </div>

                <div class="card-bloc d-flex justify-content-between align-items-center my-1 flex-grow-1">
                    <a href="{{route('user.projects.detail', ['id'=>$project->id])}}" class="card-title"> 
                        {{ ucfirst($project->name) }}
                    </a>
                    <div class="assigned"> 
                        <div class="d-flex justify-content-end align-items-center">
                            
                            @if (getCoworkers($project->id)->count() > 0)
                                @php
                                    $count = 0;
                                @endphp
                                @foreach (getCoworkers($project->id) as $user)
                                    @if (Auth::user()->id == $user->id)
                                        <span class="owner">You</span>
                                        @php
                                            $count++;
                                        @endphp
                                    @endif                                                            
                                @endforeach
                                
                                @foreach (getCoworkers($project->id) as $user)
                                    @if (Auth::user()->id != $user->id)
                                        @php
                                            $count++;
                                        @endphp
                                        @if ($count < 3)
                                            <span class="member"><img src="{{ $user->avatar ? asset('storage'.$user->avatar) : asset('storage/uploads/avatar/user.png') }}" alt="avatar" ></span>                                                                                   
                                        @endif                                        
                                    @endif                                                                                                     
                                @endforeach
                                @if (getCoworkers($project->id)->count() > 2)
                                    <span class="ownerPlus">+{{getCoworkers($project->id)->count() - 2}}</span>
                                @endif
                            @endif                            
                            
                        </div>
                    </div>
                </div>

                <div class="card-bloc d-flex justify-content-between align-items-center mt-1">
                    <div class="card-project d-flex align-items-center">
                        <div class="progress w-50">
                            <div class="progress-bar" style="width: {{ (getProjectsAdvancement($project)).'%' }}" role="progressbar" aria-valuenow=" {{ getProjectsAdvancement($project) }}" aria-valuemin="0" aria-valuemax="100">{{ (getProjectsAdvancement($project)).'%' }}</div>
                          </div>
                    </div>
                    <div class="actions"> 
                        <a href="{{ route('user.projects.edit', ['id'=> $project->id]) }}">
                            <img src="{{asset('img/edit.png')}}" alt="modify icon" >
                        </a>
                        <a href="{{ route('user.projects.delete', ['id'=> $project->id]) }}" class="delete-action">
                            <img src="{{asset('img/delete.png')}}" alt="delete icon" >
                        </a>
                    </div>
                </div>
            </div>

            @endforeach
            
            @else
                <h3 class="no-found w-100 d-flex justify-content-center align-items-center"> NO PROJECT FOUND </h3>
            @endif
        </div>

        <div class="app-pagination">
            {{ $projects->onEachSide(1)->withQueryString()->links('pagination.bootstrap-5') }}
        </div>

    </div>
    @include('components.delete')
@endsection

@section('script')
    <script type="text/javascript"> 
        const filterElements = document.querySelectorAll('.projectFilter');
        filterElements.forEach(element => {
            element.onclick = function(e){
                e.preventDefault();
                let selectedFilter = (e.target.getAttribute('href'));
                let currentURL = window.location.href;
                
                if (!currentURL.includes('?')) {
                    window.location = currentURL + '?filter=' + selectedFilter;

                } else if (!currentURL.includes('filter')) {
                    window.location = currentURL + '&filter=' + selectedFilter;

                } else {
                    if (!currentURL.includes(selectedFilter)) {
                        window.location = currentURL.replace(/name|creator_id|priority|due_date/gi, selectedFilter);
                    }
                }            
            }
        });    
    </script>

    <script defer src="{{asset('js/delete_project.js')}}"></script>
@endsection
