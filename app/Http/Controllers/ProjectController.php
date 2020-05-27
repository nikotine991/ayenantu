<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use voku\helper\ASCII;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *  
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('projects.index', [
            
            'projects' => Project::latest()->paginate()
        ]);
    }

    public function show(Project $project)
    {  
        return view('projects.show', [
           
            'project' => $project
        ]);

        
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        
        $fields = request()->validate([
            'title' => 'required',
            'url' => 'required',
            'description' => 'required'
        ]);
        

        Project::create($fields);

        
        return redirect()->route('projects.index');
        
    }

    public function edit(Project $project)
    {
        return view('projects.edit', [
            'project' => $project
        ]);
    }

    public function update(Project $project)
    {
        $project->update([
           'title' => request('title'),
           'url' => request('url'),
           'description' => request('description') 
        ]);

        return redirect()->route('projects.show', $project);
    }
}