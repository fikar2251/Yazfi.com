@extends('layouts.master', ['title' => 'Gaji Show'])

@section('content')
{{-- @push('bread')
<li class="breadcrumb-item"><a href="{{ route('admin.gaji.index') }}">Gaji</a></li>
<li class="breadcrumb-item active">Show</li>
@endpush --}}
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex flex-row justify-content-between">
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-info">Back</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th colspan="3">Penggajian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Pegawai</th>
                                    <th>:</th>
                                    <th>
                                        <input type="text" value="{{ $penggajian->pegawai->name }}" class="form-control">
                                    </th>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>:</th>
                                    <th>
                                        <input name="tanggal" type="date" class="form-control" value="{{ Carbon\Carbon::parse($penggajian->tanggal)->format('Y-m-d') }}">
                                    </th>
                                </tr>
                                <tr>
                                    <th>Bulan Tahun</th>
                                    <th>:</th>
                                    <th>
                                        <input type="month" value="{{ Carbon\Carbon::parse($penggajian->bulan_tahun)->format('F') }}" name="yearmonth" class="form-control">
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th colspan="3">Penerimaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penggajian->penerimaan as $terima)
                                <tr>
                                    <th>{{ $terima->nama }}</th>
                                    <th>:</th>
                                    <th>
                                        <input type="text" oninput="rupiah(this),penerimaan(this)" value="{{ number_format($terima->nominal) }}" name="penerimaan[{{ $terima->nama }}]" class="form-control penerimaan">
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total Penerimaan</th>
                                    <th>:</th>
                                    <th>
                                        <input type="text" name="total_penerimaan" readonly value="{{ number_format($penggajian->penerimaan->sum('nominal')) }}" id="total_penerimaan" class="form-control">
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th colspan="3">Potongan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penggajian->potongan as $potong)
                                <tr>
                                    <th>{{ $potong->nama }}</th>
                                    <th>:</th>
                                    <th>
                                        <input type="text" oninput="rupiah(this),potongan(this)" value="{{ number_format($potong->nominal) }}" name="potongan[{{ $potong->nama }}]" class="form-control potongan">
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total Potongan</th>
                                    <th>:</th>
                                    <th>
                                        <input type="text" name="total_potongan" readonly value="{{ number_format($penggajian->potongan->sum('nominal')) }}" id="total_potongan" class="form-control">
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th colspan="3">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <th>Total</th>
                                <th>:</th>
                                <th>
                                    <input type="text" value="{{ number_format($penggajian->penerimaan->sum('nominal') - $penggajian->potongan->sum('nominal')) }}" readonly name="total" id="total" class="form-control">
                                </th>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('admin.script')
<script>
    $('#datatable').DataTable()
    const formatter = num => {
        var str = num.toString().replace("", ""),
            parts = false,
            output = [],
            i = 1,
            formatted = null;
        if (str.indexOf(".") > 0) {
            parts = str.split(".");
            str = parts[0];
        }
        str = str.split("").reverse();
        for (var j = 0, len = str.length; j < len; j++) {
            if (str[j] != ",") {
                output.push(str[j]);
                if (i % 3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
            }
        }
        formatted = output.reverse().join("");
        return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };
    const rupiah = e => {
        $(e).val(formatter($(e).val()))
    }
    const WeCanSumSallary = () => {
        $('#total').val(formatter(parseFloat($('#total_penerimaan').val().replace(/,/g, '')) - parseFloat($('#total_potongan').val().replace(/,/g, ''))))
    }
    const potongan = e => {
        let total = 0;
        let coll = $('.potongan')
        for (let i = 0; i < $(coll).length; i++) {
            let ele = $(coll)[i]
            console.log($(ele).val())
            total += parseFloat($(ele).val().replace(/,/g, ''))
        }
        $('#total_potongan').val(formatter(total))
        WeCanSumSallary()
    }
    const penerimaan = e => {
        let total = 0;
        let coll = $('.penerimaan')
        for (let i = 0; i < $(coll).length; i++) {
            let ele = $(coll)[i]
            console.log($(ele).val())
            total += parseFloat($(ele).val().replace(/,/g, ''))
        }
        $('#total_penerimaan').val(formatter(total))
        WeCanSumSallary()
    }

    $('.delete_confirm').click(function(event) {
        let form = $(this).closest("form");
        event.preventDefault();
        swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });
</script>
@endpush