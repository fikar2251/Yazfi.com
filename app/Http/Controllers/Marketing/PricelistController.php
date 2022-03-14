<?php

namespace App\Http\Controllers\Marketing;

use App\City;
use App\District;
use App\Http\Controllers\Controller;
use App\Marketing;
use App\Project;
use App\Provinces;
use App\Skema;
use App\Spr;
use App\Subdistrict;
use App\Tagihan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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

        $spr = Spr::orderBy('id_transaksi', 'desc')->get();

        return view('marketing.pricelist.index', compact('blok', 'spr'));
    }

    public function blok(Request $request)
    {
        $blok = [
            'type' => $request->type,
            'status_penjualan' => 'Available',
        ];

        $data = DB::table('unit_rumah')
            ->select('unit_rumah.type', 'unit_rumah.blok', 'unit_rumah.no', 'unit_rumah.lt', 'unit_rumah.status_penjualan')
            ->groupBy('unit_rumah.blok')
            ->where($blok)->get();

        return $data;
    }

    public function no(Request $request)
    {
        $no = [
            'blok' => $request->blok,
            'status_penjualan' => 'Available',
        ];

        $data = DB::table('unit_rumah')
            ->select('unit_rumah.id_unit_rumah', 'unit_rumah.type', 'unit_rumah.blok', 'unit_rumah.no', 'unit_rumah.lt', 'unit_rumah.status_penjualan')
            ->groupBy('unit_rumah.no')
            ->where($no)->get();

        return $data;
    }

    public function lt(Request $request)
    {
        $lutan = [
            'blok' => $request->blok,
            'no' => $request->no,
        ];

        $data = DB::table('unit_rumah')
            ->select('unit_rumah.type', 'unit_rumah.id_unit_rumah', 'unit_rumah.blok', 'unit_rumah.no', 'unit_rumah.lt', 'unit_rumah.harga_jual', 'unit_rumah.lb', 'unit_rumah.nstd', 'unit_rumah.total')
            ->groupBy('unit_rumah.lt', 'unit_rumah.no')
            ->where($lutan)->get();

        return $data;
    }

    public function hj(Request $request)
    {
        $harju = [
            'blok' => $request->blok,
            'no' => $request->no,
            'lt' => $request->lt,
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
    public function create($id)
    {
        $spr = Spr::find($id);
        return view('marketing.pricelist.show', compact('spr'));
    }

    public function cetakSPR($id)
    {
        $spr = Spr::find($id);
        $pdf = PDF::loadview('marketing.pricelist.cetakspr',['spr'=>$spr])->setPaper('A4', 'potrait')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
        // $pdf = PDF::loadview('marketing.pricelist.cetakspr',['spr'=>$spr])->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->stream();
    }

    public function showSPR($id)
    {
        $spr = Spr::find($id);
        return view('marketing.pricelist.cetakspr', compact('spr'));
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

    public function storeSpr(Request $request, $id)
    {

        $spr = Spr::create([
            'no_transaksi' => $request->no_transaksi,
            'id_sales' => auth()->user()->id,
            'id_project' => $id,
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
            'total_luas_tanah' => $request->tlt,
            'sumber_informasi' =>$request->sumber_informasi
        ]);

        $skema = Skema::select('jumlah_skema')
            ->where('id_skema', $request->skema)
            ->get();

        foreach ($skema as $item) {
            $array = array($item->jumlah_skema);
            $string = implode(" ", $array);
            $int = (int) $string;
        }

        $date = Carbon::now()->format('d-m-Y');
        $tempo = date('d-m-Y', strtotime('+30 days', strtotime($date)));

        // $tempo3 = date('d-m-Y', strtotime('+30 days', strtotime($tempo)));

        $harga_jual = $request->harga_jual;

        $jumlah = $harga_jual / $int;
        $idspr = request()->get('id_transaksi');

        $data = [
            ['tipe' => 1,
                'jumlah_tagihan' => $request->booking_fee,
                'status_pembayaran' => 'unpaid',
                'no_transaksi' => $request->no_transaksi,
                'id_spr' => $spr->id_transaksi,
                'jatuh_tempo' => $tempo,
                'keterangan' => 'Booking Fee'
            ],
            ['tipe' => 2,
                'jumlah_tagihan' => $request->downpayment,
                'status_pembayaran' => 'unpaid',
                'no_transaksi' => $request->no_transaksi,
                'id_spr' => $spr->id_transaksi,
                'jatuh_tempo' => $tempo,
                'keterangan' => 'Downpayment'
            ],
        ];

        $int5 = 30 * $int;

        $date5 = date('d-m-Y', strtotime('+' . $int5 . 'days', strtotime($date)));

        Tagihan::insert($data);
        $a = 1;
        while (strtotime($tempo) <= strtotime($date5)) {
            $tipe3 = [
                ['tipe' => 3,
                    'jumlah_tagihan' => $jumlah,
                    'status_pembayaran' => 'unpaid',
                    'no_transaksi' => $request->no_transaksi,
                    'id_spr' => $spr->id_transaksi,
                    'jatuh_tempo' => $tempo,
                    'keterangan' => 'Cicilan Tahap '. $a
                ],
            ];
            Tagihan::insert($tipe3);
            $a++;
            $tempo = date("d-m-Y", strtotime("+30 day", strtotime($tempo)));
        }

        return redirect()->route('marketing.pricelist.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $skema = Skema::all();

        $blok = DB::table('unit_rumah')
            ->groupBy('type')
            ->get();
            
       
        
        $provinces = Provinces::all();
    
      
        return view('marketing.pricelist.create', compact('blok', 'id', 'skema', 'provinces'));
    }

    public function kota(Request $request)
    {
        $city = City::where('prov_id', $request->provinsi)->get();

        return $city;    
    }

    public function kecamatan(Request $request)
    {
        $district = District::where('city_id', $request->kota)->get();

        return $district;    
    }

    public function desa(Request $request)
    {
        $subdistrict = Subdistrict::where('dis_id', $request->kecamatan)->get();

        return $subdistrict;    
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
