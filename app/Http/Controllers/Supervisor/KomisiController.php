<?php

namespace App\Http\Controllers\Supervisor;

use App\Booking;
use App\Http\Controllers\Controller;
use App\RincianKomisi;
use App\RincianPembayaran;
use App\Tindakan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KomisiController extends Controller
{
    public function index()
    {
        return view('supervisor.komisi.index');
    }

    public function ajaxKomisi()
    {
        $appointments = DB::table('bookings')
            ->join('customers', 'bookings.customer_id', '=', 'customers.id')
            ->join('users', 'bookings.dokter_id', '=', 'users.id')
            ->join('cabangs', 'bookings.cabang_id', '=', 'cabangs.id')
            ->join('status_pasiens', 'bookings.status_kedatangan_id', '=', 'status_pasiens.id')
            ->select('bookings.id', 'bookings.cabang_id', 'bookings.no_booking', 'bookings.created_at', 'bookings.jam_status', 'bookings.jam_selesai', 'status_pasiens.status', 'status_pasiens.warna', 'customers.nama as pasien', 'users.name as dokter', 'cabangs.nama as cabang')
            ->where('bookings.cabang_id', auth()->user()->cabang_id)
            ->get();

        return datatables()
            ->of($appointments)
            ->editColumn('booking', function ($data) {
                return '<a href="' . route("supervisor.komisi.show", $data->id) . '">' . $data->no_booking . '</a>';
            })
            ->editColumn('status', function ($data) {
                return '<span class="custom-badge status-' . $data->warna . '">' . $data->status . '</span>';
            })
            ->editColumn('tgl', function ($data) {
                return Carbon::parse($data->created_at)->format('d/m/Y');
            })
            ->editColumn('waktu', function ($data) {
                return Carbon::parse($data->jam_status)->format('H.i') . ' - ' . Carbon::parse($data->jam_selesai)->format('H.i');
            })
            ->editColumn('tindakan', function ($data) {
                $tindakan = Tindakan::where('booking_id', $data->id)->where('status', 0)->count();
                if ($tindakan > 0) {
                    return '<span class="custom-badge status-red d-flex justify-content-between">
                    Belum
                    <span>' . $tindakan . '</span>
                </span>';
                } else {
                    return '<span class="custom-badge status-green">
                    Selesai
                </span>';
                }
            })
            ->addIndexColumn()
            ->rawColumns(['status', 'booking', 'tindakan'])
            ->make(true);
    }

    public function show(Booking $komisi)
    {
        $appointment = Booking::with('pasien', 'dokter', 'cabang', 'perawat', 'resepsionis', 'rincian', 'tindakan')->where('id', $komisi->id)->first();
        $rincians = RincianKomisi::where('booking_id', $komisi->id)->get();

        return view('supervisor.komisi.show', compact('appointment', 'rincians',));
    }

    public function edit(RincianKomisi $komisi)
    {
        return view('supervisor.komisi.edit', compact('komisi',));
    }

    public function update(RincianKomisi $komisi)
    {
        $komisi->update(['nominal_komisi' => request('nominal_komisi')]);

        return redirect()->route('supervisor.komisi.show', $komisi->booking->id)->with('success', 'Komisi berhasil diupdate');
    }

    public function change(RincianKomisi $komisi)
    {
        $dokter = User::role('dokter')->where('cabang_id', $komisi->booking->cabang_id)->get();

        return view('supervisor.komisi.change', compact('komisi', 'dokter'));
    }

    public function updatechange(RincianKomisi $komisi)
    {
        $komisi->update(['nominal_komisi' => request('nominal_komisi')]);
        RincianKomisi::create([
            'booking_id' => $komisi->booking->id,
            'user_id' => request('dokter_baru_id'),
            'nominal_komisi' => request('nominal_komisi_baru'),
            'is_active' => 1,
        ]);

        return redirect()->route('supervisor.komisi.show', $komisi->booking->id)->with('success', 'Komisi berhasil diubah');
    }

    public function destroy(RincianKomisi $komisi)
    {
        $komisi->delete();
        return back()->with('success', 'Komisi berhasil didelete');
    }
}
