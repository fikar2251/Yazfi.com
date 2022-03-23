<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBarangRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateBarangRequest;
use Carbon\Carbon;

use App\PembatalanUnit;
use App\Penggajian;
use App\Spr;

class PembatalanUnitController extends Controller
{
    public function index()
    {
  
        return view('admin.pembatalans.index');
    }



    public function update(PembatalanUnit $pembatalan)
    {
        $post = PembatalanUnit::where('spr_id',$pembatalan->spr_id)->get();
        // dd($post);
        foreach ($post as $pur) {
            $unit = Spr::where('id_unit', $pur->id)->first();
            dd($unit);
            $unit->update(['status' => 'Approval']);
            $unit_rumah = DB::table('unit_rumahs')
            ->leftJoin('sprs','unit_rumahs.id','=','sprs.id_unit')
            ->select('unit_rumahs.id','sprs.id_unit')
            ->where('unit_rumahs.id', $unit);
            $unit_rumah->update(['status_penjualan' => 'Available']);
        }
        

        return redirect()->route('admin.pembatalans.index')->with('success', 'Status has been updated');
    }

    
    // public function destroy(Barang $product)
    // {
    //     // abort_unless(\Gate::allows('product-delete'), 403);

    //     $product->delete();
    //     return redirect()->route('admin.product.index')->with('success', 'Product has been deleted');
    // }

    public function ajax(Request $request)
    {
       if(request()->ajax()){
           if(!empty($request->from)){

               $pembatalans = DB:: table('pembatalan_units')
               ->leftjoin('sprs','pembatalan_units.spr_id','=','sprs.id')
               ->leftjoin('unit_rumahs','sprs.id_unit','=','unit_rumahs.id')
               ->leftjoin('users','sprs.id_sales','=','users.id')
               ->whereBetween('pembatalan_units.tanggal', array($request->from, $request->to))
               ->select('pembatalan_units.tanggal','sprs.no_transaksi','users.name','sprs.status_approval','sprs.id_sales','pembatalan_units.no_pembatalan','pembatalan_units.id','pembatalan_units.diajukan','unit_rumahs.type','sprs.no_transaksi','sprs.harga_net','sprs.status_dp','sprs.status_booking','sprs.nama','pembatalan_units.status')
               ->get();
           }else{

            $pembatalans = DB:: table('pembatalan_units')
               ->leftjoin('sprs','pembatalan_units.spr_id','=','sprs.id')
               ->leftjoin('unit_rumahs','sprs.id_unit','=','unit_rumahs.id')
               ->leftjoin('users','sprs.id_sales','=','users.id')
               ->select('pembatalan_units.tanggal','sprs.no_transaksi','users.name','sprs.status_approval','sprs.id_sales','pembatalan_units.no_pembatalan','pembatalan_units.id','pembatalan_units.diajukan','unit_rumahs.type','sprs.no_transaksi','sprs.harga_net','sprs.status_dp','sprs.status_booking','sprs.nama','pembatalan_units.status')
               ->get();
           }

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
                
                $button = '<a href="' . route('admin.pembatalans.update', $data->id) . '"  class="custom-badge status-green"><i class="fa-solid fa-check-to-slot"></i></a>';
                 return $button;
             
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
}
