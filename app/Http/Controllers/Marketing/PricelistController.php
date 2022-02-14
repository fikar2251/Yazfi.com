<?php

namespace App\Http\Controllers\Marketing;

use App\Barang;
use App\Cabang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\Marketing;
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
        // return view('marketing.pricelist.index', [
        //     'barang' => Barang::with('hargaproduk')->get()
        // ]);
        // $data  = Marketing::select('blok','id_unit_rumah')->where('type',$request->type)->take(100)->get();
        // return response()->json($data);

        $stok = Marketing::all();
        $type = Marketing::where('Type', $stok);

        $blok = DB::table('unit_rumah')
            ->groupBy('type')
            ->get();
        return view('marketing.pricelist.index', compact('blok'));
    }

    public function blok(Request $request)
    {
        $data = DB::table('unit_rumah')
            ->select('unit_rumah.type', 'unit_rumah.blok', 'unit_rumah.no', 'unit_rumah.lt')
            ->groupBy('unit_rumah.blok')
            ->where('unit_rumah.id_unit_rumah', $request->id_unit_rumah)->get();

        return $data;
    }

    public function no(Request $request)
    {
        // $blok = ['blok' => $request->blok];
        $data = DB::table('unit_rumah')
            ->select('unit_rumah.type', 'unit_rumah.blok', 'unit_rumah.no', 'unit_rumah.lt')
            ->groupBy('unit_rumah.no')
            ->where('unit_rumah.id_unit_rumah', $request->id_unit_rumah)->get();

        return $data;

        // $lutan = [
        //     // 'blok' => 'R',
        //     'no' => $request->no
        // ];

        // $lt = Marketing::select('blok', 'no', 'lt')
        //     ->groupBy('lt')
        //     ->where('blok', $data)->get();

        // return $lt;
    }

    public function lt(Request $request)
    {

        // $lutan = [
        //     'blok' => $request->blok,
        //     'no' => $request->no
        // ];


        $data = DB::table('unit_rumah')
            ->select('unit_rumah.blok', 'unit_rumah.id_unit_rumah', 'unit_rumah.lt')
            ->groupBy('unit_rumah.lt')
            ->where('unit_rumah.id_unit_rumah', $request->id_unit_rumah)->get();

        return $data;
        // $lt = DB::table('unit_rumah')
        //     ->select('unit_rumah.blok', 'unit_rumah.no', 'unit_rumah.lt')
        //     ->groupBy('unit_rumah.lt')
        //     ->where('unit_rumah.blok', $request->blok)->get();

        // return $lt;



        // $data = DB::table('unit_rumah')
        //     ->select('unit_rumah.blok','unit_rumah.no', 'unit_rumah.lt')
        //     ->groupBy('unit_rumah.lt', 'unit_rumah.blok')
        //     ->where($lutan)
        //     ->get();
        // return $data;
    }

    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('unit_rumah')
            ->where($select, $value)
            ->groupBy($dependent)
            ->get();
        $output = '<option value="">Select ' . ucfirst($dependent) . '</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->$dependent . '">' . $row->$dependent . '</option>';
        }
        echo $output;
    }

    // public function findBlokName(Request $request)
    // {
    //     // $data  = Marketing::select('blok')->where('type',$request->type)->take(100)->get();
    //     $data = Marketing::select('blok', 'type')->where('type', $request->type)->get();
    //             return response()->json($data);
    // }

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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
