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
        $sales = TeamSales::join('users','users.id','=','team_sales.id_sales')
        ->select('users.name','team_sales.id','team_sales.id_manager','team_sales.id_spv')
        ->groupBy('team_sales.id_manager')
        ->get();

        // dd($sales);

        return view('hrd.sales.index', compact('sales'));
    }

    public function create(TeamSales $sale)
    {


        $roles = Role::get();

        $manager_marketing = User::role('marketing')->where('id_jabatans','1')->get();
        // dd($manager_marketing);

        $staff_marketing = User::role('marketing')->where('id_jabatans','2')->get();
        // dd($staff_marketing);

        $spv = User::role('supervisor')->get();
        // dd($spv);

        return view('hrd.sales.create', compact('roles','sale', 'manager_marketing', 'staff_marketing', 'spv'));
    }

    public function store(Request $request)
    {
        $sales = $request->input('id_sales', []);
        // dd($sales);
        // $attr = $request->all();
        $attr= [];
        DB::beginTransaction();
        foreach( $sales as $tim){
            $attr[]=[
                'id_sales' => $tim,
                'id_manager' => $request->id_manager,
                'id_spv' => $request-> id_spv
            ];
            // dd($attr);

        }
        
        TeamSales::insert($attr);
        DB::commit();

        return redirect()->route('hrd.sales.index')->with('success', 'Team Sales has been added');
    }


    public function edit(TeamSales $sale)
    {
        $roles = Role::get();
        
        $manager_marketing = User::role('marketing')->where('id_jabatans','1')->get();
        // dd($manager_marketing);

        $staff_marketing = User::role('marketing')->where('id_jabatans','2')->get();
        // dd($staff_marketing);

        $spv = User::role('supervisor')->get();
        

        return view('hrd.sales.edit', compact('spv', 'staff_marketing', 'manager_marketing', 'jabatans','sale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeamSales $sale)
    {
        $sales = $request->input('id_sales', []);
        // dd($sales);
        // $attr = $request->all();
        $attr= [];
        DB::beginTransaction();
        foreach( $sales as $key => $tim){
            $attr[]=[
                'id_sales' => $tim,
                'id_manager' => $request->id_manager,
                'id_spv' => $request-> id_spv
            ];
            // dd($attr);
            // $temSales = TeamSales::where('id_sales', $tim)->get();
            // dd($temSales);

            DB::table('team_sales')->whereIn('id_sales', $attr)->update(array( 
                'id_sales' => $tim,
                'id_manager' => $request->id_manager,
                'id_spv' => $request-> id_spv));
            // $sale->update($attr);
           
        }

        DB::commit();
  

        return redirect()->route('hrd.sales.index')->with('success', 'Team Sales has been updated');
    }

    public function destroy( $id)
    {
        $user = TeamSales::where('id',$id)->delete();
        return redirect()->route('hrd.sales.index')->with('success', 'Team Sales has been deleted');
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
