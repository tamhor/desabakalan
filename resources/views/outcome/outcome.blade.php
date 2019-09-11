@extends('layout.master')

@section('title' , $title)

@section('content')
<style>
@media screen {
  #printSection {
      display: none;
  }
}

@media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position: absolute;
    width: 100%;
    top:0;
  }
}
</style>

<form class="form-inline my-2 d-flex justify-content-between">
<a href="/outcome/create" class="btn btn-primary my-2">Tambah Data Pengeluaran</a>

@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
</form>
    <span class="btn btn-outline-secondary mb-3">
        SALDO : {{ formatRp($income->sum('in_balance')-$outcome->sum('out_balance')) }}
    </span>
<table id="data-table" class="table dt-responsive nowrap" style="width:100%">
    <thead class="thead-dark">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Sumber</th>
        <th scope="col">Kegiatan</th>
        <th scope="col">Uraian</th>
        <th scope="col">Harga</th>
        <th scope="col">Keterangan</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($outcome as $item)
        <tr>
            <td scope="row">{{ $loop->iteration }}</td>
            <td>{{ date('d F y', strtotime($item->created_at)) }}</td>
            <td>{{ $item->source }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->out_description }}</td>
            <td>{{ formatRp($item->out_balance) }}</td>
            <td>{{ $item->out_info }}</td>
            <td>
                <a href="{{ url('/outcome/'.$item->id.'/edit') }}" class="badge badge-success" title="Ubah data">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
                <a href="#" data-target="#HapusData" class="badge badge-danger deleteData" data-toggle="modal" data-id="{{ $item->id }}" title="Hapus data">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </a>
                <a href="#" data-target="#PrintData" data-toggle="modal" class="badge badge-primary printData"
                data-sumber="{{ $item->source }}" data-harga="{{ terbilang($item->out_balance) }}" data-uraian="{{ $item->name }} - {{ $item->out_description }}" data-rp="{{ formatRp($item->out_balance) }},-" 
                title="Cetak data">
                    <i class="fa fa-print" aria-hidden="true"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="HapusData" tabindex="-1" role="dialog" aria-labelledby="HapusDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="HapusDataLabel">Konfirmasi Hapus Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p class="text-center">Apakah anda yakin menghapus data ini?</p>
        </div>
        <div class="modal-footer">
            <a class="btn btn-secondary text-white" data-dismiss="modal">Kembali</a>
            <form method="post" class="d-inline" id="FormHapus" action="">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger" title="Hapus data">
                    Ya, Hapus
                </button>
            </form>        
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="PrintData" tabindex="-1" role="dialog" aria-labelledby="PrintDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="PrintDataLabel">Cetak Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="kwitansi">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h4 class="card-title">Kwitansi Pengeluaran - Desa Bakalan </h4>
                    <hr>
                    <form class="card-text">
                        <h5>Terima Dari : Bendahara Desa</h5>
                        <div class="form-inline row">
                        <label class="col-3">Sumber Dana </label><input class="form-control ml-2 col-8" id="sumber" disabled/>
                        </div>
                        <div class="form-inline row mt-1">
                        <label class="col-3">Terbilang </label><input class="form-control ml-2 col-8" id="harga" disabled/>
                        </div>
                        <div class="form-inline row mt-1">
                        <label class="col-3">Untuk Pembayaran </label><input class="form-control ml-2 col-8" id="uraian" disabled/>
                        </div>
                        <hr>
                    </form>
                    <div class="form-inline justify-content-between">
                        <input type="text" id="rp" style="width: 18rem;" class="form-control" disabled/>
                    <h6 class="card-link">Bakalan, {{ date('d F Y') }}</h6>
                    </div>
                    <div class="form-inline justify-content-end">
                    <h6 class="card-link" style="margin-right: 50px;">Bendahara</h6>
                    <h6 class="card-link mr-5">Penerima</h6>
                    </div>
                    <div class="form-inline justify-content-end mt-5">
                        <p class="card-link">_______________</p>
                        <p class="card-link">_______________</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="btn btn-secondary text-white" data-dismiss="modal">Kembali</a>
            <button type="submit" id="btnPrint" class="btn btn-danger" title="Cetak data">
                Cetak
            </button>
        </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).on('click', '.deleteData', function () {
    var data_id = $(this).data("id");
    var APP_URL = {!! json_encode(url('/')) !!};
    $('#FormHapus').attr('action', APP_URL+'/outcome/'+data_id);
});
</script>
<script>
$(document).on('click', '.printData', function () {
    var sumber = $(this).data('sumber');
    var harga = $(this).data('harga');
    var rp = $(this).data('rp');
    var uraian = $(this).data('uraian');
    $('#sumber').val(sumber);
    $('#harga').val(harga);
    $('#uraian').val(uraian);
    $('#rp').val(rp);
});
</script>
<script>
document.getElementById("btnPrint").onclick = function () {
    printElement(document.getElementById("kwitansi"));
}

function printElement(elem) {
    var domClone = elem.cloneNode(true);
    
    var $printSection = document.getElementById("printSection");
    
    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }
    
    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
}
</script>
@endsection