<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Booking;
use App\Customer;
use App\Holidays;
use App\Purchase;
use App\Reinburst;
use App\Tindakan;
use App\Spr;
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

        $pasien = Customer::count();
        $dokter = User::role('dokter')->count();
        $appointments =  Booking::count();
        $tindakan =  Tindakan::with('booking')->where('status', 0)->count();

        if (auth()->user()->hasRole('super-admin')) {
            $now = Carbon::now()->format('Y-m-d');
            $customer = Spr::count();
            $reinburst_pending = Reinburst::where('id_user', auth()->user()->id)->whereDate('tanggal_reinburst', $now)->where('status_pembayaran','!=','pending')->get()->count();;
            $warehouse =  Booking::count();

            return view('dashboard.index', [
                'customer' => $customer,
                'reinburst' => $reinburst_pending,
                'warehouse' => $warehouse,
            ]);
        }

        if (auth()->user()->hasRole('resepsionis')) {
            $waktu = Carbon::now()->format('Y-m-d');
            $cabang = auth()->user()->cabang_id;

            $jadwal = Booking::with('pasien', 'dokter')->where('tanggal_status', $waktu)->where('status_kedatangan_id', 1)->where('cabang_id', $cabang)->get();
            $datang = Booking::with('pasien', 'dokter')->where('status_kedatangan_id', 2)->where('cabang_id', $cabang)->get();
            $periksa = Booking::with('pasien', 'dokter')->where('status_kedatangan_id', 3)->get();
            $pasien =  Customer::where('cabang_id', $cabang)->count();
            $appointments =  Booking::where('cabang_id', $cabang)->count();
            $tindakan =  Tindakan::with('booking')->whereHas('booking', function ($query) {
                $cabang = auth()->user()->cabang_id;
                return $query->where('cabang_id', $cabang);
            })->where('status', 0)->count();

            return view('dashboard.index', compact('jadwal', 'datang', 'periksa', 'pasien', 'appointments', 'tindakan', 'dokter'));
        }

        if (auth()->user()->hasRole('purchasing')) {

            $now = Carbon::now()->format('Y-m-d');
            $tukar_faktur_count = TukarFaktur::where('id_user', auth()->user()->id)->get()->count();
            $reinburst_pending = Reinburst::where('id_user', auth()->user()->id)->whereDate('tanggal_reinburst', $now)->where('status_pembayaran','=','pending')->get()->count();
            $received_pending = Purchase::whereDate('created_at', $now)->where('status_barang','=','pending')->get()->count();
            return view('dashboard.index', [
                'received_pending' => $received_pending,
                'tukar_faktur_count' => $tukar_faktur_count,
                'reinburst_pending' => $reinburst_pending,
                
            ]);
        }

        if (auth()->user()->roles()->first()->name == 'marketing') {
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
                'startdate' => $from->subDays(1)
            ]);
        }

        if (auth()->user()->hasRole('hrd')) {
            $doctor = User::whereHas('roles', function ($data) {
                return $data->where('name', 'dokter');
            })->where('is_active', 1)->get()->count();

            $appointment = Booking::where('status_kedatangan_id', '!=', 4)->get()->count();

            $tindakan = Tindakan::where('status', 0)->get()->count();
            return view('dashboard.index', [
                'doctor' => $doctor,
                'appointment' => $appointment,
                'tindakan' => $tindakan
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
