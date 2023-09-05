<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Projects Management App" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/layout.css')}}">
    @yield('css')

    <script type="text/javascript" defer src="{{asset('js/app.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="layout">

        <div class="sidebar d-flex flex-column align-items-center">
            
            <a href="{{url('/')}}" class="logo d-flex align-items-center">
                <i class="fa-solid fa-globe"></i>
                <div class="pt-2">SITEWEB NAME</div>
            </a>

            <div class="options mt-4 d-flex flex-column align-items-center">
                <div class="items-label mb-3">Boards</div>
                
                <a href="{{route('user.projects.index')}}" class="options-item mb-2 d-flex align-items-center">
                    <span class="item-icon"><img src="{{asset('img/project.png')}}" alt="icon item sidebar" ></span>
                    <div class="item-label">Projects({{ getProjects()->count() }})</div>
                </a>

                <a href="{{route('user.tasks.index')}}" class="options-item mb-2 d-flex align-items-center">
                    <span class="item-icon"><img src="{{asset('img/to-do-list.png')}}" alt="icon item sidebar" ></span>
                    <div class="item-label">Task({{ getTasks()->count() }})</div>
                </a>

                <a href="#" class="options-item mb-2 d-flex align-items-center d-none">
                    <span class="item-icon"><img src="{{asset('img/delete.png')}}" alt="icon item sidebar" ></span>
                    <div class="item-label">Trash(0)</div>
                </a>                   
            </div>

            <div class="options mt-4 d-flex flex-column align-items-center">
                <div class="recent-tasks-label mb-2">Recent Tasks</div>

                @if (!empty(getRecentTasks(3)))
                    @foreach (getRecentTasks(3) as $task)
                        <div class="side-card d-flex flex-column align-items-center mb-2 p-1">

                            <div class="card-bloc d-flex align-items-center">
                                <div class="w-50 d-flex">
                                    <span> Due date:  &nbsp;</span>
                                    <div class=" {{ ($task->due_date < now()) ? 'text-danger' : 'text-success' }}"> 
                                        {{ dateDisplay($task->due_date) }}
                                    </div>
                                </div>
                                <div class="w-50 d-flex justify-content-between">
                                    <div class="btn {{ getPriorityClass($task->priority) }}"> {{ getPriority($task->priority) }} </div>
                                    <div class="btn {{ getStatusClass($task->status) }}"> {{ getStatus($task->status) }} </div>
                                </div>                                
                            </div>
        
                            <div class="card-bloc d-flex justify-content-between align-items-center my-1">
                                <a href="{{ route('user.tasks.detail', ['id'=>$task->id])}}" class="cardTitle"> 
                                    {{ $task->title }}
                                </a>
                                <div class="assigned"> 
                                    <div class="ass-label"> Assigned to: </div> 
                                    <div class="d-flex justify-content-end align-items-center">
                                        
                                        @if (($task->users)->count() > 0)
                                            @php
                                                $count = 0;
                                            @endphp
                                            @foreach ($task->users as $user)
                                                @if (Auth::user()->id == $user->id)
                                                    <span class="owner">You</span>
                                                    @php
                                                        $count++;
                                                    @endphp
                                                @endif                                                            
                                            @endforeach
                                            
                                            @foreach ($task->users as $user)
                                                @if (Auth::user()->id != $user->id)
                                                    @php
                                                        $count++;
                                                    @endphp
                                                    @if ($count < 3)
                                                        <span class="member"><img src="{{ $user->avatar ? asset('storage'.$user->avatar) : asset('storage/uploads/avatar/user.png') }}" alt="avatar" ></span>                                                                                   
                                                    @endif                                        
                                                @endif                                                                                                     
                                            @endforeach

                                            @if ($task->users->count() > 2)
                                                <span class="ownerPlus">+{{$task->users->count() - 2}}</span>
                                            @endif
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
        
                            <div class="card-bloc d-flex justify-content-between align-items-center mt-1">
                                <div class="card-project d-flex align-items-start">
                                    <span class="project-label">Project:</span> 
                                    <a href="{{ route('user.projects.detail', ['id'=>$task->project->id]) }}" class="text-secondary"> &nbsp; {{ $task->project->name}} </a>
                                </div>
                                <div class="actions"> 
                                    <a href="{{ route('user.tasks.edit', ['id'=> $task->id]) }}">
                                        <img src="{{asset('img/edit.png')}}" alt="modify icon" >
                                    </a>
                                    <a href="{{ route('user.tasks.delete', ['id'=> $task->id]) }}" class="delete-action">
                                        <img src="{{asset('img/delete.png')}}" alt="delete icon" >
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                    @endforeach
                @endif              
   
            </div>
            
            <div class="copyright"> My Siteweb &copy; 2023 - All Rights Reserved</div>          
        </div>
        
        <div class="navbar-top d-flex justify-content-between align-items-center">              
            
            <div class="logo d-flex align-items-center">
                <i class="fa-solid fa-globe"></i>
                <div class="pt-2">SITEWEB NAME</div>
            </div>
            <div class="dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <span class='user-icon'>
                    <span class="username">{{ ucwords(Auth::user()->name) }}</span> 
                    <span class="member"><img src="{{asset('img/man.png')}}" alt="" ></span>
                </span>
            </div>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profil</a></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                    >Logout
                    </a>
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>

        </div>  

        <main class="layout-main px-4 pt-4 pb-2 h-100 w-100">
            @yield('content')
        </main>

        <div class="navbar-footer d-flex flex-column w-100">
            
            <div class="actions d-flex justify-content-between align-items-center w-100 h-100">
                
                <div class="footer-menu w-75 d-flex justify-content-evenly">
                    <a href="{{ route('user.projects.index') }}" class="menu-items">
                        <img src="{{asset('img/project-white.png')}}" alt="project icon" >
                        <span>ALL PROJECTS</span> 
                    </a>
                    <a href="{{ route('user.tasks.index') }}" class="menu-items">
                        <img src="{{asset('img/to-do-list-white.png')}}" alt="task icon" >
                        <span>ALL TASKS </span> 
                    </a>
                    <a href="{{url('/')}}" class="menu-items">
                        <img src="{{asset('img/home.png')}}" alt="home icon" >
                        <span>HOME</span>
                    </a>
                </div>
    
                <div class="services w-25 d-flex flex-column align-items-center">
                    <a href="#">Contact-us</a>
                    <a href="#">Privacy Policy</a>
                </div>

            </div>
        
            <div class="copyright w-100 text-center"> My Siteweb &copy; 2023 - All Rights Reserved</div>

        </div>  
    </div>

    @include('components.delete')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('script')

    <script defer src="{{asset('js/delete_task.js')}}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

</body>
</html>
