<?php

namespace App\Http\Controllers\Purchasing;

use App\Barang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\InOut;
use App\Purchase;
use App\Supplier;
use App\{User, Cabang, Pengajuan, Perusahaan, Reinburst, RincianPengajuan, RincianReinburst};
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
            $reinbursts = RincianReinburst::groupBy('nomor_reinburst')->get();
        }
        return view('purchasing.reinburst.index', compact('reinbursts'));
    }

    public function create()
    {
        $AWAL = 'RN';
        $noUrutAkhir = \App\Reinburst::max('id');
        // dd($noUrutAkhir);
        $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        // dd($nourut);
        $projects = Project::get();
        return view('purchasing.reinburst.create', compact('projects', 'nourut'));
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
                    'tanggal_reinburst' => $request->tanggal_reinburst,
                    'status_hrd' => 'pending',
                    'status_pembayaran' => 'pending',
                    'id_project' => $request->id_project,
                    'id_roles' => auth()->user()->id_roles
                ];
                foreach ($barang as $key => $no) {
                    $in[] = [
                        'no_kwitansi' => $request->no_kwitansi[$key],
                        'harga_beli' => $request->harga_beli[$key],
                        'catatan' => $request->catatan[$key],
                        'total' => $request->harga_beli[$key],
                        'nomor_reinburst' => $request->nomor_reinburst,
                        'grandtotal' => $request->grandtotal,
                    ];
                }
                RincianReinburst::insert($in);
                Reinburst::insert($attr);
            }
        }
        DB::commit();
        return redirect()->route('purchasing.reinburst.index')->with('success', 'Reinburst barang berhasil');
    }

    public function show(Reinburst $reinburst)
    {
        $reinburst = Reinburst::where('nomor_reinburst', $reinburst->nomor_reinburst)->first();

        return view('purchasing.reinburst.show', compact('reinburst'));
    }

    public function edit(Pengajuan $pengajuan)
    {
        $pengajuans = Pengajuan::where('nomor_pengajuan', $pengajuan->nomor_pengajuan)->get();
        $peng = DB::table('pengajuans')
            ->leftJoin('rincian_pengajuans', 'pengajuans.nomor_pengajuan', '=', 'rincian_pengajuans.nomor_pengajuan')
            ->select('rincian_pengajuans.harga_beli', 'rincian_pengajuans.qty', 'rincian_pengajuans.total')
            ->get();
        $perusahaans = Perusahaan::get();
        $barangs = Barang::where('jenis', 'barang')->get();

        return view('purchasing.reinburst.edit', compact('perusahaans', 'barangs', 'pengajuan', 'pengajuans', 'peng'));
    }

    public function update(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([

            'barang_id' => 'required',
            'qty' => 'required',
            'harga_beli' => 'required',
            'invoice' => 'required',
        ]);
        $barang = $request->input('barang_id', []);
        $attr = [];
        $in = [];
        $id = [];
        $pengajuans = Purchase::where('nomor_pengajuan', $pengajuan->nomor_pengajuan)->pluck('id');
        // dd("ok");
        // dd($purchases);
        DB::beginTransaction();
        foreach ($barang as $key => $no) {
            $attr[] = [
                'nomor_pengajuan' => $request->nomor_pengajuan,
                'id_user' => auth()->user()->id,
                'id_perusahaan' => $request->id_perusahaan,
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'approval_time' => $request->tanggal_pengajuan,
                'status_approval' => 'pending',
                'approval_by' => 'pending',
                'id_roles' => 9
            ];

            // $rincian_pengajuan = RincianPengajuan::where('barang_id', auth()->user()->pengajuan_id)->where('barang_id', $no)->first();
            // dd($rincian_pengajuan);

            // $rincian_pengajuan->update([
            //     'qty' => $rincian_pengajuan->qty + $request->qty[$key]
            // ]);

            $in[] = [
                'barang_id' => $no,
                'PPN' => $request->PPN,
                'harga_beli' => $request->harga_beli[$key],
                'qty' => $request->qty[$key],
                'total' => $request->harga_beli[$key] * $request->qty[$key],
                'nomor_pengajuan' => $request->nomor_pengajuan,
            ];
            $id[] = $pengajuans[$key];
        }

        Pengajuan::updateOrInsert([
            'id' => $id
        ], $attr);
        Pengajuan::updateOrInsert([
            'id' => $id
        ], $attr);


        DB::commit();

        return redirect()->route('purchasing.reinburst.index')->with('success', 'Pengajuan barang berhasil');
    }

    public function destroy(Reinburst $reinburst)
    {
        $reinburst = Pengajuan::where('nomor_reinburst', $reinburst->nomor_reinburst)->get();

        foreach ($reinburst as $pur) {
            RincianPengajuan::where('nomor_reinburst', $pur->nomor_reinburst)->delete();
            $pur->delete();
        }

        return redirect()->route('purchasing.reinburst.index')->with('success', 'Purchase barang didelete');
    }
}
