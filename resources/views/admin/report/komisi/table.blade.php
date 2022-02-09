<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered custom-table report">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>No Booking</th>
                        <th>Nama</th>
                        <th>Persentase</th>
                        <!-- <th>Role</th> -->
                        <th>Nominal</th>
                        <th>Kasir</th>
                    </tr>
                </thead>
                @php
                $total = 0;
                @endphp
                @if($komisi != null)
                <tbody>
                    @foreach($komisi as $kms)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kms->booking->created_at }}</td>
                        <td>{{ $kms->booking->no_booking }}</td>
                        <td>{{ $kms->user->name }}</td>
                        <td>
                            @foreach($kms->user->roles as $rl)
                            @php
                            $persentase = \App\Komisi::where('role_id',$rl->id)->first();
                            @endphp
                            {{ $persentase->persentase }} %
                            @endforeach
                        </td>
                        <!-- <td>
                            @foreach($kms->user->roles as $rl)
                            {{ $rl->key }}
                            @endforeach
                        </td> -->
                        <td>@currency($kms->nominal_komisi)</td>
                        @php
                        $kasir = \App\User::find($kms->booking->resepsionis_id)
                        @endphp
                        <td>{{ $kasir->name }}</td>
                    </tr>
                    @php
                    $total += $kms->nominal_komisi;
                    @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td><strong>Grand Total</strong></td>
                        <td></td>
                        <td></td>
                        <!-- <td></td> -->
                        <td></td>
                        <td></td>
                        <td>@currency($total)</td>
                        <td></td>
                    </tr>
                </tfoot>
                @endif

            </table>
        </div>
    </div>
</div>