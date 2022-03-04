<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Komisi;
use App\Spr;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KomisiController extends Controller
{
    public function index()
    {
        if (auth()->user()->roles()->first()->name == 'supervisor') {
            $user = User::where('roles_id', 4)->get();



            return view('supervisor.komisi.index', compact('user'));
        }

    }

    public function show($id)
    {
        $spr = Spr::all();
        foreach ($spr as $sp) {
            $hj = $sp->harga_jual;
        }
        $nospr = request()->get('no_transaksi');
        $sprkom = Komisi::where('no_spr', $nospr)->first();
        
        $pph = $hj * (2.5 / 100);
        $bphtb = $hj * (2.5 / 100);
        $pll = $hj * (2.5 / 100);

        $potongan = [
            'pph' => $pph,
            'bphtb' => $bphtb,
            'pll' => $pll
        ];

        $dasar = $hj - ($pph + $bphtb + $pll);

        $totalfee  = $pph + $bphtb + $pll;

        $kmsales = $dasar * (0.1 / 100);

        $kmspv = $dasar * (0.1 / 100);

        $kmmanager = $dasar * (0.1 / 100);

        $komisi = [
            'sales' => $kmsales,
            'spv' => $kmspv,
            'manager' => $kmmanager
        ];


        // dd($sales);



        return view('supervisor.komisi.show', compact('spr','potongan','dasar', 'totalfee', 'komisi'));
    }

    public function storeKomisi(Request $request)
    {
        $tgl = Carbon::now()->format('d-m-Y');
        Komisi::create([
            'no_komisi' => $request->no_komisi,
            'tanggal_komisi' => $tgl,
            'no_spr' => $request->no_transaksi,
            'sales' => $request->sales,
            'nominal_sales' => $request->nominal_sales,
            'spv' => $request->spv,
            'nominal_spv' => $request->nominal_spv,
            'manager' => $request->manager,
            'nominal_manager' => $request->nominal_manager,
            'status_pembayaran' => 'unpaid',
            'is_active' => 1,
        ]);

        return redirect()->back();
    }

    // public function ajaxKomisi()
    // {
    //     $appointments = DB::table('bookings')
    //         ->join('customers', 'bookings.customer_id', '=', 'customers.id')
    //         ->join('users', 'bookings.dokter_id', '=', 'users.id')
    //         ->join('cabangs', 'bookings.cabang_id', '=', 'cabangs.id')
    //         ->join('status_pasiens', 'bookings.status_kedatangan_id', '=', 'status_pasiens.id')
    //         ->select('bookings.id', 'bookings.cabang_id', 'bookings.no_booking', 'bookings.created_at', 'bookings.jam_status', 'bookings.jam_selesai', 'status_pasiens.status', 'status_pasiens.warna', 'customers.nama as pasien', 'users.name as dokter', 'cabangs.nama as cabang')
    //         ->where('bookings.cabang_id', auth()->user()->cabang_id)
    //         ->get();

    //     return datatables()
    //         ->of($appointments)
    //         ->editColumn('booking', function ($data) {
    //             return '<a href="' . route("supervisor.komisi.show", $data->id) . '">' . $data->no_booking . '</a>';
    //         })
    //         ->editColumn('status', function ($data) {
    //             return '<span class="custom-badge status-' . $data->warna . '">' . $data->status . '</span>';
    //         })
    //         ->editColumn('tgl', function ($data) {
    //             return Carbon::parse($data->created_at)->format('d/m/Y');
    //         })
    //         ->editColumn('waktu', function ($data) {
    //             return Carbon::parse($data->jam_status)->format('H.i') . ' - ' . Carbon::parse($data->jam_selesai)->format('H.i');
    //         })
    //         ->editColumn('tindakan', function ($data) {
    //             $tindakan = Tindakan::where('booking_id', $data->id)->where('status', 0)->count();
    //             if ($tindakan > 0) {
    //                 return '<span class="custom-badge status-red d-flex justify-content-between">
    //                 Belum
    //                 <span>' . $tindakan . '</span>
    //             </span>';
    //             } else {
    //                 return '<span class="custom-badge status-green">
    //                 Selesai
    //             </span>';
    //             }
    //         })
    //         ->addIndexColumn()
    //         ->rawColumns(['status', 'booking', 'tindakan'])
    //         ->make(true);
    // }

    // public function show(Booking $komisi)
    // {
    //     $appointment = Booking::with('pasien', 'dokter', 'cabang', 'perawat', 'resepsionis', 'rincian', 'tindakan')->where('id', $komisi->id)->first();
    //     $rincians = RincianKomisi::where('booking_id', $komisi->id)->get();

    //     return view('supervisor.komisi.show', compact('appointment', 'rincians',));
    // }

    // public function edit(RincianKomisi $komisi)
    // {
    //     return view('supervisor.komisi.edit', compact('komisi',));
    // }

    // public function update(RincianKomisi $komisi)
    // {
    //     $komisi->update(['nominal_komisi' => request('nominal_komisi')]);

    //     return redirect()->route('supervisor.komisi.show', $komisi->booking->id)->with('success', 'Komisi berhasil diupdate');
    // }

    // public function change(RincianKomisi $komisi)
    // {
    //     $dokter = User::role('dokter')->where('cabang_id', $komisi->booking->cabang_id)->get();

    //     return view('supervisor.komisi.change', compact('komisi', 'dokter'));
    // }

    // public function updatechange(RincianKomisi $komisi)
    // {
    //     $komisi->update(['nominal_komisi' => request('nominal_komisi')]);
    //     RincianKomisi::create([
    //         'booking_id' => $komisi->booking->id,
    //         'user_id' => request('dokter_baru_id'),
    //         'nominal_komisi' => request('nominal_komisi_baru'),
    //         'is_active' => 1,
    //     ]);

    //     return redirect()->route('supervisor.komisi.show', $komisi->booking->id)->with('success', 'Komisi berhasil diubah');
    // }

    // public function destroy(RincianKomisi $komisi)
    // {
    //     $komisi->delete();
    //     return back()->with('success', 'Komisi berhasil didelete');
    // }
}
