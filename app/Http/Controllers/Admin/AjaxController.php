<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBarangRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateBarangRequest;
use Carbon\Carbon;

use App\PembatalanUnit;
use App\Pengajuan;
use App\Penggajian;
use App\Reinburst;
use App\Spr;

class AjaxController extends Controller
{
  
    public function ajax_gaji()
    {
        $gaji = Penggajian::where('admin',auth()->user()->name)->orderBy('id', 'desc')->get();

        return datatables()
            ->of($gaji)
            ->editColumn('pegawai', function ($gajian) {
                return $gajian->pegawai->name;
            })
            ->editColumn('tanggal', function ($gajian) {
                return Carbon::parse($gajian->tanggal)->format('d/m/Y');
            })
            ->editColumn('bulan_tahun', function ($gajian) {
                return Carbon::parse($gajian->bulan_tahun)->format('F/Y');
            })
            ->editColumn('gaji_pokok', function ($gajian) {
                return $gajian->gaji_pokok;
            })
            ->editColumn('penerimaan', function ($gajian) {
                return $gajian->penerimaan->sum('nominal') - $gajian->gaji_pokok;
            })
            ->editColumn('potongan', function ($gajian) {
                return $gajian->potongan->sum('nominal');
            })
            ->editColumn('total', function ($gajian) {
                return $gajian->gaji_pokok + (($gajian->penerimaan->sum('nominal') - $gajian->gaji_pokok) - $gajian->potongan->sum('nominal'));
            })
            ->editColumn('jabatan', function ($gajian) {
                return $gajian->jabatan;
            })
            ->editColumn('divisi', function ($gajian) {
                return $gajian->divisi;
            })
            ->editColumn('admin', function ($gajian) {
                return $gajian->admin;
            })
            ->editColumn('action', function ($gajian) {
                
                Penggajian::where('id', $gajian->id)->get();
        
                
                return '<a href="' . route('hrd.gaji.print', $gajian->id) . '"class="btn btn-sm btn-secondary"><i class="fa-solid fa-print"></i></a>
                <a href="' . route('hrd.gaji.show', $gajian->id) . '"class="btn btn-sm btn-success"><i class="fa-solid fa-eye"></i></a>
                <a href="' . route('hrd.gaji.edit', $gajian->id) . '"class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></a> 
                <button type="delete"  href="' . route('hrd.gaji.destroy', $gajian->id) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>';
             
             
            
            })
            ->addIndexColumn()
            ->rawColumns(['pegawai','action'])
            ->make(true);
 
    }
    public function ajax_rekap_reinburst()
    {
        $reinbursts = Reinburst::
        leftJoin('rincian_reinbursts','reinbursts.nomor_reinburst','=','rincian_reinbursts.nomor_reinburst')
        ->select('reinbursts.id_user','reinbursts.nomor_reinburst','reinbursts.status_hrd','reinbursts.status_pembayaran','reinbursts.tanggal_reinburst',
        'rincian_reinbursts.total','reinbursts.id')
        ->groupBy('reinbursts.nomor_reinburst')
        ->orderBy('reinbursts.id', 'desc')->where('reinbursts.status_hrd','completed')
        ->get();
        // dd($reinbursts);

        return datatables()
            ->of($reinbursts)
            ->editColumn('no_reinburst', function ($reinburst) {
                return $reinburst->nomor_reinburst;
            })
            ->editColumn('tanggal', function ($reinburst) {
                return Carbon::parse($reinburst->tanggal_reinburst)->format('d/m/Y');
            })
            ->editColumn('total', function ($reinburst) {
                return \App\Reinburst::where('nomor_reinburst', $reinburst->nomor_reinburst)->count();
            })
            ->editColumn('pembelian', function ($reinburst) {
                return $reinburst->total;
            })
            ->editColumn('status_hrd', function ($reinburst) {
                if($reinburst->status_hrd == 'pending'){
               return '<a class="custom-badge status-red">pending</a>';
               }
                if($reinburst->status_hrd == 'completed'){
                    return '<a class="custom-badge status-green">completed</a>';
                }
                if($reinburst->status_hrd == 'review'){
                    return '<a class="custom-badge status-orange">review</a>';
                }
            })
            ->editColumn('status_pembayaran', function ($reinburst) {
                if($reinburst->status_pembayaran == 'pending'){
                    return '<a class="custom-badge status-red">pending</a>';
                    }
                     if($reinburst->status_pembayaran == 'completed'){
                         return '<a class="custom-badge status-green">completed</a>';
                     }
                     if($reinburst->status_pembayaran == 'review'){
                         return '<a class="custom-badge status-orange">review</a>';
                     }
            })
            ->addIndexColumn()
            ->rawColumns(['pembelian','status_hrd','status_pembayaran'])
            ->make(true);
    }
    public function ajax_acc_reinburst(){
        $reinbursts = Reinburst::
        leftJoin('rincian_reinbursts','reinbursts.nomor_reinburst','=','rincian_reinbursts.nomor_reinburst')
        ->select('reinbursts.id_user','reinbursts.nomor_reinburst','reinbursts.status_hrd','reinbursts.status_pembayaran','reinbursts.tanggal_reinburst',
        'rincian_reinbursts.total','reinbursts.id')->where('reinbursts.status_hrd','!=','completed')
        ->groupBy('reinbursts.nomor_reinburst')
        ->orderBy('reinbursts.id', 'desc')
        ->get();
        // dd($reinbursts);

        return datatables()
            ->of($reinbursts)
            ->editColumn('no_reinburst', function ($reinburst) {
                return $reinburst->nomor_reinburst;
            })
            ->editColumn('tanggal', function ($reinburst) {
                return Carbon::parse($reinburst->tanggal_reinburst)->format('d/m/Y');
            })
            ->editColumn('total', function ($reinburst) {
                return \App\Reinburst::where('nomor_reinburst', $reinburst->nomor_reinburst)->count();
            })
            ->editColumn('pembelian', function ($reinburst) {
                return $reinburst->total;
            })
            ->editColumn('status_hrd', function ($reinburst) {
                if($reinburst->status_hrd == 'pending'){
               return '<a class="custom-badge status-red">pending</a>';
               }
                if($reinburst->status_hrd == 'completed'){
                    return '<a class="custom-badge status-green">completed</a>';
                }
                if($reinburst->status_hrd == 'review'){
                    return '<a class="custom-badge status-orange">review</a>';
                }
            })
            ->editColumn('status_pembayaran', function ($reinburst) {
                if($reinburst->status_pembayaran == 'pending'){
                    return '<a class="custom-badge status-red">pending</a>';
                    }
                     if($reinburst->status_pembayaran == 'completed'){
                         return '<a class="custom-badge status-green">completed</a>';
                     }
                     if($reinburst->status_pembayaran == 'review'){
                         return '<a class="custom-badge status-orange">review</a>';
                     }
            })
            ->editColumn('action', function ($data) {
                
                Reinburst::where('id', $data->id)->get();
            
                
                return '<a href="' . route('hrd.penerimaan.statuscompleted', $data->id) . '"  class="custom-badge status-green"><i class="fa-solid fa-check-to-slot"></i></a>
                <a href="' . route('hrd.penerimaan.update', $data->id) . '"  class="custom-badge status-orange"><i class="fa-solid fa-eye"></i></a>';
             

            })
            ->addIndexColumn()
            ->rawColumns(['no_reinburst','status_hrd','status_pembayaran','action'])
            ->make(true);
    }
    public function ajax_pengajuan(){
        $pengajuans = Pengajuan::
        leftJoin('rincian_pengajuans','pengajuans.nomor_pengajuan','=','rincian_pengajuans.nomor_pengajuan')
        ->leftJoin('roles','pengajuans.id_roles','=','roles.id')
        ->select('roles.name','pengajuans.id','pengajuans.status_approval','pengajuans.id_user','pengajuans.nomor_pengajuan','pengajuans.tanggal_pengajuan',
        'rincian_pengajuans.grandtotal','pengajuans.id_perusahaan','pengajuans.id_roles')->where('pengajuans.id_user',auth()->user()->id)
        ->groupBy('pengajuans.nomor_pengajuan')
        ->orderBy('pengajuans.id', 'desc')
        ->get();
        // dd($reinbursts);

        return datatables()
            ->of($pengajuans)
            ->editColumn('no_pengajuan', function ($pengajuan) {
                return $pengajuan->nomor_pengajuan;
            })
            ->editColumn('perusahaan', function ($pengajuan) {
                return $pengajuan->perusahaan->nama_perusahaan;
            })
            ->editColumn('tanggal', function ($pengajuan) {
                return Carbon::parse($pengajuan->tanggal_pengajuan)->format('d/m/Y');
            })
            ->editColumn('divisi', function ($pengajuan) {
                return $pengajuan->roles->name;
            })
            ->editColumn('nama', function ($pengajuan) {
                return $pengajuan->admin->name;
            })
            ->editColumn('total', function ($pengajuan) {
                return \App\Pengajuan::where('nomor_pengajuan', $pengajuan->nomor_pengajuan)->count();
            })
            ->editColumn('pembelian', function ($pengajuan) {
                return $pengajuan->grandtotal;
            })
            ->editColumn('status', function ($pengajuan) {
                if($pengajuan->status_approval == 'pending'){
               return '<a class="custom-badge status-red">pending</a>';
               }
                if($pengajuan->status_approval == 'completed'){
                    return '<a class="custom-badge status-green">completed</a>';
                }
               
            })
            ->editColumn('action', function ($data) {
                
                Pengajuan::where('id', $data->id)->get();
            
                return '<button type="delete"  href="' .  route('hrd.pengajuan.destroy', $data->id). '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>';
             

            })
            ->addIndexColumn()
            ->rawColumns(['no_reinburst','status','action'])
            ->make(true);
    }

