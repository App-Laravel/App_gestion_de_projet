@extends('layouts.layout')

@section('title', 'User Task Detail')
    
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/task.css')}}">
@endsection

@section('content')

    <div class="task d-flex flex-column align-items-center w-100 mt-2">

        <table class="properties table">
            <thead>
                <tr>
                    <th colspan="3"><div class="task-name w-100">{{ ucfirst($task->title) }}</div></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3">
                        @if (session('msg-error'))
                            <div class="alert alert-warning text-center"> {{ session('msg-error') }} </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td> Created by: </td>
                    <td>  
                        {{ getCreatorName($task->creator_id) }}
                    </td>
                    <td rowspan="4"> 
                        <div class="actions d-flex flex-column align-items-center justify-content-center">
                            <a href="{{ route('user.tasks.edit', ['id'=>$task->id]) }}" class="modify btn btn-primary mb-4">Modify</a>
                            <a href="{{ route('user.tasks.delete', ['id'=>$task->id]) }}" class="delete delete-action btn btn-danger">Delete</a> 
                        </div>
                    </td>
                </tr>

                <tr>
                    <td> Status: </td>
                    <td> <div class="priority btn {{ getStatusClass($task->status) }} ">{{ getStatus($task->status) }}</div> </td>
                </tr>

                <tr>
                    <td> Priority: </td>
                    <td> <div class="priority btn {{ getPriorityClass($task->priority) }} ">{{ getPriority($task->priority) }}</div> </td>
                </tr>

                <tr>
                    <td> Due date: </td>
                    <td> {{ dateDisplay($task->due_date) }} </td>
                </tr>

                <tr>
                    <td> Project: </td>
                    <td colspan="2"> {{ $task->project->name }} </td>
                </tr>

                <tr>
                    <td> Assigned to: </td>
                    <td colspan="2" class="w-75">
                        <div class="d-flex w-100">                            
                            @foreach ($coworkers as $coworker)
                                <div class="coworker"> {{ getCreatorName($coworker->id) }} </div>
                            @endforeach                                                       
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="3"> 
                        <div>Comments:</div> 
                        <div class="comments p-2">{{ $task->comment }}</div>
                    </td>
                </tr>            
            </tbody>
        </table>

    </div>
    @include('components.delete')
@endsection

@section('script')
    <script defer src="{{asset('js/delete_task.js')}}"></script>
@endsection
