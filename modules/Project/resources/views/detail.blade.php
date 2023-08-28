@extends('layouts.layout')

@section('title', 'User Project Detail')
    
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/project.css')}}">
@endsection

@section('content')

    <div class="project d-flex flex-column align-items-center w-100">
        
        <div class="project-name">Project Name</div>

        <ul>
            <li>
                <span>Created by: You</span>
            </li>
            <li>
                <span>Priority: </span>
                <div class="btn-danger">High</div>
            </li>
            <li>
                <div class="date">Start date: 15/07/2023</div>
            </li>
            <li>
                <div class="date">Due date: 15/07/2023</div>
            </li>
            <li>
                <label for="coworkers">Coworkers: 2</label>
                <select id="coworkers" class="select-form" disabled="disabled">
                    <option value="">Coworker 1 Name</option>
                    <option value="">Coworker 2 Name</option>
                    <option value="">Coworker 3 Name</option>
                </select>
            </li>
            <li>
                <label>Comments</label>
                <div class="comments">Comments Detail</div>
            </li>
            <li>
                <label>Tasks of Project:</label>
                <div class="tasks">
                    <div class="todo">

                    </div>
                    <div class="progress">
                        
                    </div>
                    <div class="done">
                        
                    </div>
                </div>
            </li>
        </ul>

        <div class="actions">
            <a href="#" class="modify btn btn-primary">Modify</a>
            <a href="#" class="delete btn btn-danger">Delete</a>
        </div>

    </div>

@endsection
