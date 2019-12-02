<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = User::all();
        return view('users.index', ['users' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(UserCreateRequest $request)
    {
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);
        return redirect()->route('user');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     * @return Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param User $user
     * @return void
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            $user->update($request->except('email', 'password'));
            $status = __('User updated successfully');
        } catch (\Exception $exception) {
            $status = $exception->getMessage();
        }
        return redirect()->route('user.edit', $user['id'])->with('status', $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            $status = __('Profile deleted!');
        } catch (\Exception $exception) {
            $status = $exception->getMessage();
        }
        return redirect()->route('user')->with('status', $status);
    }
}
