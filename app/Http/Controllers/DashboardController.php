<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Customer;
use App\Holidays;
use App\Pembayaran;
use App\Refund;
use App\Tindakan;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
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
        $appointments = Booking::count();
        $tindakan = Tindakan::with('booking')->where('status', 0)->count();

        if (auth()->user()->hasRole('super-admin')) {
            $pasien = Customer::count();
            $dokter = User::role('dokter')->count();
            $appointments = Booking::count();
            $tindakan = Tindakan::with('booking')->where('status', 0)->count();

            return view('dashboard.index', [
                'pasien' => $pasien,
                'dokter' => $dokter,
                'appointments' => $appointments,
                'tindakan' => $tindakan,
            ]);
        }

        if (auth()->user()->hasRole('resepsionis')) {
            $waktu = Carbon::now()->format('Y-m-d');
            $cabang = auth()->user()->cabang_id;

            $jadwal = Booking::with('pasien', 'dokter')->where('tanggal_status', $waktu)->where('status_kedatangan_id', 1)->where('cabang_id', $cabang)->get();
            $datang = Booking::with('pasien', 'dokter')->where('status_kedatangan_id', 2)->where('cabang_id', $cabang)->get();
            $periksa = Booking::with('pasien', 'dokter')->where('status_kedatangan_id', 3)->get();
            $pasien = Customer::where('cabang_id', $cabang)->count();
            $appointments = Booking::where('cabang_id', $cabang)->count();
            $tindakan = Tindakan::with('booking')->whereHas('booking', function ($query) {
                $cabang = auth()->user()->cabang_id;
                return $query->where('cabang_id', $cabang);
            })->where('status', 0)->count();
            $bayar = Pembayaran::all()->count();
            $refund = Refund::all()->count();

            return view('dashboard.index', compact('jadwal', 'datang', 'periksa', 'pasien', 'appointments', 'tindakan', 'dokter', 'bayar', 'refund'));
        }

        if (auth()->user()->hasRole('dokter')) {

            $now = Carbon::now()->format('Y-m-d');
            $total_pasien = Customer::where('cabang_id', auth()->user()->cabang_id)->get()->count();

            $finish = Booking::where('dokter_id', auth()->user()->id)->whereDate('tanggal_status', $now)->where('status_kedatangan_id', 4)->orderBy('jam_status', 'asc')->get();
            $pending = Booking::where('dokter_id', auth()->user()->id)->whereDate('tanggal_status', $now)->where('status_kedatangan_id', 3)->orderBy('jam_status', 'asc')->get();
            $appointment_count = Booking::where('dokter_id', auth()->user()->id)->whereDate('tanggal_status', $now)->get()->count();
            // $appointment_pending = Booking::where('dokter_id', auth()->user()->id)->whereDate('tanggal_status', $now)->where('status_kedatangan_id','!=',3)->get()->count();
            $appointment_pending = Tindakan::whereHas('booking', function ($qr) use ($now) {
                return $qr->where('dokter_id', auth()->user()->id)->whereDate('tanggal_status', $now)->where('status_kedatangan_id', '!=', 4);
            })->where('status', 0)->get()->count();

            return view('dashboard.index', [
                'total_pasien' => $total_pasien,
                'finish' => $finish,
                'pending' => $pending,
                'appointment_count' => $appointment_count,
                'appointment_pending' => $appointment_pending,
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
                'startdate' => $from->subDays(1),
            ]);
        }

        if (auth()->user()->roles()->first()->name == 'supervisor') {
            $user = User::where('roles_id', 4)->get();
            return view('supervisor.dashboard', compact('user'));

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
                'tindakan' => $tindakan,
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
            'address' => 'required',
        ]);

        $user = User::find(auth()->user()->id);

        if (request('password') == null) {
            $attr['password'] = $user->password;
        } else {
            $attr['password'] = Hash::make(request('password'));
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
