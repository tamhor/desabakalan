@extends('layout.master')

@section('title' , 'Aplikasi Keuangan Desa Bakalan')

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

<h2 class="display-4 my-3">Data Pengeluaran</h2>
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
        Saldo PAD : {{ formatRp($income->sum('in_balance')-$category->sum('out_balance')) }}
    </span>
<table id="data-table" class="table dt-responsive nowrap" style="width:100%">
    <thead class="thead-dark">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Date</th>
        <th scope="col">Categories</th>
        <th scope="col">Descriptions</th>
        <th scope="col">Prices</th>
        <th scope="col">Informartion</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($category as $item)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ date('d F y', strtotime($item->created_at)) }}</td>
            <td>{{ $item->category->name }}</td>
            <td>{{ $item->out_description }}</td>
            <td>{{ formatRp($item->out_balance) }}</td>
            <td>{{ $item->out_info }}</td>
            <td>
                <a href="outcome/{{ $item->id }}/edit" class="badge badge-success" title="Ubah data">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
                <a href="#" data-target="#HapusData" class="badge badge-danger deleteData" data-toggle="modal" data-id="{{ $item->id }}" title="Hapus data">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </a>
                <a href="#" data-target="#PrintData" data-toggle="modal" class="badge badge-primary printData"
                data-harga="{{ terbilang($item->out_balance) }}" data-uraian="{{ $item->out_description }}" data-rp="{{ formatRp($item->out_balance) }}" 
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
                    <h4 class="card-title">Kwitansi Pengeluaran - Desa Bakalan</h4>
                    <hr>
                    <form class="card-text">
                        <h5>Terima Dari : Bendahara Desa</h5>
                        <div class="form-inline row">
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
                    <div class="form-inline justify-content-end mt-5">
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
    $('#FormHapus').attr('action', 'outcome/'+data_id)
});
</script>
<script>
$(document).on('click', '.printData', function () {
    var harga = $(this).data('harga');
    var rp = $(this).data('rp');
    var uraian = $(this).data('uraian');
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