@extends('layouts.layout')

@section('title', 'Add Project')
    
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/crud_project.css')}}">
@endsection

@section('content')
    <div class="add-project w-100 d-flex justify-content-center mt-2 mb-4">

        <div class="add-form d-flex flex-column align-items-center">

            <div class="add-label w-100"> Create new project </div>
    
            <form method="POST" action="{{ route('user.projects.postAdd') }}" class="d-flex flex-column w-100">  
    
                <div class="mb-3">
                    <label for="name"> {{ __('Name') }} </label>
    
                    <div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="Name of the project..." autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                </div>
    
                <div class="mb-3">
                    <label for="priority"> {{ __('Priority') }} </label>
                    <div>
                        <select name="priority" id="priority" class="form-select {{$errors->has('priority')? 'is-invalid' :''}}">
                            <option value="0">Select priority</option>
                            <option value="1" {{ old('priority') == 1 ? 'selected' : false}} >High</option>
                            <option value="2" {{ old('priority') == 2 ? 'selected' : false}} >Medium</option>
                            <option value="3" {{ old('priority') == 3 ? 'selected' : false}} >Low</option>
                        </select>
                        @error('priority')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>                    
                </div>
    
                <div class="mb-3 d-flex justify-content-between">
    
                    <div class="date">
                        <label for="startdate"> {{ __('Start date') }} </label>
                        <div>
                            <input id="startdate" type="date" class="form-control @error('startdate') is-invalid @enderror" name="startdate" value="{{ old('startdate') }}" required>
                            @error('startdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="date">
                        <label for="duedate"> {{ __('Due date') }} </label>
                        <div>
                            <input id="duedate" type="date" class="form-control @error('duedate') is-invalid @enderror" name="duedate" value="{{ old('duedate') }}" required>
                            @error('duedate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                </div>
    
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label> {{ __('Invite the coworkers') }} </label>
                        <img class="add-email" src="{{asset('img/plus_color.png')}}" alt="plus icon">
                    </div>
                    
                    @if (old('email'))
                        @foreach (old('email') as $item)                            
                            <div class="invites">
                                <input type="email" class="form-control invite" name="email[]" value="{{$item}}" autocomplete="email" placeholder="Email of coworkers...">
                            </div>                            
                        @endforeach
                    @else                    
                        <div class="invites">
                            <input type="email" class="form-control invite" name="email[]" autocomplete="email" placeholder="Email of coworkers...">
                        </div>
                    @endif
                    

                </div>
    
                <div class="mb-3">
                    <label for="comment"> {{ __('Comment') }} </label>
                    <div>
                        <textarea name="comment" id="comment" rows="3" class="form-control" placeholder="Comments..."> {{old('comment')}} </textarea>
                    </div>
                </div>
    
                <div class="actions d-flex justify-content-evenly">
    
                    <button type="submit" class="btn btn-primary"> {{ __('Create') }} </button>
                    
                    <button type="reset" class="btn btn-warning">  {{ __('Reset') }}  </button>
                    
                    <a href="{{ route('user.projects.index') }}" type="button" class="btn btn-danger">{{ __('Cancel') }}</a>
    
                </div>               
    
                @csrf
                @method('POST')
            </form>
    
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" defer src="{{asset('js/add_email.js')}}"></script>
@endsection