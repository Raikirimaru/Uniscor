<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::orderBy('created_at', 'DESC');

        if (!empty($request->keyword)) {
            $users->where('name', 'like', '%'.$request->keyword.'%');
        }

        $users = $users->paginate(5);
        return view('user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->delete() === false) {
            return response(
                "Couldn't delete the user with id {$id}",
                Response::HTTP_BAD_REQUEST
            );
        }

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
