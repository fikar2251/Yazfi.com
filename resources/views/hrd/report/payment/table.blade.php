<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered report custom-table" width="100%">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th>Tanggal</th>
                        <th>Cabang</th>
                        <th>Metode Pembayaran</th>
                        <th>Change</th>
                        <th>Dibayar</th>
                        <th>Potongan</th>
                        <th>Diskon</th>
                        <th>Kasir</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                @if($payments != null)
                @php
                $total = 0;
                @endphp
                <tbody>
                    @foreach($payments as $pay)
                    <tr>
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td>{{ $pay->tanggal_pembayaran }}</td>
                        <td>{{ $pay->booking->cabang->nama }}</td>
                        <td>{{ $pay->payment->nama_metode }}</td>
                        <td>@currency($pay->change)</td>
                        <td>@currency($pay->dibayar)</td>
                        <td>@currency($pay->biaya_kartu) ({{ $pay->payment->potongan }}%)</td>
                        <td>@currency($pay->disc_vouc)</td>
                        <td>{{ $pay->kasir->name }}</td>
                        <td>@currency($pay->nominal)</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td><strong>Grand Total</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>@currency($payments->sum('change'))</td>
                        <td>@currency($payments->sum('dibayar'))</td>
                        <td></td>
                        <td>@currency($payments->sum('disc_vouc'))</td>
                        <td></td>
                        <td>@currency($payments->sum('nominal'))</td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>