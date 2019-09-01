@extends('layout.master')

@section('title' , 'Aplikasi Keuangan Desa Bakalan')

@section('content')
<h2 class="display-4 my-3">Data Pendapatan</h2>
<form class="form-inline my-2 d-flex justify-content-between">
<a href="/income/create" class="btn btn-primary my-2">Tambah Data Pendapatan</a>

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
    Saldo PAD : {{ formatRp($category->sum('in_balance')-$outcome->sum('out_balance')) }}
</span>
<table id="data-table" class="table dt-responsive nowrap" style="width:100%">
    <thead class="thead-dark">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Date</th>
        <th scope="col">Categories</th>
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
            <td>{{ formatRp($item->in_balance) }}</td>
            <td>{{ $item->in_info }}</td>
            <td>
                <a href="income/{{ $item->id }}/edit" class="badge badge-success" title="Ubah data">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
                <a href="#" data-target="#HapusData" id="asyu" class="badge badge-danger deleteProduct" data-toggle="modal" data-id="{{ $item->id }}" title="Hapus data">
                    <i class="fa fa-trash" aria-hidden="true"></i>
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

@endsection
@section('script')
<script>
$(document).on('click', '.deleteProduct', function () {
    var data_id = $(this).data("id");
    $('#FormHapus').attr('action', 'income/'+data_id)
});
</script>
@endsection