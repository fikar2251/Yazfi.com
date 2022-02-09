<?php

namespace App\Http\Controllers\hrd;

use App\Booking;
use App\Cabang;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function perpindahan()
    {
        $cabang = Cabang::get();
        $cb = '';
        $from = '';
        $to = '';
        if (request()->method() == 'POST') {
            $this->validate(request(),[
                'cabang' => 'required',
                'from' => 'required',
                'to' => 'required'
            ]);
            $form = request()->all();
            $from = Carbon::createFromFormat('d/m/Y', $form['from']);
            $to = Carbon::createFromFormat('d/m/Y', $form['to']);
            $from = $from->format('Y-m-d');
            $to = $to->format('Y-m-d');
            $perpindahan = Booking::where('cabang_id', $form['cabang'])->where('dokter_pengganti_id', '!=', null)->where('tanggal_pengganti', '!=', null)->whereBetween('tanggal_pengganti', [$from, $to])->get();
            if ($form['cabang'] == 'all') {
                $perpindahan = Booking::where('dokter_pengganti_id', '!=', null)->where('tanggal_pengganti', '!=', null)->whereBetween('tanggal_pengganti', [$from, $to])->get();
            }
            return view('hrd.report.perpindahan.index', compact('perpindahan', 'cabang', 'cb', 'from', 'to'));
        }
        $perpindahan = Booking::where('dokter_pengganti_id', '!=', null)->get();
        return view('hrd.report.perpindahan.index', compact('perpindahan', 'cabang', 'cb', 'from', 'to'));
    }
}
