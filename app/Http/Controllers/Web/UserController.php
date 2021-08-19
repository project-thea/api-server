<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    public const NUMBER_OF_RECORDS = 5;

    /**
     * Display a listing of the user resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('isAdmin');

        $users = User::select('users.*', 'roles.name')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->orderBy('users.id', 'asc')
            ->paginate(self::NUMBER_OF_RECORDS);

        $trashedUsers = User::select('users.*', 'roles.name')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->orderBy('users.deleted_at', 'desc')
            ->onlyTrashed()
            ->paginate(self::NUMBER_OF_RECORDS);

        return Inertia::render('Users/Index', [
            'users' => $users,
            'trashedUsers' => $trashedUsers
        ]);
    }

    /**
     * Show the form for creating a new user resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isAdmin');

        $roles = Role::all();
        return Inertia::render('Users/Create', ['roles' => $roles]);
    }

    /**
     * Store a newly created user resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('isAdmin');

        $validatedData = $request->validated();
        $validatedData['password'] = bcrypt($request->password);
        
        User::create($validatedData);
        return Redirect::route('users.index')->with('success', 'User successfully created.');
    }

    /**
     * Show the form for editing the specified user resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('isAdmin');

        $user = User::find($id);
        $roles = Role::all();
        return Inertia::render('Users/Edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified user resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $this->authorize('isAdmin');

        $validatedData = $request->validated();
        $user = User::find($id);
        $user->update($validatedData);
        return Redirect::route('users.index')->with('success', 'User successfully updated.');
    }

    /**
     * Remove the specified user resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $user = User::find($id);
        $user->delete();
        return Redirect::route('users.index')->with('success', 'User successfully archived.');
    }

    /**
     * Restore the specified user resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->authorize('isAdmin');

        $user = User::withTrashed()->find($id);
        $user->restore();
        return Redirect::route('users.index')->with('success', 'User successfully restored.');
    }
}
