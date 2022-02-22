<?php

namespace App\Http\Controllers\Marketing;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Jadwal;
use App\Marketing;
use App\Shift;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('marketing.doctor.index', [
        //     'doctors' => User::whereHas('roles', function ($qr) {
        //         return $qr->where('name', 'dokter');
        //     })->where('is_active', 1)->where('cabang_id',auth()->user()->cabang_id)->get()
        // ]);

        $stok = Marketing::where('status_penjualan', 'Available')->get();
        return view('marketing.doctor.index', compact('stok'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('marketing.doctor.show', [
            'doctor' => User::findOrFail($id),
            'booking' => Booking::where('dokter_id', $id)->get(),
            'shift' => Shift::get(),
            'attendance' => Jadwal::where('user_id', $id)->whereMonth('tanggal', Carbon::now()->format('m'))->whereYear('tanggal', Carbon::now()->format('Y'))->get()
        ]);
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
