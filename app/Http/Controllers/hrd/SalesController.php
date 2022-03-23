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
    public function index( TeamSales $sale, Request $request)
    {
        $sales = TeamSales::groupBy('id_spv')->orderBy('id_spv','desc')->get();

        // dd($sales);

        foreach ($sales as $tim) {
            // $coba = TeamSales::whereIn('id_spv',$tim)->whereIn('id_manager',$tim)->first();
            // dd($coba);
        }
    

        return view('hrd.sales.index', compact('sales','coba'));
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
        
        return view('hrd.sales.edit', compact('spv','staff_marketing', 'manager_marketing', 'jabatans','sale'));
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
        // DB::beginTransaction();
        foreach( $sales as $tim => $no){
            
            $attr = TeamSales::where('id_sales',$no)->get();
            // dd($attr);
            $attr->update([
                'id_sales' => $tim,
                'id_manager' => $request->id_manager,
                'id_spv' => $request-> id_spv
            ]);
            // dd($attr);
        }
        return redirect()->route('hrd.sales.index')->with('success', 'Team Sales has been updated');
    }

    public function destroy(TeamSales $sale)
    {
        $team = TeamSales::where('id_spv', $sale->id_spv)->get();
        // dd($team);

        foreach ($team as $tim) {
            TeamSales::where('id_spv', $tim->id_spv)->delete();
            // $harga = HargaProdukCabang::where('barang_id', $pur->barang_id)->where('project_id', auth()->user()->project_id)->first();

         
            $tim->delete();
        }
    //   TeamSales::where('id',$id)->delete();
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
