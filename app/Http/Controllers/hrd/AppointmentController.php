<?php

namespace App\Http\Controllers\hrd;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Images;
use App\Tindakan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resign = User::whereHas('roles', function ($data) {
            return $data->where('name', 'dokter');
        })->where('is_active', 2)->pluck('id');

        $count = Tindakan::whereIn('dokter_id', $resign)->where('status', 0)->get()->count();
        $tindakan = Tindakan::get();

        return view('hrd.appointments.index', [
            'tindakan' => $tindakan,
            'count' => $count
        ]);
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
        $booking = Booking::findOrFail($id);

        return view('hrd.appointments.show', [
            'booking' => $booking->images
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
        $booking = Booking::findOrFail($id);
        $dokter = User::whereHas('roles', function ($data) {
            $data->where('name', 'dokter');
        })->get();
        return view('hrd.appointments.edit', [
            'booking' => $booking,
            'dokter' => $dokter
        ]);
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
    public function download($id)
    {
        $images = Images::findOrFail($id);
        return Storage::download($images->image);
    }
    public function resign()
    {
        $resign = User::whereHas('roles', function ($data) {
            return $data->where('name', 'dokter');
        })->where('is_active', 2)->pluck('id');

        $tindakan = Tindakan::whereIn('dokter_id', $resign)->where('status', 0)->get();

        return view('hrd.appointments.resign', [
            'tindakan' => $tindakan,
        ]);
    }
}
