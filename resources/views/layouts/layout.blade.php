<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
            
            <div class="logo d-flex align-items-center">
                <i class="fa-solid fa-globe"></i>
                <div class="pt-2">SITEWEB NAME</div>
            </div>

            <div class="options mt-4 d-flex flex-column align-items-center">
                <div class="items-label mb-3">Boards</div>
                
                <a href="{{route('user.projects.index')}}" class="options-item mb-2 d-flex">
                    <span class="item-icon"><img src="{{asset('img/project.png')}}" alt="icon item sidebar" srcset=""></span>
                    <div class="item-label">Projects(5)</div>
                </a>

                <a href="{{route('user.tasks.index')}}" class="options-item mb-2 d-flex">
                    <span class="item-icon"><img src="{{asset('img/to-do-list.png')}}" alt="icon item sidebar" srcset=""></span>
                    <div class="item-label">Task(5)</div>
                </a>

                <a href="#" class="options-item mb-2 d-flex">
                    <span class="item-icon"><img src="{{asset('img/delete.png')}}" alt="icon item sidebar" srcset=""></span>
                    <div class="item-label">Trash(5)</div>
                </a>                   
            </div>

            <div class="options mt-4 d-flex flex-column align-items-center">
                <div class="recent-tasks-label mb-2">Recent Tasks</div>
                
                <div class="card d-flex flex-column align-items-center mb-2 p-1">

                    <div class="card-bloc d-flex justify-content-between align-items-center">
                        <div class="date"> 
                            Due date: 30/08/2023 
                        </div>
                        <div class="btn btn-danger"> High </div>
                        <div class="btn btn-primary">To do</div>
                    </div>

                    <div class="card-bloc d-flex justify-content-between align-items-center my-1">
                        <a href="#" class="card-title"> 
                            Task 1 name Task name 
                        </a>
                        <div class="assigned"> 
                            <div class="ass-label"> Assigned to: </div> 
                            <div class="ass-members"> 
                                <span class="member"><img src="{{asset('img/man.png')}}" alt="" srcset=""></span>
                                <span class="member"><img src="{{asset('img/man.png')}}" alt="" srcset=""></span>
                            </div>
                        </div>
                    </div>

                    <div class="card-bloc d-flex justify-content-between align-items-center my-1">
                        <a href class="card-project"> 
                            Belongs to Project
                        </a>
                        <div class="actions"> 
                            <a href="#"><img src="{{asset('img/edit.png')}}" alt="" srcset=""></a>
                            <a href="#"><img src="{{asset('img/delete.png')}}" alt="" srcset=""></a>
                        </div>
                    </div>
                </div>

                <div class="card d-flex flex-column align-items-center mb-2 p-1">

                    <div class="card-bloc d-flex justify-content-between align-items-center">
                        <div> 
                            Due date: 30/08/2023 
                        </div>
                        <div class="btn btn-danger"> High </div>
                        <div class="btn btn-primary">To do</div>
                    </div>

                    <div class="card-bloc d-flex justify-content-between align-items-center my-1">
                        <a href="#" class="card-title"> 
                            Task 1 name
                        </a>
                        <div class="assigned"> 
                            <div class="ass-label"> Assigned to: </div> 
                            <div class="ass-members"> 
                                <span class="member"><img src="{{asset('img/man.png')}}" alt="" srcset=""></span>
                                <span class="member"><img src="{{asset('img/man.png')}}" alt="" srcset=""></span>
                            </div>
                        </div>
                    </div>

                    <div class="card-bloc d-flex justify-content-between align-items-center my-1">
                        <a href class="card-project"> 
                            Belongs to Project
                        </a>
                        <div class="actions"> 
                            <a href="#"><img src="{{asset('img/edit.png')}}" alt="" srcset=""></a>
                            <a href="#"><img src="{{asset('img/delete.png')}}" alt="" srcset=""></a>
                        </div>
                    </div>
                </div>

                <div class="card d-flex flex-column align-items-center mb-2 p-1">

                    <div class="card-bloc d-flex justify-content-between align-items-center">
                        <div> 
                            Due date: 30/08/2023 
                        </div>
                        <div class="btn btn-danger"> High </div>
                        <div class="btn btn-primary">To do</div>
                    </div>

                    <div class="card-bloc d-flex justify-content-between align-items-center my-1">
                        <a href="#" class="card-title"> 
                            Task 1 name
                        </a>
                        <div class="assigned"> 
                            <div class="ass-label"> Assigned to: </div> 
                            <div class="ass-members"> 
                                <span class="member"><img src="{{asset('img/man.png')}}" alt="" srcset=""></span>
                                <span class="member"><img src="{{asset('img/man.png')}}" alt="" srcset=""></span>
                            </div>
                        </div>
                    </div>

                    <div class="card-bloc d-flex justify-content-between align-items-center my-1">
                        <a href class="card-project"> 
                            Belongs to Project
                        </a>
                        <div class="actions"> 
                            <a href="#"><img src="{{asset('img/edit.png')}}" alt="" srcset=""></a>
                            <a href="#"><img src="{{asset('img/delete.png')}}" alt="" srcset=""></a>
                        </div>
                    </div>
                </div>    
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
                    <span class="member"><img src="{{asset('img/man.png')}}" alt="" srcset=""></span>
                </span>
            </div>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Profil</a></li>
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

        <main class="layout-main p-4">
            @yield('content')
        </main>

        <div class="navbar-footer d-flex flex-column w-100">
            
            <div class="actions d-flex justify-content-between align-items-center w-100 h-100">
                
                <div class="footer-menu w-75 d-flex justify-content-evenly">
                    <a href="#" class="menu-items">
                        <img src="{{asset('img/project-white.png')}}" alt="" srcset="">
                        <span>ALL PROJECTS</span> 
                    </a>
                    <a href="#" class="menu-items">
                        <img src="{{asset('img/to-do-list-white.png')}}" alt="" srcset="">
                        <span>ALL TASKS </span> 
                    </a>
                    <a href="#" class="menu-items">
                        <img src="{{asset('img/home.png')}}" alt="" srcset="">
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
    @yield('script')
</body>
</html>
