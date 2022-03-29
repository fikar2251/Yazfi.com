<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pembatalan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PembatalanUnitController extends Controller
{
    public function index()
    {

        return view('admin.pembatalans.index');
    }

    public function show($id)
    {

        $post = Pembatalan::findOrFail($id);
        $post->update(['status' => 'Approval']);
        $idunit = $post->spr->unit->id_unit_rumah;
        $unit_rumah = DB::table('unit_rumah')
            ->leftJoin('spr', 'unit_rumah.id_unit_rumah', '=', 'spr.id_unit')
            ->select('unit_rumah.id_unit_rumah')
            ->where('unit_rumah.id_unit_rumah', $idunit);
        $unit_rumah->update(['status_penjualan' => 'Available']);

        return redirect()->route('admin.pembatalans.index')->with('success', 'Status has been updated');
    }

    // public function destroy(Barang $product)
    // {
    //     // abort_unless(\Gate::allows('product-delete'), 403);

    //     $product->delete();
    //     return redirect()->route('admin.product.index')->with('success', 'Product has been deleted');
    // }

    public function ajax()
    {
        // $pembatalans = PembatalanUnit::with('no_pembatalan', 'id_spr','alasan_id')->get();

        $pembatalans = DB::table('pembatalan_unit')
            ->leftjoin('spr', 'pembatalan_unit.spr_id', '=', 'spr.id_transaksi')
            ->leftjoin('unit_rumah', 'spr.id_unit', '=', 'unit_rumah.id_unit_rumah')
            ->leftjoin('users', 'spr.id_sales', '=', 'users.id')
            ->select('pembatalan_unit.tanggal', 'spr.no_transaksi', 'users.name', 'spr.status_approval', 'spr.id_sales', 'pembatalan_unit.no_pembatalan', 'pembatalan_unit.id', 'pembatalan_unit.diajukan', 'unit_rumah.type', 'spr.no_transaksi', 'spr.harga_net', 'spr.status_dp', 'spr.status_booking', 'spr.nama', 'pembatalan_unit.status')
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

                $tindakan = Pembatalan::where('id', $data->id)->where('status', 'Pending')->get();
                if (count($tindakan) == 0) {
                    return "Not Found";

                } else {

                    return '<a href="' . route('admin.pembatalans.show', $data->id) . '"><i class="fa fa-pencil m-r-5"></i> Edit</a>';

                }

            })
            ->addIndexColumn()
            ->rawColumns(['no_pembatalan', 'status', 'refund', 'action'])
            ->make(true);
        // ->addColumn('action', function ($row) {
        //     $html = '<a href="" class="btn btn-xs btn-secondary">Edit</a> ';
        //     $html .= '<button data-rowid="'.$row->id.'" class="btn btn-xs btn-danger">Del</button>';
        //     return $html;
        // })

        // ->toJson()
    }
}