    public function ajax_pembatalan()
    {
        // $pembatalans = PembatalanUnit::with('no_pembatalan', 'id_spr','alasan_id')->get();

        $pembatalans = DB:: table('pembatalan_units')
        ->leftjoin('sprs','pembatalan_units.spr_id','=','sprs.id')
        ->leftjoin('unit_rumahs','sprs.id_unit','=','unit_rumahs.id')
        ->leftjoin('users','sprs.id_sales','=','users.id')
        ->select('pembatalan_units.tanggal','sprs.no_transaksi','users.name','sprs.status_approval','sprs.id_sales','pembatalan_units.no_pembatalan','pembatalan_units.id','pembatalan_units.diajukan','unit_rumahs.type','sprs.no_transaksi','sprs.harga_net','sprs.status_dp','sprs.status_booking','sprs.nama','pembatalan_units.status')
        ->get();
        // dd($pembatalans);
        return datatables()
            ->of($pembatalans)
            ->editColumn('no_pembatalan', function ($pembatalan) {
                return $pembatalan->no_pembatalan;
            })
            ->editColumn('tanggal', function ($pembatalan) {
                return Carbon::parse($pembatalan->tanggal)->format('d/m/Y');
            })
            ->editColumn('type', function ($pembatalan) {
                return $pembatalan->type;
            })
            ->editColumn('spr', function ($pembatalan) {
                return $pembatalan->no_transaksi;
            })
            ->editColumn('total_beli', function ($pembatalan) {
                return $pembatalan->harga_net;
            })
            ->editColumn('konsumen', function ($pembatalan) {
                return $pembatalan->nama;
            })
            ->editColumn('sales', function ($pembatalan) {
                return $pembatalan->name;
            })
            ->editColumn('booking_fee', function ($pembatalan) {
                return $pembatalan->status_booking;
            })
            ->editColumn('dp', function ($pembatalan) {
                return $pembatalan->status_dp;
            })
            ->editColumn('diajukan', function ($pembatalan) {
                return $pembatalan->diajukan;
            })
            ->editColumn('status', function ($pembatalan) {
                return '<span class="custom-badge status-">' . $pembatalan->status . '</span>';
            })
            ->editColumn('refund', function ($pembatalan) {
                return $pembatalan->status_approval;
            })
            ->editColumn('action', function ($data) {
                
                $tindakan = PembatalanUnit::where('id', $data->id)->where('status', 'Pending')->get();
                if (count($tindakan)==0){
                    return "Not Found";
                 
            }else {
                
                return '<a href="' . route('admin.pembatalans.show', $data->id) . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
             
                } 
            
            })
            ->addIndexColumn()
            ->rawColumns(['no_pembatalan', 'status', 'refund','action'])
            ->make(true);
            // ->addColumn('action', function ($row) {
            //     $html = '<a href="" class="btn btn-xs btn-secondary">Edit</a> ';
            //     $html .= '<button data-rowid="'.$row->id.'" class="btn btn-xs btn-danger">Del</button>';
            //     return $html;
            // })
            
            // ->toJson()
    }
}
