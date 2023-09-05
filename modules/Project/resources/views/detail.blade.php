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
                    <th colspan="3"><div class="project-name w-100">{{ ucfirst($project->name) }}</div></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3">
                        @if (session('msg'))
                            <div class="alert alert-success text-center" role="alert"> {{ session('msg') }} </div>
                        @endif
                
                        @if (session('msg-error'))
                            <div class="alert alert-warning text-center" role="alert"> {{ session('msg-error') }} </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td> Created by: </td>
                    <td>  
                        {{ getCreatorName($project->creator_id) }}
                    </td>
                    <td rowspan="5"> 
                        <div class="actions d-flex flex-column align-items-center justify-content-center">
                            <a href="{{ route('user.projects.edit', ['id'=>$project->id]) }}" class="modify btn btn-primary mb-4">Modify</a>
                            <a href="{{ route('user.projects.delete', ['id'=>$project->id]) }}" class="delete delete-action btn btn-danger">Delete</a> 
                        </div>
                    </td>
                </tr>

                <tr>
                    <td> Priority: </td>
                    <td> <div class="priority btn {{ getPriorityClass($project->priority) }} ">{{ getPriority($project->priority) }}</div> </td>
                </tr>

                <tr>
                    <td> Start date: </td>
                    <td> {{ dateDisplay($project->start_date) }} </td>
                </tr>

                <tr>
                    <td> Due date: </td>
                    <td> {{ dateDisplay($project->due_date) }} </td>
                </tr>

                <tr>
                    <td> Coworkers: </td>
                    <td>  
                        <div>
                            <label for="coworkers"> {{ $coworkers->count() }} </label>
                            <select id="coworkers" class="select-form">

                                @foreach ($coworkers as $coworker)
                                    <option value="{{ $coworker->id }}">{{ ucwords($coworker->name) }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="3"> 
                        <div>Comments:</div> 
                        <div class="comments p-2">{{ $project->comment }}</div>
                    </td>
                </tr>            
            </tbody>
        </table>

        <div class="tasks mb-5">

            <div>Tasks of Project:</div>

            <div class="w-100 d-flex justify-content-between align-items-start">
                
                <div class="todo">
                    <div class="taskTitle w-100">TO DO</div>
                    
                    @if ($todo->count() > 0)
                        @foreach ($todo as $item)
                            <div class="p-card w-100 mb-1 p-1">
                                <div class="card-bloc d-flex justify-content-between align-items-center">
                                    <div class="date"> Due date: {{ dateDisplay($item->due_date) }} </div>
                                    <div class="btn {{ getPriorityClass($item->priority) }} ">{{ getPriority($item->priority) }}</div>
                                </div>    
                                <div class="card-bloc d-flex justify-content-between align-items-center">
                                    <a href="{{ route('user.tasks.detail', ['id'=>$item->id])}}" class="card-title"> 
                                        {{ ucfirst($item->title) }}
                                    </a>
                                    <div class="taskActions"> 
                                        <a href="{{ route('user.tasks.edit', ['id'=>$item->id])}}">
                                            <img src="{{asset('img/edit.png')}}" alt="edit icon" >
                                        </a>
                                        <a href="{{ route('user.tasks.delete-in-project', ['id'=> $item->id]) }}" class="delete-action">
                                            <img src="{{asset('img/delete.png')}}" alt="delete icon" >
                                        </a>                                    
                                    </div>
                                </div>
                            </div> 
                        @endforeach                        
                    @endif

                    <a href="{{ route('user.tasks.add') }}" class="new-task mt-2 w-100 d-flex justify-content-center align-items-center">
                        <img src="{{asset('img/plusblack.png')}}" alt="plus icon" >
                        <div>Add new task</div>
                    </a>
                </div>

                <div class="inprogress">
                    <div class="taskTitle w-100">IN PROGRESS</div>
                    
                    @if ($inprogress->count() > 0)
                        @foreach ($inprogress as $item)
                            <div class="p-card w-100 mb-1 p-1">
                                <div class="card-bloc d-flex justify-content-between align-items-center">
                                    <div class="date"> Due date: {{ dateDisplay($item->due_date) }} </div>
                                    <div class="btn {{ getPriorityClass($item->priority) }} ">{{ getPriority($item->priority) }}</div>
                                </div>    
                                <div class="card-bloc d-flex justify-content-between align-items-center">
                                    <a href="{{ route('user.tasks.detail', ['id'=>$item->id])}}" class="card-title"> 
                                        {{ ucfirst($item->title) }}
                                    </a>
                                    <div class="taskActions"> 
                                        <a href="{{ route('user.tasks.edit', ['id'=>$item->id])}}">
                                            <img src="{{asset('img/edit.png')}}" alt="edit icon" >
                                        </a>
                                        <a href="{{ route('user.tasks.delete-in-project', ['id'=> $item->id]) }}" class="delete-action">
                                            <img src="{{asset('img/delete.png')}}" alt="delete icon" >
                                        </a>                                    
                                    </div>
                                </div>
                            </div> 
                        @endforeach                        
                    @endif
                    
                    <a href="{{ route('user.tasks.add') }}" class="new-task mt-2 w-100 d-flex justify-content-center align-items-center">
                        <img src="{{asset('img/plusblack.png')}}" alt="plus icon" >
                        <div>Add new task</div>
                    </a>
                </div>

                <div class="done">
                    <div class="taskTitle w-100">DONE</div>
                    
                    @if ($done->count() > 0)
                        @foreach ($done as $item)
                            <div class="p-card w-100 mb-1 p-1">
                                <div class="card-bloc d-flex justify-content-between align-items-center">
                                    <div class="date"> Due date: {{ dateDisplay($item->due_date) }} </div>
                                    <div class="btn {{ getPriorityClass($item->priority) }} ">{{ getPriority($item->priority) }}</div>
                                </div>    
                                <div class="card-bloc d-flex justify-content-between align-items-center">
                                    <a href="{{ route('user.tasks.detail', ['id'=>$item->id])}}" class="card-title"> 
                                        {{ ucfirst($item->title) }}
                                    </a>
                                    <div class="taskActions"> 
                                        <a href="{{ route('user.tasks.edit', ['id'=>$item->id])}}">
                                            <img src="{{asset('img/edit.png')}}" alt="edit icon" >
                                        </a>
                                        <a href="{{ route('user.tasks.delete-in-project', ['id'=> $item->id]) }}" class="delete-action">
                                            <img src="{{asset('img/delete.png')}}" alt="delete icon" >
                                        </a>                                    
                                    </div>
                                </div>
                            </div> 
                        @endforeach                        
                    @endif

                    <a href="{{ route('user.tasks.add') }}" class="new-task mt-2 w-100 d-flex justify-content-center align-items-center">
                        <img src="{{asset('img/plusblack.png')}}" alt="plus icon" >
                        <div>Add new task</div>
                    </a>                    
                </div>

            </div>
        </div>

    </div>

    @include('components.delete')
@endsection

@section('script')
    <script defer src="{{asset('js/delete_task.js')}}"></script>
@endsection
