@extends('layouts.layout')

@section('title', 'User Project Detail')
    
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/project.css')}}">
@endsection

@section('content')

    <div class="project d-flex flex-column align-items-center w-100 mt-2">

        <table class="properties table">
            <thead>
                <tr>
                    <th colspan="3"><div class="project-name w-100">Project Name</div></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> Created by: </td>
                    <td> You </td>
                    <td rowspan="5"> 
                        <div class="actions d-flex flex-column align-items-center justify-content-center">
                            <a href="#" class="modify btn btn-primary mb-4">Modify</a>
                            <a href="#" class="delete btn btn-danger">Delete</a> 
                        </div>
                    </td>
                </tr>

                <tr>
                    <td> Priority: </td>
                    <td> <div class="priority btn btn-danger">High</div> </td>
                </tr>

                <tr>
                    <td> Start date: </td>
                    <td> 15/07/2023 </td>
                </tr>

                <tr>
                    <td> Due date: </td>
                    <td> 15/07/2023 </td>
                </tr>

                <tr>
                    <td> Coworkers: </td>
                    <td>  
                        <div>
                            <label for="coworkers"> 3</label>
                            <select id="coworkers" class="select-form">
                                <option value="">Coworker 1 Name</option>
                                <option value="">Coworker 2 Name</option>
                                <option value="">Coworker 3 Name</option>
                            </select>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="3"> 
                        <div>Comments:</div> 
                        <div class="comments"></div>
                    </td>
                </tr>            
            </tbody>
        </table>

        <div class="tasks mb-5">

            <div>Tasks of Project:</div>

            <div class="w-100 d-flex justify-content-between align-items-start">
                
                <div class="todo">
                    <div class="taskTitle w-100">TO DO</div>
                    
                    <div class="p-card w-100 mb-1 p-1">
                        <div class="card-bloc d-flex justify-content-between align-items-center">
                            <div class="date"> Due date: 30/08/2023 </div>
                            <div class="btn btn-danger"> High </div>
                        </div>    
                        <div class="card-bloc d-flex justify-content-between align-items-center">
                            <a href="#" class="card-title"> 
                                Task 1 name Task name Task 1 name Task name
                            </a>
                            <div class="taskActions"> 
                                <a href="#"><img src="{{asset('img/edit.png')}}" alt="" srcset=""></a>
                                <a href="#"><img src="{{asset('img/delete.png')}}" alt="" srcset=""></a>
                            </div>
                        </div>
                    </div>

                    <div class="p-card w-100 mb-1 p-1">
                        <div class="card-bloc d-flex justify-content-between align-items-center">
                            <div class="date"> Due date: 30/08/2023 </div>
                            <div class="btn btn-danger"> High </div>
                        </div>    
                        <div class="card-bloc d-flex justify-content-between align-items-center">
                            <a href="#" class="card-title"> 
                                Task 1 name Task name Task 1 name Task name
                            </a>
                            <div class="taskActions"> 
                                <a href="#"><img src="{{asset('img/edit.png')}}" alt="" srcset=""></a>
                                <a href="#"><img src="{{asset('img/delete.png')}}" alt="" srcset=""></a>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="new-task mt-2 w-100 d-flex justify-content-center align-items-center">
                        <img src="{{asset('img/plusblack.png')}}" alt="plus icon" srcset="">
                        <div>Add new task</div>
                    </a>

                </div>

                <div class="inprogress">
                    <div class="taskTitle w-100">IN PROGRESS</div>
                    
                    <div class="p-card w-100 mb-1 p-1">
                        <div class="card-bloc d-flex justify-content-between align-items-center">
                            <div class="date"> Due date: 30/08/2023 </div>
                            <div class="btn btn-danger"> High </div>
                        </div>    
                        <div class="card-bloc d-flex justify-content-between align-items-center">
                            <a href="#" class="card-title"> 
                                Task 1 name Task name Task 1 name Task name
                            </a>
                            <div class="taskActions"> 
                                <a href="#"><img src="{{asset('img/edit.png')}}" alt="" srcset=""></a>
                                <a href="#"><img src="{{asset('img/delete.png')}}" alt="" srcset=""></a>
                            </div>
                        </div>
                    </div>

                    <div class="p-card w-100 mb-1 p-1">
                        <div class="card-bloc d-flex justify-content-between align-items-center">
                            <div class="date"> Due date: 30/08/2023 </div>
                            <div class="btn btn-danger"> High </div>
                        </div>    
                        <div class="card-bloc d-flex justify-content-between align-items-center">
                            <a href="#" class="card-title"> 
                                Task 1 name Task name Task 1 name Task name
                            </a>
                            <div class="taskActions"> 
                                <a href="#"><img src="{{asset('img/edit.png')}}" alt="" srcset=""></a>
                                <a href="#"><img src="{{asset('img/delete.png')}}" alt="" srcset=""></a>
                            </div>
                        </div>
                    </div>

                    <div class="p-card w-100 mb-1 p-1">
                        <div class="card-bloc d-flex justify-content-between align-items-center">
                            <div class="date"> Due date: 30/08/2023 </div>
                            <div class="btn btn-danger"> High </div>
                        </div>    
                        <div class="card-bloc d-flex justify-content-between align-items-center">
                            <a href="#" class="card-title"> 
                                Task 1 name Task name Task 1 name Task name
                            </a>
                            <div class="taskActions"> 
                                <a href="#"><img src="{{asset('img/edit.png')}}" alt="" srcset=""></a>
                                <a href="#"><img src="{{asset('img/delete.png')}}" alt="" srcset=""></a>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="new-task mt-2 w-100 d-flex justify-content-center align-items-center">
                        <img src="{{asset('img/plusblack.png')}}" alt="plus icon" srcset="">
                        <div>Add new task</div>
                    </a>
                    
                    
                </div>

                <div class="done">
                    <div class="taskTitle w-100">DONE</div>
                    
                    <div class="p-card w-100 mb-1 p-1">
                        <div class="card-bloc d-flex justify-content-between align-items-center">
                            <div class="date"> Due date: 30/08/2023 </div>
                            <div class="btn btn-danger"> High </div>
                        </div>    
                        <div class="card-bloc d-flex justify-content-between align-items-center">
                            <a href="#" class="card-title"> 
                                Task 1 name Task name Task 1 name Task name
                            </a>
                            <div class="taskActions"> 
                                <a href="#"><img src="{{asset('img/edit.png')}}" alt="" srcset=""></a>
                                <a href="#"><img src="{{asset('img/delete.png')}}" alt="" srcset=""></a>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="new-task mt-2 w-100 d-flex justify-content-center align-items-center">
                        <img src="{{asset('img/plusblack.png')}}" alt="plus icon" srcset="">
                        <div>Add new task</div>
                    </a>
                    
                    
                </div>
            </div>
        </div>

    </div>

@endsection
