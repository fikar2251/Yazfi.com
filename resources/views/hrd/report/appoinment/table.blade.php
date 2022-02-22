<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered custom-table report">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Pasien</th>
                        <th>Cabang</th>
                        <th>No Appointment</th>
                        <th>Amount</th>
                        <th>Paid</th>
                        <th>Unpaid</th>
                    </tr>
                </thead>
                @php
                $amount = 0;
                $paid = 0;
                $unpaid = 0;
                @endphp
                <tbody>
                    @foreach($appointments as $appointment)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $appointment->pasien->nama }}</td>
                        <td>{{ $appointment->cabang->nama }}</td>
                        <td>{{ $appointment->no_booking }}</td>
                        @php
                        $pajak = $appointment->tindakan->sum('nominal') * $appointment->cabang->ppn / 100
                        @endphp
                        <td>@currency($appointment->tindakan->sum('nominal') + $pajak) </td>
                        <td>@currency($appointment->rincian->sum('dibayar')) </td>
                        <td>@currency($appointment->tindakan->sum('nominal') + $pajak - $appointment->rincian->sum('dibayar')) </td>
                    </tr>
                    @php
                    $amount += $appointment->tindakan->sum('nominal') + $pajak;
                    $paid += $appointment->rincian->sum('dibayar');
                    $unpaid += $appointment->tindakan->sum('nominal') + $pajak - $appointment->rincian->sum('dibayar');
                    @endphp
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td class="text-center"><b>Grand Total</b></td>
                        <td colspan="3"></td>
                        <td>@currency($amount)</td>
                        <td>@currency($paid)</td>
                        <td>@currency($unpaid)</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>