@extends('layouts.layout')

@section('title', 'Edit Task')
    
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/crud_task.css')}}">
@endsection

@section('content')
    <div class="add-project w-100 d-flex justify-content-center mt-2 mb-4">

        <div class="add-form d-flex flex-column align-items-center">

            <div class="add-label w-100"> Modify the task </div>
            
            @if (session('msg'))
                <div class="alert alert-success" role="alert"> {{ session('msg') }} </div>
            @endif

            @if (session('msg-error'))
                <div class="alert alert-warning" role="alert"> {{ session('msg-error') }} </div>
            @endif
    
            <form method="POST" action="{{ route('user.tasks.postEdit') }}" class="d-flex flex-column w-100">  
    
                <div class="mb-3">
                    <label for="title"> {{ __('Title') }} </label>
    
                    <div>
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $task->title }}" required placeholder="Title of the task..." autocomplete="title" autofocus>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                </div>
    
                <div class="w-100 d-flex justify-content-between">
                    <div class="status mb-3">
                        <label for="status"> {{ __('Status') }} </label>
                        <div>
                            <select name="status" id="status" class="form-select {{$errors->has('status')? 'is-invalid' :''}}">
                                <option value="0">Select status</option>
                                <option value="1" {{ (old('status') == 1 || $task->status == 1) ? 'selected' : false}} >To Do</option>
                                <option value="2" {{ (old('status') == 2 || $task->status == 2) ? 'selected' : false}} >In Progress</option>
                                <option value="3" {{ (old('status') == 3 || $task->status == 3) ? 'selected' : false}} >Done</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>                    
                    </div>

                    <div class="priority mb-3">
                        <label for="priority"> {{ __('Priority') }} </label>
                        <div>
                            <select name="priority" id="priority" class="form-select {{$errors->has('priority')? 'is-invalid' :''}}">
                                <option value="0">Select priority</option>
                                <option value="1" {{ (old('priority') == 1 || $task->priority == 1) ? 'selected' : false}} >High</option>
                                <option value="2" {{ (old('priority') == 2 || $task->priority == 2) ? 'selected' : false}} >Medium</option>
                                <option value="3" {{ (old('priority') == 3 || $task->priority == 3) ? 'selected' : false}} >Low</option>
                            </select>
                            @error('priority')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>                    
                    </div>
                </div>
                
                <div class="date mb-3">
                    <label for="duedate"> {{ __('Due date') }} </label>
                    <div>
                        <input id="duedate" type="date" class="form-control @error('duedate') is-invalid @enderror" name="duedate" value="{{ old('duedate') ?? $task->due_date }}" required>
                        @error('duedate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="project_id"> {{ __('Belongs to Project') }} </label>
                    <div>
                        <select name="project_id" id="project_id" class="form-select {{$errors->has('project_id')? 'is-invalid' :''}}">
                            <option value="0">Select the project</option>
                            @if (getProjects()->count() > 0)
                                @foreach (getProjects() as $project)
                                    <option value="{{ $project->id }}" {{ (old('project_id') == $project->id || $task->project_id == $project->id) ? 'selected' : false}} > {{ $project->name }}</option>
                                @endforeach                                
                            @endif
                        </select>
                        @error('priority')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>                    
                </div>

                <div class="assigned-members mb-3">
                    <label> {{ __('Assigned to') }} </label>
                    <div class="dropbtn form-select">Select the team members</div> 
                    
                    @if ($coworkers->count() > 0)
                        @foreach ($coworkers as $coworker)
                            <input type="hidden" class="team-infos" value="{{$coworker->id}}">
                        @endforeach
                    @endif
                    
                    <div class="dropdown-content">
                        {{-- <div class="dropdown-item">
                            <input type="checkbox" name="members[]" value="member 1" class="item-checkbox">
                            <span class="item-label">Member 1</span>
                        </div> --}}
                    </div>
                    
                    
                </div>
    
                <div class="mb-3">
                    <label for="comment"> {{ __('Comment') }} </label>
                    <div>
                        <textarea name="comment" id="comment" rows="3" class="form-control" placeholder="Comments..."> {{ old('comment') ?? $task->comment }} </textarea>
                    </div>
                </div>
    
                <div class="actions d-flex justify-content-evenly">
    
                    <button type="submit" class="btn btn-primary"> {{ __('Modify') }} </button>                    
                    
                    <a href="{{ route('user.tasks.index') }}" type="button" class="btn btn-danger">{{ __('Cancel') }}</a>
    
                </div>               
    
                @csrf
                @method('PUT')
            </form>
    
        </div>
    </div>
@endsection

@section('script')

    <script src="{{ asset('js/dropdown.js') }}"></script>

    <script src="{{ asset('js/show_team_members.js') }}"></script>

@endsection