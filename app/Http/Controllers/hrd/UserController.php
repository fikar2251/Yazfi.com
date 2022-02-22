<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\{User, Cabang, Jabatan, Perusahaan};
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('cabang')->get();

        return view('hrd.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::get();
        $warehouses = Cabang::get();
        $user = new User();
        $perusahaans = Perusahaan::get();
        $jabatans = Jabatan::get();

        return view('hrd.users.create', compact('roles', 'warehouses', 'user'));
    }

    public function store(StoreUserRequest $request)
    {
        $attr = $request->all();
        $image = $request->file('image');
        $imageUrl = $image->storeAs('images/users', \Str::random(15) . '.' . $image->extension());

        $attr['image'] = $imageUrl;
        $attr['is_active'] = 1;
        $attr['password'] = Hash::make($request->password);

        $user = User::create($attr);

        $user->assignRole($request->input('role'));

        return redirect()->route('hrd.users.index')->with('success', 'User has been added');
    }


    public function edit(User $user)
    {
        $roles = Role::get();
        $warehouses = Cabang::get();

        return view('hrd.users.edit', compact('user', 'roles', 'warehouses'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $attr = $request->all();
        if ($request->input('password') == null) {
            $attr['password'] = $user->password;
        } else {
            $attr['password'] =  Hash::make($request->password);
        }

        $image = $request->file('image');

        if ($request->file('image')) {
            Storage::delete($user->image);
            $imageUrl = $image->storeAs('images/users', \Str::random(15) . '.' . $image->extension());
            $attr['image'] = $imageUrl;
        } else {
            $attr['image'] = $user->image;
        }

        $user->update($attr);
        $user->syncRoles($request->input('role'));

        return redirect()->route('hrd.users.index')->with('success', 'User has been updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('hrd.users.index')->with('success', 'User has been deleted');
    }
}
