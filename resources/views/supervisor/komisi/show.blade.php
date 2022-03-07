@extends('layouts.master', ['title' => 'Input Komisi'])

@section('content')

    @php

    use App\Marketing;
    use App\Spr;
    use App\Pembatalan;
    use App\Komisi;

    $AWAL = 'KM';
    $noUrutAkhir = Komisi::max('id');

    $nourut = $AWAL . '/' . sprintf('%02s', abs(1)) . '/' . sprintf('%05s', abs($noUrutAkhir + 1));

    @endphp

    <div class="row">
        <div class=" col text-center">
            <h4 style="font-size: 30px; font-weight: 500;" class="page-title mb-3">FORM INPUT KOMISI </h4>
            <div class="text-center">
                <div class="form-group row d-flex justify-content-center">
                    <label for="no_transaksi" class="col-sm-1">No <span>:</span></label>
                    <div class="col-sm-2">
                        <input style="text-decoration: none; border-style: none; background-color: #FAFAFA" type="text"
                            name="no_komisi" id="tanggal" value="{{ $nourut }}">
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <label for=" tanggal" class="col-sm-1">Tanggal <span>:</span></label>
                    <div class="col-sm-2">
                        <input style="text-decoration: none; border-style: none; background-color: #FAFAFA" type="text"
                            name="tanggal_komisi" id="tanggal_komisi"
                            value="{{ Carbon\Carbon::now()->format('d-m-Y') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="" method="GET">
        <div class="form-group row d-flex justify-content-center mt-2">
            <label for="name" class="col-sm-2">Masukkan nomor SPR :</label>
            <div class="col-sm-2">
                <select name="no_transaksi" id="spr" class="form-control">
                    @if (!request()->get('no_transaksi'))
                        <option selected value=""></option>
                    @endif
                    @foreach ($spr as $item)
                        @if (request()->get('no_transaksi') == $item->no_transaksi)
                            <option value="{{ $item->no_transaksi }}" selected>{{ $item->no_transaksi }}</option>
                        @else
                            <option value="{{ $item->no_transaksi }}">{{ $item->no_transaksi }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <button type="submit" name="submit" class="btn btn-primary">Cari</button>
            </div>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </form>

    @if (request()->get('no_transaksi'))
        {{-- @if ($idspr == $idbatal)
            <h2 class="text-center mt-5"> Anda sudah input SPR ini</h2>
        @else --}}
        <form action="{{ route('supervisor.komisi.storekomisi') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12 container">
                    <div class="card shadow">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered custom-table table-striped">
                                    <thead>
                                        @foreach ($spr as $item)
                                            <tr>
                                                <th style="width: 200px">NO</th>
                                                <th style="width: 20px">:</th>
                                                <th> {{ $nourut }} <input type="hidden" name="no_komisi" value="{{$nourut}}">
                                                     <input type="hidden" name="no_transaksi" value="{{$item->no_transaksi}}">
                                                </th>

                                                <td>Harga Jual</td>
                                                <td>:</td>
                                                <td> @currency($item->harga_jual) 
                                                    <input type="hidden"
                                                        value="{{ $item->harga_jual }}" name="harga_jual" id="harga_jual">
                                                </td>

                                            </tr>
                                            {{-- @endforeach --}}
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 200px">Tanggal</td>
                                            <td style="width: 20px">:</td>
                                            <td>{{ Carbon\Carbon::now()->format('d-m-Y') }}</td>

                                            <td>PPH</td>
                                            <td>:</td>
                                            <td class="d-flex">  <input type="number" name="persenpph" id="persenpph"
                                                class="form-control" style="width: 80px" value="">&nbsp;
                                            <h3> % </h3> <input type="text" name="pph" id="pph"
                                            class="form-control" style="width: 140px" value="" style="text-decoration: none" readonly></td> 
                                        </tr>
                                        {{-- @foreach ($getSpr as $item) --}}
                                        <tr>
                                            <td style="width: 200px">Project</td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                {{ $item->project->nama_project }}
                                            </td>

                                            <td>BPHTB</td>
                                            <td>:</td>
                                            <td class="d-flex"> <input type="number" name="persenbphtb" id="persenbphtb"
                                                class="form-control" style="width: 80px" value="">&nbsp;
                                            <h3> % </h3> <input type="text" name="bphtb" id="bphtb"
                                            class="form-control" style="width: 140px" value="" style="text-decoration: none" readonly> </td>
                                        </tr>
                                        {{-- @endforeach --}}
                                        <tr>
                                            <td style="width: 200px">Sales ({{ $item->user->name }}) <input type="hidden" name="sales" value="{{ $item->user->name }}"></td>
                                            <td style="width: 20px">:</td>
                                            <td>
                                                @currency($komisi['sales']) <input type="hidden" name="nominal_sales" value="{{$komisi['sales']}}">
                                            </td>

                                            <td>Pengurangan lain-lain</td>
                                            <td>:</td>
                                            <td class="d-flex"> <input type="number" name="persenpll" id="persenpll"
                                                class="form-control" style="width: 80px" value="">&nbsp;
                                            <h3> % </h3> <input type="text" name="pll" id="pll"
                                            class="form-control" style="width: 140px" value="" style="text-decoration: none" readonly> </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px">SPV ({{ auth()->user()->name }})</td> <input type="hidden" name="spv" value="{{ auth()->user()->name }}">
                                            <td style="width: 20px">:</td>
                                            <td>
                                                @currency($komisi['spv']) <input type="hidden" name="nominal_spv" value="{{$komisi['spv']}}">
                                            </td>

                                            <td>Total potongan</td>
                                            <td>:</td>
                                            <td> @currency($totalfee) </td>

                                        </tr>
                                        <tr>
                                            <td style="width: 200px">Manager</td> <input type="hidden" name="manager" value="Yanto">
                                            <td style="width: 20px">:</td>
                                            <td>
                                                @currency($komisi['manager']) <input type="hidden" name="nominal_manager" value="{{$komisi['manager']}}">
                                            </td>

                                            <td>Dasar perhitungan</td>
                                            <td>:</td>
                                            <td> @currency($dasar) </td>
                                        </tr>
                                    </tbody>
    @endforeach
    </table>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="m-t-20 text-center">
        <button type="submit" name="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i>
            Save</button>
    </div>
    </form>
    {{-- @endif --}}
    @endif

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    
    <script type="text/javascript">
        $(document).ready(function() {
            $("#persenpph").keyup(function() {
                var harga_jual = parseInt($("#harga_jual").val());
                var persenpph = parseFloat($("#persenpph").val());
                var angkapotongan = harga_jual * (persenpph / 100);
                var pph = rupiah(angkapotongan);
                document.getElementById("pph").value = pph;
            });
        });

        $(document).ready(function() {
            $("#persenbphtb").keyup(function() {
                var harga_jual = parseInt($("#harga_jual").val());
                var persenpph = parseInt($("#persenbphtb").val());
                var angkapotongan = harga_jual * (persenpph / 100);
                var pph = rupiah(angkapotongan);
                document.getElementById("bphtb").value = pph;
            });
        });

        $(document).ready(function() {
            $("#persenpll").keyup(function() {
                var harga_jual = parseInt($("#harga_jual").val());
                var persenpph = parseInt($("#persenpll").val());
                var angkapotongan = harga_jual * (persenpph / 100);
                var pph = rupiah(angkapotongan);
                document.getElementById("pll").value = pph;
            });
        });

        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
        }

    </script>
@stop
