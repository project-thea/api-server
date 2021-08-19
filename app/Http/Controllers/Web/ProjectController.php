<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Inertia\Inertia;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public const NUMBER_OF_RECORDS = 5;

    /**
     * Display a listing of the project resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query_params = $request->all();
        $trashedProjects = Project::onlyTrashed()->latest()->paginate(self::NUMBER_OF_RECORDS);

        if (isset($query_params['search'])) {
            $projects = Project::query()
                ->where('name', 'LIKE', '%' . $query_params['search'] . '%')
                ->paginate(self::NUMBER_OF_RECORDS);
        } else {
            $projects = Project::orderBy('id', 'desc')->paginate(self::NUMBER_OF_RECORDS);
        }

        return Inertia::render('Projects/Index', [
            'filters' => [
                'search' => isset($query_params['search']) ? $query_params['search'] : ''
            ],
            'projects' => $projects,
            'trashedProjects' => $trashedProjects
        ]);
    }

    /**
     * Show the form for creating a new project resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isAdmin');
        return Inertia::render('Projects/Create');
    }

    /**
     * Store a newly created project resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin');

        $data = $request->all();

        $validationRules = [
            'name' => 'required|string|max:55',
            'description' => 'required|string|max:250',
        ];

        $validateData = Validator::make($data, $validationRules);

        if ($validateData->fails()) {
            return Redirect::route('projects.create')->withErrors($validateData);
        }

        Project::create($data);
        return Redirect::route('projects.index')->with('success', 'Project successfully created.');
    }

    /**
     * Show the form for editing the specified project resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('isAdmin');

        $project = Project::find($id);

        return Inertia::render('Projects/Edit', [
            'project' => $project
        ]);
    }

    /**
     * Update the specified project resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin');

        $data = $request->all();

        $validationRules = [
            'name' => 'required|string|max:55',
            'description' => 'required|string|max:250'
        ];

        $validateData = Validator::make($data, $validationRules);

        if ($validateData->fails()) {
            return Redirect::route('projects.edit')->withErrors($validateData);
        }

        $project = Project::find($id);
        $project->update($data);

        return Redirect::route('projects.index')->with('success', 'Project successfully updated.');
    }

    /**
     * Remove the specified project resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $project = Project::find($id);
        $project->delete();
        return Redirect::route('projects.index')->with('success', 'Project successfully deleted.');
    }

    /**
     * Restore the specified project resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->authorize('isAdmin');

        $project = Project::withTrashed()->find($id);
        $project->restore();
        return Redirect::route('projects.index')->with('success', 'Project successfully restored.');
    }
}
