<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped custom-table report" id="product" width="100%">
                <thead>
                    <tr>
                        <th style="width:5%;">No</th>
                        <th>Nama Item</th>
                        <th>Supllier</th>
                        <th>Project</th>
                        {{-- <th>Before</th> --}}
                        <th style="width:5%;">In</th>
                        <th style="width:5%;">Out</th>
                        <th style="width:5%;">Last Stok</th>
                        <th>Waktu</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangs as $barang)
          
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">Total : </td>
                       
                     
                        {{-- <td>{{ $barangs->sum('last_stok') - ($barang->sum('out') + $barangs->sum('in')) ?? 0 }}</td> --}}
                        <td>{{ $barangs->sum('in') ?? 0 }}</td>
                        <td>{{ $barangs->sum('out') ?? 0 }}</td>
                        <td>{{$barangs->sum('in') - $barangs->sum('out') ?? 0 }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>