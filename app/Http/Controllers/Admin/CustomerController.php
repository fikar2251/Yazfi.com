<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use App\Komisi;
use App\Payment;
use App\RincianKomisi;
use App\RincianPembayaran;
use App\Tindakan;
use App\Spr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class CustomerController extends Controller
{
    public function index()
    
    {
        return view('admin.customer.index');
    }

    public function ajax()
    {
        
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d H:i:s');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d H:i:s');
            $pembatalans = DB:: table('sprs')
            ->leftjoin('unit_rumahs','sprs.id_unit','=','unit_rumahs.id')
            ->select('sprs.tanggal_transaksi','sprs.no_transaksi','sprs.nama','sprs.no_hp','sprs.no_ktp','unit_rumahs.no','unit_rumahs.blok','unit_rumahs.type'
            ,'sprs.id','unit_rumahs.type','sprs.harga_net')
            ->whereBetween('sprs.tanggal_transaksi', [$from, $to])
            ->orderBy('sprs.id','desc')->get();
         
        } else {
            $pembatalans = DB:: table('sprs')
            ->leftjoin('unit_rumahs','sprs.id_unit','=','unit_rumahs.id')
            ->select('sprs.tanggal_transaksi','sprs.no_transaksi','sprs.nama','sprs.no_hp','sprs.no_ktp','unit_rumahs.no','unit_rumahs.blok','unit_rumahs.type'
            ,'sprs.id','unit_rumahs.type','sprs.harga_net')
            ->orderBy('sprs.id','desc')
            ->get();
        }
      

        return datatables()
            ->of($pembatalans)
            ->editColumn('no_transaksi', function ($pembatalan) {
                return $pembatalan->no_transaksi;
            })
            ->editColumn('nama', function ($pembatalan) {
                return $pembatalan->nama;
            })
            ->editColumn('no_ktp', function ($pembatalan) {
                return $pembatalan->no_ktp;
            })
            ->editColumn('no_hp', function ($pembatalan) {
                return $pembatalan->no_hp;
            })
            ->editColumn('unit', function ($pembatalan) {
                return $pembatalan->type;
            })
            ->editColumn('blok', function ($pembatalan) {
                return $pembatalan->blok;
            })
            ->editColumn('no', function ($pembatalan) {
                return $pembatalan->no;
            })
            ->editColumn('harga_net', function ($pembatalan) {
                return $pembatalan->harga_net;
            })
            ->editColumn('tanggal_transaksi', function ($pembatalan) {
                return Carbon::parse($pembatalan->tanggal_transaksi)->format('d/m/Y');
            })
         
           
            ->addIndexColumn()
            ->rawColumns(['no_transaksi'])
            ->make(true);
            
    }

   
}
