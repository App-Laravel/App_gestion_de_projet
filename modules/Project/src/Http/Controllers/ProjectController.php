<?php

namespace Modules\Project\src\Http\Controllers;

use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Project::list');
    }

    public function detail($id)
    {
        return view('Project::detail');
    }

    public function add()
    {
        return view('Project::add');
    }

    public function edit($id)
    {
        return view('Project::edit');
    }
}
