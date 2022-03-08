<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $path = 'pengguna';
        return view('user.index', compact('path'));
    }

    public function indexAPI()
    {
        $users = User::with('roles')->where('id', '!=', auth()->id())->get();
        return response($users);
    }

    public function create()
    {
        $path = 'pengguna';
        $roles =  Role::whereNotIn('name', ['Super Admin'])->get();

        // dd($roles);
        return view('user.create', compact('path', 'roles'));
    }

    public function store(UserRequest $request)
    {
        $array_store = array_merge($request->validated(), [
            'password' =>  Hash::make($request->password)
        ]);
        $user = User::create($array_store);
        $user->assignRole($request->role);

        return redirect('/user/index');
    }

    public function show(User $user)
    {
        $path = 'pengguna';
        $roles =  Role::whereNotIn('name', ['Super Admin'])->get();
        return view('user.update', compact('path', 'user', 'roles'));
    }

    public function update(User $user, Request $request)
    {

        if ($request->password) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'password' => ['present', 'string', 'min:8', 'confirmed'],
                'role' => 'required'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'role' => 'required'
            ]);
        }

        $array_store = array_merge($request->all(), [
            'password' =>  Hash::make($request->password)
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->syncRoles([$request->role]);
        $user->update($array_store);

        return redirect('/user/index');
    }

    public function destroy(User $user)
    {
        if ($user->hasRole('Super Admin')) {
            return response(['success' => false], 409);
        } else {
            $user->delete();
            return response(['success' => true]);
        }
    }
}
