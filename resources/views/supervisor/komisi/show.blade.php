@extends('layouts.master', ['title' => 'Appointment'])

@section('content')
<div class="row">
    <div class="col-sm-5 col-4">
        <h4 class="page-title">Rincian Appointment</h4>
    </div>
    <div class="col-sm-7 col-8 text-right m-b-30">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-white">CSV</button>
            <button class="btn btn-white">PDF</button>
            <button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row custom-invoice">
                    <div class="col-6 col-sm-6 m-b-20">
                        <img src="{{ asset('/storage/' . \App\Setting::find(1)->logo) }}" class="inv-logo" alt="">
                        <ul class="list-unstyled">
                            <li>{{ \App\Setting::find(1)->web_name }}</li>
                            <li>{{ $appointment->cabang->nama }}</li>
                            <li>{{ $appointment->cabang->alamat }}</li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-6 m-b-20">
                        <div class="invoice-details">
                            <h3 class="text-uppercase">{{ $appointment->no_booking }}</h3>
                            <ul class="list-unstyled">
                                <li>Date booking: <span>{{ Carbon\Carbon::parse($appointment->tanggal_status)->format('d/m/Y') }}}</span></li>
                                <li>No Rekam Medik: <span>{{ $appointment->pasien->rekam_medik }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-6 m-b-20">

                        <h5>Invoice to:</h5>
                        <ul class="list-unstyled">
                            <li>
                                <h5><strong>{{ $appointment->pasien->nama }}</strong></h5>
                            </li>
                            <li><span>{{ $appointment->pasien->alamat }}</span></li>
                            @php
                            $age = explode(",", $appointment->pasien->ttl)
                            @endphp
                            <li>{{ \Carbon\Carbon::now()->format('Y') - \Carbon\Carbon::parse($appointment->pasien->tgl_lahir)->format('Y') }} Tahun</li>
                            <li>{{ $appointment->pasien->jk }}</li>
                            <li>{{ $appointment->pasien->nik_ktp }}</li>
                        </ul>

                    </div>
                    @php
                    $pajak = $appointment->tindakan->sum('nominal') * $appointment->cabang->ppn / 100
                    @endphp
                    <div class="col-sm-6 col-lg-6 m-b-20">
                        <div class="invoices-view">
                            <span class="text-muted">Payment Details:</span>
                            <ul class="list-unstyled invoice-payment-details">
                                <li>
                                    <h5>Total Due: <span class="text-right">@currency($appointment->tindakan->sum('nominal') + $pajak)</span></h5>
                                </li>
                                <li>Perawat: <span data-toggle="modal" data-target="#perawatModal" id="perawat">{{ $appointment->perawat->name ?? '-' }}
                                    </span></li>
                                <li>Office boy: <span data-toggle="modal" data-target="#obModal" id="ob">{{ $appointment->ob->name ?? '-' }}</span></li>
                                <li>Resepsionis: <span>{{ $appointment->resepsionis->name ?? '-'}}</span></li>
                                <li>Address: <span>{{ $appointment->cabang->alamat }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ITEM</th>
                                <th>DESCRIPTION</th>
                                <th>UNIT COST</th>
                                <th>QUANTITY</th>
                                <th>DOKTER</th>
                                <th>TOTAL</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total = 0;
                            @endphp
                            @foreach($appointment->tindakan as $tindakan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tindakan->item->nama_barang }}</td>
                                <td>{{ $tindakan->item->description }}</td>
                                @php
                                $harga = \App\HargaProdukCabang::where('barang_id', $tindakan->item->id)->where('cabang_id', auth()->user()->cabang_id)->first();
                                @endphp
                                <td>@currency($harga->harga)</td>
                                <td>{{ $tindakan->qty }}</td>
                                <td>{{ $tindakan->dokter->name }}</td>
                                <td>@currency($harga->harga * $tindakan->qty)</td>
                                <td><span class="custom-badge status-{{ $tindakan->status == 0 ? 'red' : 'green' }}">{{ $tindakan->status == 0 ? 'Belum' : 'Selesai' }}</span></td>
                            </tr>
                            @php
                            $total += $harga->harga * $tindakan->qty
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    <div class="row invoice-payment">
                        <div class="col-sm-7">
                        </div>
                        <div class="col-sm-12">
                            <div class="m-b-20">
                                <h6>Total due</h6>
                                <div class="table-responsive no-border">
                                    <table border="1" class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <th>Subtotal:</th>
                                                <td class="text-right">@currency($total)</td>
                                            </tr>
                                            @if($appointment->cabang->status_pajak == 1)
                                            <tr>
                                                <th>Pajak ({{ $appointment->cabang->ppn }}%):</th>
                                                <td class="text-right">
                                                    @php
                                                    $pajak = $total * $appointment->cabang->ppn / 100
                                                    @endphp
                                                    @currency($pajak)
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <th>Grand Total :</th>
                                                <td class="text-right">@currency($total + $pajak)</td>
                                            </tr>
                                            <tr>
                                                <th>Dibayar:</th>
                                                <td class="text-right">@currency($rincians->sum('dibayar') + $appointment->rincian->sum('disc_vouc'))</td>
                                            </tr>
                                            <tr>
                                                <th>Sisa Pembayaran:</th>
                                                <td class="text-right text-primary sisa" id="@currency($total - $appointment->rincian->sum('dibayar') + $pajak)">
                                                    <h5 class="tsisa">@currency($total - $rincians->sum('dibayar') + $pajak - $appointment->rincian->sum('disc_vouc'))</h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-info">
                        <h5>Rincian Komisi</h5>

                        <p></p>
                        <table width="520" border="0" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pegawai</th>
                                    <th>Nominal </th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($rincians as $komisi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Carbon\Carbon::parse($komisi->created_at)->format('d/m/Y') }}</td>
                                    <td>{{ $komisi->user->name }}</td>
                                    <td>@currency($komisi->nominal_komisi)</td>
                                    <td>
                                        <a href="{{ route('supervisor.komisi.change', $komisi->id) }}" class="btn btn-sm btn-secondary">Change</a>
                                        <a href="{{ route('supervisor.komisi.edit', $komisi->id) }}" class="btn btn-sm btn-success">Edit</a>
                                        <form action="{{ route('supervisor.komisi.destroy', $komisi->id) }}" method="post" style="display: inline;" class="delete-form">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('footer')

@if(session('success'))
<script>
    iziToast.success({
        title: 'Success',
        position: 'topRight',
        message: "{{ session('success') }}",
    });
</script>
@endif
@stop