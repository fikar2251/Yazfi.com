<?php

namespace App\Http\Controllers\Admin;

use App\Barang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\InOut;
use App\Purchase;
use App\Supplier;
use App\{User, Cabang, Pengajuan, Perusahaan, Reinburst, RincianReinburst};
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReinburstController extends Controller
{
    public function index(Reinburst $reinburst)
    {
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d H:i:s');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d H:i:s');
            $reinbursts = Reinburst::groupBy('nomor_reinburst')->whereBetween('tanggal_reinburst', [$from, $to])->get();
        } else {
            $reinbursts = DB::table('reinbursts')
            ->leftJoin('rincian_reinbursts','reinbursts.id','=','rincian_reinbursts.id_reinburst')
            ->select('rincian_reinbursts.grandtotal','reinbursts.tanggal_reinburst','reinbursts.nomor_reinburst','reinbursts.status_hrd','reinbursts.status_pembayaran','reinbursts.id')
            ->get();
        }
        return view('admin.reinburst.index', compact('reinbursts'));
    }

    public function create()
    {
        $AWAL = 'RN';
        $noUrutAkhir = \App\Reinburst::max('id');
        // dd($noUrutAkhir);
        $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        // dd($nourut);
        $projects = Project::get();
        return view('admin.reinburst.create', compact('projects', 'nourut'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kwitansi' => 'required',
            'harga_beli' => 'required',
            'nomor_reinburst' => 'required',
        ]);

        $barang = $request->input('no_kwitansi', []);
    
        $attr = [];
        $in = [];
        // dd($request->all());
        DB::beginTransaction();

        if ($request->hasFile('file')) {
            $files = $request->file('file');
            foreach ($files as $file) {
                $AWAL = 'RN';
                $noUrutAkhir = \App\Reinburst::max('id');
                $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
                $name = $nourut . '/' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/file/reinburst', $name);

                $attr[] = [
                    'nomor_reinburst' => $request->nomor_reinburst,
                    'file' => $name,
                    'id_user' => auth()->user()->id,
                    'id_perusahaan' => auth()->user()->id_perusahaan,
                    'id_jabatans' => $request->id_jabatans,
                    'tanggal_reinburst' => $request->tanggal_reinburst,
                    'status_hrd' => 'pending',
                    'status_pembayaran' => 'pending',
                    'id_project' => $request->id_project,
                    'id_roles' => auth()->user()->id_roles
                ];
                // foreach ($cabangs as $cabang) {
                //     HargaProdukCabang::create([
                //         'barang_id' => $barang->id,
                //         'cabang_id' => $cabang->id,
                //         'harga' => request('harga'),
                //         'qty' => 0
                //     ]);
                // }
                foreach ($barang as $key => $no) {
                    $reinburst = \App\Reinburst::max('id');
                    $id = $reinburst + 1;
             
                    $in[] = [
                        'no_kwitansi' => $request->no_kwitansi[$key],
                        'harga_beli' => $request->harga_beli[$key],
                        'catatan' => $request->catatan[$key],
                        'total' => $request->harga_beli[$key],
                        'id_reinburst' => $id,
                        'grandtotal' => $request->grandtotal,
                    ];
                }
            
                Reinburst::insert($attr);
                RincianReinburst::insert($in);
            }
        }
        DB::commit();
        return redirect()->route('admin.reinburst.index')->with('success', 'Reinburst barang berhasil');
    }

    public function show(Reinburst $reinburst)
    {
        $reinbursts = Reinburst::where('id', $reinburst->id)->first();
        $rincianreinbursts = DB::table('reinbursts')
        ->leftJoin('rincian_reinbursts','reinbursts.id','=','rincian_reinbursts.id_reinburst')
        ->select('rincian_reinbursts.no_kwitansi','rincian_reinbursts.grandtotal','rincian_reinbursts.total','rincian_reinbursts.harga_beli','rincian_reinbursts.catatan')
        ->get();

        return view('admin.reinburst.show', compact('reinbursts','rincianreinbursts'));
    }

    public function edit(Reinburst $reinburst)
    {
        $reinbursts = Reinburst::where('id', $reinburst->id)->get();
        $peng = DB::table('reinbursts')
            ->leftJoin('rincian_reinbursts', 'reinbursts.id', '=', 'rincian_reinbursts.id_reinburst')
            ->select('rincian_reinbursts.harga_beli', 'rincian_reinbursts.total', 'rincian_reinbursts.catatan','rincian_reinbursts.no_kwitansi')
            ->get();
          $projects= Project::get();
          

        return view('admin.reinburst.edit', compact('reinburst', 'reinbursts', 'peng','projects'));
    }

    public function update(Request $request, Reinburst $reinburst)
    {
        $request->validate([
            'no_kwitansi' => 'required',
            'harga_beli' => 'required',
            'nomor_reinburst' => 'required',
        ]);

        $barang = $request->input('no_kwitansi', []);
        $attr = [];
     
        $reinburst = Reinburst::where('nomor_reinburst', $reinburst->nomor_reinburst)->pluck('id');
        // dd("ok");
        // dd($reinburst);
     
        $attr = [];
  
        // dd($request->all());
        DB::beginTransaction();

        if ($request->hasFile('file')) {
            $files = $request->file('file');
            foreach ($files as $file) {
                $AWAL = 'RN';
                $noUrutAkhir = \App\Reinburst::max('id');
                $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
                $name = $nourut . '/' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/file/reinburst', $name);

                $attr[] = [
                    'nomor_reinburst' => $request->nomor_reinburst,
                    'file' => $name,
                    'id_user' => auth()->user()->id,
                    'id_perusahaan' => auth()->user()->id_perusahaan,
                    'id_jabatans' => $request->id_jabatans,
                    'tanggal_reinburst' => $request->tanggal_reinburst,
                    'status_hrd' => 'pending',
                    'status_pembayaran' => 'pending',
                    'id_project' => $request->id_project,
                    'id_roles' => auth()->user()->id_roles
                ];
                dd($attr);
            
                foreach ($barang as $key => $no) {
                    $reinburst = \App\Reinburst::max('id');
                    $id = $reinburst + 1;
                    $rincian_reinburst = RincianReinburst::where('no_kwitansi', auth()->user()->id_reinburst)->where('no_kwitansi', $no)->first();
                    dd($rincian_reinburst);
    
                $rincian_reinburst->update([
                        'no_kwitansi' =>$rincian_reinburst->no_kwitansi + $request->no_kwitansi[$key],
                        'harga_beli' =>$rincian_reinburst->harga_beli + $request->harga_beli[$key],
                        'catatan' => $rincian_reinburst->catatan + $request->catatan[$key],
                        'total' => $rincian_reinburst->total + $request->harga_beli[$key],
                        'id_reinburst' => $id,
                        'grandtotal' => $rincian_reinburst->grandtotal + $request->grandtotal,
                 
                ]);
            
                }
                Reinburst::updateOrInsert([
                    'id' => $id
                ], $attr);
            }
        }

    

        DB::commit();

        return redirect()->route('admin.reinburst.index')->with('success', 'Pengajuan barang berhasil');
    }

    public function destroy(Reinburst $reinburst)
    {
        $reinburst = Reinburst::where('id', $reinburst->id)->get();

        foreach ($reinburst as $pur) {
            RincianReinburst::where('id_reinburst', $pur->id_reinburst)->delete();
            $pur->delete();
        }

        return redirect()->route('admin.reinburst.index')->with('success', 'Purchase barang didelete');
    }
}
