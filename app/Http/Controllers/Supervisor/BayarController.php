<?php

namespace App\Http\Controllers\Supervisor;

use App\Alasan;
use App\Http\Controllers\Controller;
use App\Pembatalan;
use App\Pembayaran;
use App\Refund;
use App\Rumah;
use App\Spr;
use App\Tagihan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BayarController extends Controller
{
    public function index(Request $request)
    {
        $no = request()->get('no_transaksi');
        $spr = Spr::select('no_transaksi')->distinct()->get();
        $getSpr = Spr::where('no_transaksi', $no)->get();
        $tagihan = Tagihan::where('no_transaksi', $no)->get();
        $bayar = Pembayaran::where('no_detail_transaksi', $no)->get();

        return view('supervisor.payment.index', compact('spr', 'getSpr', 'tagihan', 'bayar'));
    }

    public function show($id)
    {
        $no = request()->get('no_transaksi');
        $spr = Spr::select('no_transaksi')->where('id_sales', $id)->get();
        $getSpr = Spr::where('no_transaksi', $no)->get();
        $tagihan = Tagihan::where('no_transaksi', $no)->get();
        $bayar = Pembayaran::where('no_detail_transaksi', $no)->get();

        foreach ($tagihan as $key) {
            $status[] = [
                'id_rincian' => $key->id_rincian,
                'status_pembayaran' => $key->status_pembayaran,
            ];
        };

        return view('supervisor.payment.create', compact('spr', 'getSpr', 'tagihan', 'bayar', 'id'));

    }

    public function sales()
    {
        if (auth()->user()->roles()->first()->name == 'supervisor') {
            $user = User::where('id_roles', 4)->get();

            $batal = Pembatalan::orderBy('no_pembatalan', 'desc')->get();
            $refund = Refund::all();
            foreach ($refund as $rf) {

            }
            $nobatal = $rf->no_pembatalan;
            $refund1 = Refund::where('no_pembatalan', $nobatal)->orderBy('no_refund', 'desc')->get();
            foreach ($refund1 as $rf1) {

            }
            return view('supervisor.payment.index', compact('user', 'batal', 'rf1'));
        }

    }

    public function cancel($id)
    {
        $no = request()->get('no_transaksi');
        $spr = Spr::select('no_transaksi')->where('id_sales', $id)->get();
        $getSpr = Spr::where('no_transaksi', $no)->get();
        $tagihan = Tagihan::where('no_transaksi', $no)->get();
        $bayar = Pembayaran::where('no_detail_transaksi', $no)->get();

        $alasan = Alasan::all();
        if ($no) {

            $notf = Spr::select('id_transaksi')->where('no_transaksi', $no)->get();
            foreach ($notf as $no) {
                # code...
            }
            $idtf = $no->id_transaksi;
            $batal = Pembatalan::select('no_pembatalan')->where('spr_id', $idtf)->first();
            dd($batal);

            foreach ($batal as $bt) {
                # code...
            }
            $idbatal = $bt->spr->no_transaksi;

            return view('supervisor.payment.cancel', compact('getSpr', 'spr', 'alasan', 'idbatal'));
        } else {
            # code...
            return view('supervisor.payment.cancel', compact('getSpr', 'spr', 'alasan'));
        }

    }

    public function storeBatal(Request $request)
    {

        $spv = auth()->user()->name;

        $tgl = Carbon::now()->format('d-m-Y');
        $AWAL = 'PB';
        $noUrutAkhir = Pembatalan::max('id');

        $nourut = $AWAL . '/' . sprintf('%02s', abs(1)) . '/' . sprintf('%05s', abs($noUrutAkhir + 1));

        Pembatalan::create([
            'tanggal' => $tgl,
            'no_pembatalan' => $nourut,
            'spr_id' => $request->id_spr,
            'alasan_id' => $request->alasan,
            'diajukan' => $spv,
            'status' => 'pending',
        ]);

        return redirect()->route('supervisor.payment.index');
    }

    public function nominal(Request $request)
    {
        $no = request()->get('no_transaksi');

        $where = [
            'id_rincian' => $request->rincian_id,
        ];

        $data = DB::table('rincian_tagihan_spr')
            ->select('rincian_tagihan_spr.id_rincian', 'rincian_tagihan_spr.jumlah_tagihan')
            ->groupBy('rincian_tagihan_spr.jumlah_tagihan', 'rincian_tagihan_spr.id_rincian')
            ->where($where)->get();

        return $data;
    }

    public function storeBayar(Request $request)
    {
        $tgl = Carbon::now()->format('d-m-Y');
        Pembayaran::create([
            'id_admin' => auth()->user()->id,
            'no_detail_transaksi' => $request->no_transaksi,
            'tanggal_transaksi' => $tgl,
            'rincian_id' => $request->rincian_id,
            'nominal' => $request->nominal,
            'bank_tujuan' => $request->bank_tujuan,
            'id_perusahaan' => '1',
            'status_approval' => 'pending',
        ]);

        return redirect()->back();

    }

    public function hapuskonfirmasi($id)
    {
        $check = Pembayaran::select('rincian_id')->where('id', $id)->first();
        $id_rincian = $check->rincian_id;
        $tagihan = Tagihan::where('id_rincian', $id_rincian)->first();
        $tagihan->status_pembayaran = 'unpaid';
        $tagihan->save();

        $idspr = $tagihan->id_spr;
        $spr = Spr::where('id_transaksi', $idspr)->first();
        $spr->status_booking = 'unpaid';
        $spr->save();

        $idunit = $spr->id_unit;
        $unit = Rumah::where('id_unit_rumah', $idunit)->first();
        $unit->status_penjualan = 'Available';
        $unit->save();
        // dd($test);

        // if ($delete) {
        DB::table('pembayaran_unit')->where('id', $id)->delete();
        // dd($tagihan);
        // }
        return redirect()->back();
    }
}
