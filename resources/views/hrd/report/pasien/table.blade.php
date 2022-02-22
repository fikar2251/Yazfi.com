<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered custom-table report" width="100%">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th>Nama</th>
                        <th>No Telp</th>
                        <th>Email</th>
                        <th>TTL</th>
                        <th>JK</th>
                        <th>Suku</th>
                        <th>Alamat</th>
                        <th>Pekerjaan</th>
                        <th>Marketing</th>
                        <th>Cabang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pasien as $pas)
                    <tr>
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td>{{ $pas->nama }}</td>
                        <td>{{ $pas->no_telp }}</td>
                        <td>{{ $pas->email }}</td>
                        <td>{{ $pas->tempat_lahir }}, {{ $pas->tgl_lahir }}</td>
                        <td>{{ $pas->jk }}</td>
                        <td>{{ $pas->suku }}</td>
                        <td>{{ $pas->alamat }}</td>
                        <td>{{ $pas->pekerjaan }}</td>
                        <td>{{ $pas->user->name }}</td>
                        <td>{{ $pas->cabang->nama }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>