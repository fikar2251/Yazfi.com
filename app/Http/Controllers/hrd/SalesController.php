<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\{User, Cabang, Jabatan, Perusahaan, Project, TeamSales};
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index()
    {
        $users = TeamSales::orderBy('id','desc')->get();
        // dd($users);

        return view('hrd.tim-sales.index', compact('users'));
    }

    public function create()
    {

        $user = TeamSales::get(); 
        $roles = Role::get();

        $manager_marketing = User::role('marketing')->where('id_jabatans','1')->get();
        // dd($manager_marketing);

        $staff_marketing = User::role('marketing')->where('id_jabatans','2')->get();
        // dd($staff_marketing);

        $spv = User::role('supervisor')->get();
        dd($spv);

        return view('hrd.tim-sales.create', compact('roles','user', 'manager_marketing', 'staff_marketing', 'spv'));
    }

    public function store(StoreUserRequest $request)
    {
        $attr = $request->all();
        dd($attr);
        $user = TeamSales::create($attr);



        return redirect()->route('hrd.tim-sales.index')->with('success', 'User has been added');
    }


    public function edit(User $user)
    {
        $roles = Role::get();
        $perusahaans = Perusahaan::get();
        $jabatans = Jabatan::get();
        $projects = Project::get();
        $perkawinans = DB::table('status_pernikahans')->get();
        $agamas = DB::table('agamas')->get();

        return view('hrd.tim-sales.edit', compact('user', 'roles', 'perusahaans', 'jabatans', 'projects','perkawinans','agamas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->route('hrd.tim-sales.index')->with('success', 'User has been updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('hrd.tim-sales.index')->with('success', 'User has been deleted');
    }
    public function whereProject(Request $request)
    {
        $data = DB::table('perusahaans')
            ->leftJoin('projects', 'perusahaans.id', '=', 'projects.id_perusahaan')
            ->select('projects.nama_project')
            ->groupBy('projects.nama_project')
            ->where('perusahaans.id', $request->id)->get();
        return $data;
        dd($data);
    }
}
