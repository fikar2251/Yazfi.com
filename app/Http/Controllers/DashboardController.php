<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Support\Facades\DB;
use App\Booking;
use App\Customer;
use App\Holidays;
use App\Komisi;
use App\Pembayaran;
use App\Pengajuan;
use App\Purchase;
use App\Refund;
use App\Reinburst;
use App\Tindakan;
use App\Spr;
use App\TeamSales;
use App\TukarFaktur;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // $macAddr = substr(exec('getmac'), 0, 17);

        // if (auth()->user()->mac_address == null) {
        //     $user = User::find(auth()->user()->id);
        //     $user->update([
        //         'mac_address' => $macAddr
        //     ]);
        // }

        $macAddr = substr(exec('getmac'), 0, 17);
        // return $macAddr;
        // if (auth()->user()->mac_address != $macAddr) {
        //     Auth::logout();
        //     return redirect('login');
        // }

        $jadwal = [];
        $datang = [];
        $periksa = [];

        // $pasien = Customer::count();
        // $dokter = User::role('dokter')->count();
        // $appointments =  Booking::count();
        // $tindakan =  Tindakan::with('booking')->where('status', 0)->count();

        if (auth()->user()->hasRole('super-admin')) {
            $now = Carbon::now()->format('Y-m-d');
            $customer = Spr::count();
            // $reinburst_pending = Reinburst::where('id_user', auth()->user()->id)->where('status_pembayaran','pending')->get()->count();
             $reinburst_pending = Reinburst::where('id_user', auth()->user()->id)->get()->count();
            $warehouse =  Barang::count();

            return view('dashboard.index', [
                'customer' => $customer,
                'reinburst_pending' => $reinburst_pending,
                'warehouse' => $warehouse,
            ]);
        }
        if (auth()->user()->hasRole('finance')) {
            // $waktu = Carbon::now()->format('Y-m-d');
            // $cabang = auth()->user()->cabang_id;

            // $jadwal = Booking::with('pasien', 'dokter')->where('tanggal_status', $waktu)->where('status_kedatangan_id', 1)->where('cabang_id', $cabang)->get();
            // $datang = Booking::with('pasien', 'dokter')->where('status_kedatangan_id', 2)->where('cabang_id', $cabang)->get();
            // $periksa = Booking::with('pasien', 'dokter')->where('status_kedatangan_id', 3)->get();
            // $pasien = Customer::where('cabang_id', $cabang)->count();
            // $appointments = Booking::where('cabang_id', $cabang)->count();
            // $tindakan = Tindakan::with('booking')->whereHas('booking', function ($query) {
            //     $cabang = auth()->user()->cabang_id;
            //     return $query->where('cabang_id', $cabang);
            // })->where('status', 0)->count();
            $bayar = Pembayaran::where('status_approval', ['pending', 'reject'])->get()->count();
            $refund = Refund::orderBy('no_refund', 'desc')->where('status', ['unpaid', 'reject'])->get()->count();
            $komisi = Komisi::orderBy('id', 'desc')->where('status_pembayaran', ['unpaid','reject'])->get()->count();

            return view('dashboard.index', compact('bayar', 'refund', 'komisi'));
        }

        if (auth()->user()->hasRole('purchasing')) {

            $now = Carbon::now()->format('Y-m-d');
            $tukar_faktur_count = TukarFaktur::where('id_user', auth()->user()->id)->get()->count();
            $reinburst_pending = Reinburst::where('id_user', auth()->user()->id)->whereDate('tanggal_reinburst', $now)->where('status_pembayaran','=','pending')->get()->count();
            $received_pending = Purchase::where('status_barang','=','pending')->get()->count();
            return view('dashboard.index', [
                'received_pending' => $received_pending,
                'tukar_faktur_count' => $tukar_faktur_count,
                'reinburst_pending' => $reinburst_pending,
                
            ]);
        }
        if (auth()->user()->hasRole('logistik')) {

            $now = Carbon::now()->format('Y-m-d');
            $barang = DB::table('in_outs')->where('user_id',auth()->user()->id)->count();
            $pengajuan_pending = Pengajuan::where('id_user', auth()->user()->id)->where('status_approval','=','pending')->get()->count();
            $received_pending = Purchase::where('status_barang','=','pending')->where('user_id',auth()->user()->id)->get()->count();
            return view('dashboard.index', [
                'received_pending' => $received_pending,
                'barang' => $barang,
                'pengajuan_pending' => $pengajuan_pending,
                
            ]);
        }

        if (auth()->user()->hasRole('marketing')) {
            $dokter = User::whereHas('roles', function ($role) {
                return $role->where('name', 'dokter');
            })->where('cabang_id', auth()->user()->cabang_id)->where('is_active', 1)->get();
            $startdate = Carbon::parse(Carbon::now()->format('Y-m-d'));
            $enddate = Carbon::parse(Carbon::now()->endOfMonth()->format('Y-m-d'));
            $current = Carbon::now();
            $holiday = Holidays::pluck('holiday_date')->toArray();
            $from = $startdate;
            $count = $startdate->diffInDays() + $enddate->diffInDays();
            $data = DB::table('projects')
                ->groupBy('projects.nama_project')
                ->get();
            return view('marketing.dashboard', compact('data'));
            return view('dashboard.index', [
                'booking' => Booking::get(),
                'dokter' => $dokter,
                'holiday' => $holiday,
                'count' => $count,
                'data' => $data,
                'startdate' => $from->subDays(1),
            ]);
        }

        if (auth()->user()->hasRole('supervisor')) {
            // $user = User::where('id', 20)->get();
            $id = auth()->user()->id;
            $user = TeamSales::where('user_id', $id)->get();

            return view('supervisor.dashboard', compact('user'));

        }

        if (auth()->user()->hasRole('hrd')) {
            $hrd = User::whereHas('roles', function ($data) {
                return $data->where('name', 'hrd');
            })->where('is_active', 1)->get()->count();

            $pengajuan_dana = Pengajuan::where('status_approval', '==', 'pending')->where('id_user',auth()->user()->id)->get()->count();
            $reinburst = Reinburst::where('id_user',auth()->user()->id)->get()->count();
            $reinburs_acc = Reinburst::where('status_hrd', 'completed')->get()->count();

           
            return view('dashboard.index', [
                'hrd' => $hrd,
                'pengajuan_dana' => $pengajuan_dana,
                'reinburst' => $reinburst,
                'reinburs_acc' => $reinburs_acc
            ]);
        }

        return view('dashboard.index');
    }

    public function profile()
    {
        $profile = User::with('roles')->find(auth()->user()->id);
        return view('dashboard.profile', compact('profile'));
    }

    public function edit()
    {
        $profile = User::with('roles')->find(auth()->user()->id);
        return view('dashboard.edit-profile', compact('profile'));
    }

    public function update()
    {
        $attr = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        $user = User::find(auth()->user()->id);

        if (request('password') == null) {
            $attr['password'] = $user->password;
        } else {
            $attr['password'] =  Hash::make(request('password'));
        }

        $image = request()->file('image');

        if (request()->file('image')) {
            Storage::delete($user->image);
            $imageUrl = $image->storeAs('images/users', \Str::random(15) . '.' . $image->extension());
            $attr['image'] = $imageUrl;
        } else {
            $attr['image'] = $user->image;
        }

        $user->update($attr);

        return back()->with('success', 'Your profile has been updated');
    }
}
