<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Marketing;
use App\Project;
use App\Spr;
use App\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PricelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blok = DB::table('unit_rumah')
            ->groupBy('type')
            ->get();

        $spr = Spr::all();
        return view('marketing.pricelist.index', compact('blok', ''));
    }

    public function blok(Request $request)
    {
        $data = DB::table('unit_rumah')
            ->select('unit_rumah.type', 'unit_rumah.blok', 'unit_rumah.no', 'unit_rumah.lt')
            ->groupBy('unit_rumah.blok')
            ->where('unit_rumah.type', $request->type)->get();

        return $data;
    }

    public function no(Request $request)
    {
        $data = DB::table('unit_rumah')
            ->select('unit_rumah.id_unit_rumah','unit_rumah.type', 'unit_rumah.blok', 'unit_rumah.no', 'unit_rumah.lt')
            ->groupBy('unit_rumah.no')
            ->where('unit_rumah.blok', $request->blok)->get();

        return $data;
    }

    public function lt(Request $request)
    {
        $lutan = [
            'blok' => $request->blok,
            'no' => $request->no,
        ];

        $data = DB::table('unit_rumah')
            ->select('unit_rumah.type','unit_rumah.id_unit_rumah','unit_rumah.blok', 'unit_rumah.no', 'unit_rumah.lt', 'unit_rumah.harga_jual', 'unit_rumah.lb')
            ->groupBy('unit_rumah.lt', 'unit_rumah.no')
            ->where($lutan)->get();

        return $data;
    }

    public function hj(Request $request)
    {
        $harju = [
            'blok' => $request->blok,
            'no' => $request->no,
            'lt' => $request->lt
        ];

        $data = DB::table('unit_rumah')
            ->select('unit_rumah.blok', 'unit_rumah.no', 'unit_rumah.lt', 'unit_rumah.harga_jual', 'unit_rumah.lb')
            ->groupBy('unit_rumah.harga_jual')
            ->where($harju)->get();

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('marketing.pricelist.create', [
        //     'data' => Price
        // ])
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // $project = Project::find($project->id);
        //     $projectId = Project::where('id', $id)->pluck('id');
        //    dd($projectId);

        // foreach ($projectId as $key => $id) {
        //     // $attr[] = 
        //     $id[] = $projectId[$key];
        // }

        // Spr::create([
        //     'no_transaksi' => $request->no_transaksi,
        //     'id_sales' => auth()->user()->id,
        //     'id_project' => '1',
        //     'id_unit' => $request->type,
        //     'id_perusahaan' => '1',
        //     'tanggal_transaksi' => $request->tanggal_transaksi,
        //     'skema' => $request->skema,
        //     'nama' => $request->nama,
        //     'alamat' => $request->alamat,
        //     'no_ktp' => $request->no_ktp,
        //     'npwp' => $request->npwp,
        //     'no_tlp' => $request->no_tlp,
        //     'no_hp' => $request->no_hp,
        //     'email' => $request->email,
        //     'pekerjaan' => $request->pekerjaan,
        //     'status_booking' => 'unpaid',
        //     'status_approval' => 'pending',
        //     'status_dp' => 'unpaid',
        //     'harga_jual' => $request->harga_jual,
        //     'diskon' => $request->potongan,
        //     'harga_net' => $request->harga_net,
        //     'total_luas_tanah' => $request->tlt
        // ]);

        // return redirect()->route('marketing.dashboard');
    }

    public function storeSpr(Request $request, $id)
    {   

        $spr = Project::where('id', $id)->pluck('id');

        Spr::create([
            'no_transaksi' => $request->no_transaksi,
            'id_sales' => auth()->user()->id,
            'id_project' => '1',
            'id_unit' => $request->id_unit,
            'id_perusahaan' => '1',
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'skema' => $request->skema,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'npwp' => $request->npwp,
            'no_tlp' => $request->no_tlp,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'pekerjaan' => $request->pekerjaan,
            'status_booking' => 'unpaid',
            'status_approval' => 'pending',
            'status_dp' => 'unpaid',
            'harga_jual' => $request->harga_jual,
            'diskon' => $request->potongan,
            'harga_net' => $request->harga_net,
            'total_luas_tanah' => $request->tlt
        ]);

        return redirect()->route('marketing.dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Project $project)
    {
        $attr = [];

        $spr = Project::where('id', $id)->pluck('id');

        // foreach ($spr as $key => $no) {
        //     // $attr[] = 
        //     $id[] = $spr[$key];
        // }

        // dd($spr);

        $blok = DB::table('unit_rumah')
            ->groupBy('type')
            ->get();
        return view('marketing.pricelist.create', compact('spr', 'blok', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
