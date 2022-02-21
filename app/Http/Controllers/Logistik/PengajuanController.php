<?php

namespace App\Http\Controllers\Logistik;

use App\Barang;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\InOut;
use App\Purchase;
use App\Supplier;
use App\{User, Cabang, Pengajuan, Perusahaan, RincianPengajuan};
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PengajuanController extends Controller
{
    public function index(Pengajuan $pengajuan)
    {
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d H:i:s');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d H:i:s');
            $pengajuans = Pengajuan::groupBy('nomor_pengajuan')->whereBetween('tanggal_pengajuan', [$from, $to])->get();
        } else {
            $pengajuans = Pengajuan::groupBy('nomor_pengajuan')->get();
        }
        return view('logistik.pengajuan.index', compact('pengajuans'));
    }

    public function create()
    {
        $pengajuans = Pengajuan::groupBy('nomor_pengajuan')->get();
        $perusahaans = Perusahaan::get();
        $barangs = Barang::where('jenis', 'barang')->get();
        $projects = Project::get();
        $AWAL = 'KEU';
        $noUrutAkhir = \App\Pengajuan::max('id');
        // dd($noUrutAkhir);
        $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
        return view('logistik.pengajuan.create', compact('barangs', 'perusahaans', 'pengajuans', 'projects', 'nourut'));
    }
    public function store(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'barang_id' => 'required',
            'qty' => 'required',
            'harga_beli' => 'required',
            'nomor_pengajuan' => 'required',
            'file.*' => 'mimes:doc,docx,PDF,pdf,jpg,jpeg,png|max:2000'
        ]);

        $barang = $request->input('nama_barang', []);
        $attr = [];
        $in = [];
        // dd($request->all());
        DB::beginTransaction();

        if ($request->hasFile('file')) {
            foreach ($barang as $key => $no) {
                $files = $request->file('file');
                foreach ($files as $file) {
                    $AWAL = 'KEU';
                    $noUrutAkhir = \App\Pengajuan::max('id');
                    $nourut = $AWAL . '/' .  sprintf("%02s", abs($noUrutAkhir + 1)) . '/' . sprintf("%05s", abs($noUrutAkhir + 1));
                    $name = $nourut . '.' . $file->getClientOriginalName();
                    $file->move(public_path() . '/uploads/file', $name);

                    $attr[] = [
                        'nomor_pengajuan' => $request->nomor_pengajuan,
                        'file' => $file,
                        'id_user' => auth()->user()->id,
                        'id_perusahaan' => $request->id_perusahaan,
                        'tanggal_pengajuan' => $request->tanggal_pengajuan,
                        'approval_time' => $request->tanggal_pengajuan,
                        'status_approval' => 'pending',
                        'approval_by' => 'pending',
                        'id_roles' => 9
                    ];
                    $in[] = [
                        'barang_id' => $no,
                        'PPN' => $request->PPN,
                        'harga_beli' => $request->harga_beli[$key],
                        'keterangan' => $request->keterangan[$key],
                        'qty' => $request->qty[$key],
                        'total' => $request->harga_beli[$key] * $request->qty[$key],
                        'nomor_pengajuan' => $request->nomor_pengajuan,
                        'grandtotal' => $request->grandtotal,
                        'unit' => $request->unit

                    ];
                    Pengajuan::insert($attr);
                    RincianPengajuan::insert($in);
                }
            }
        }


        Pengajuan::insert($attr);
        RincianPengajuan::insert($in);

        DB::commit();
        return redirect()->route('logistik.pengajuan.index')->with('success', 'Pengajuan Dana barang berhasil');
    }

    public function pdf(Pengajuan $pengajuan, $id)
    {
        $pengajuan = Pengajuan::where('id', $id)->where('nomor_pengajuan', $pengajuan->nomor_pengajuan)->first();
        // $rincian = RincianPengajuan::where('nomor_pengajuan', $pengajuan->nomor_pengajuan)->first();
        // $jabatan = DB::table('users')
        //     ->leftJoin('jabatans', 'users.id_jabatans', '=', 'jabatans.id')
        //     ->leftJoin('pengajuans', 'users.id_perusahaan', '=', 'pengajuans.id_perusahaan')
        //     ->select('jabatans.nama')
        //     ->where('pengajuans.nomor_pengajuan', $pengajuan->nomor_pengajuan)
        //     ->first();
        // share data to view
        view()->share('logistik.pengajuan.pdf', $pengajuan);
        $pdf = PDF::loadView('logistik.pengajuan.pdf', ['pengajuan' => $pengajuan]);
        return $pdf->download('Laporan Pengajuan.pdf');
    }
    public function show(Pengajuan $pengajuan)
    {
        $pengajuan = DB::table('pengajuans')
            ->leftJoin('rincian_pengajuans', 'pengajuans.nomor_pengajuan', '=', 'rincian_pengajuans.nomor_pengajuan')
            ->leftJoin('barangs', 'barangs.id', '=', 'rincian_pengajuans.barang_id')
            ->select('barangs.nama_barang', 'pengajuans.id', 'rincian_pengajuans.id', 'pengajuans.file', 'pengajuans.tanggal_pengajuan', 'pengajuans.nomor_pengajuan', 'rincian_pengajuans.harga_beli', 'rincian_pengajuans.grandtotal', 'rincian_pengajuans.keterangan')
            ->where('pengajuans.nomor_pengajuan', $pengajuan->nomor_pengajuan)->first();

        $jabatan = DB::table('users')
            ->leftJoin('jabatans', 'users.id_jabatans', '=', 'jabatans.id')
            ->leftJoin('roles', 'users.id_roles', '=', 'roles.id')
            ->leftJoin('pengajuans', 'users.id_perusahaan', '=', 'pengajuans.id_perusahaan')
            ->select('jabatans.nama', 'users.name', 'roles.name_roles')
            ->where('pengajuans.nomor_pengajuan', $pengajuan->nomor_pengajuan)
            ->first();

        return view('logistik.pengajuan.show', compact('jabatan', 'pengajuan'));
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

        return view('logistik.pengajuan.edit', compact('perusahaans', 'barangs', 'pengajuan', 'pengajuans', 'peng'));
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

        return redirect()->route('logistik.pengajuan.index')->with('success', 'Pengajuan barang berhasil');
    }

    public function destroy(Pengajuan $pengajuan)
    {
        $pengajuan = Pengajuan::where('nomor_pengajuan', $pengajuan->nomor_pengajuan)->get();

        foreach ($pengajuan as $pur) {
            RincianPengajuan::where('nomor_pengajuan', $pur->nomor_pengajuan)->delete();
            $pur->delete();
        }

        return redirect()->route('logistik.pengajuan.index')->with('success', 'Pengajuan Dana barang didelete');
    }

    public function whereProject(Request $request)
    {
        $data = DB::table('projects')
            ->select('projects.alamat_project')
            ->groupBy('projects.alamat_project')
            ->where('projects.id', $request->id)->get();
        return $data;
        dd($data);
    }
    public function WhereProduct(Request $request)
    {
        $data = [];
        $product =  Barang::where('jenis', 'barang_id')
            ->where('nama_barang', 'like', '%' . $request->q . '%')
            ->get();
        foreach ($product as $row) {
            $data[] = ['id' => $row->id,  'text' => $row->nama_barang];
        }

        return redirect()->route('logistik.pengajuan.index')->with('success', 'Pengajuan barang didelete');
    }
}
