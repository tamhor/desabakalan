@extends('layout.master')

@section('title' , 'Aplikasi Keuangan Desa Bakalan')

@section('content')
<h2 class="display-4 my-3">Data Receipt</h2>
<form class="form-inline my-2 d-flex justify-content-between">
<a href="/outcomes/create" class="btn btn-primary my-2">Tambah Data Pengeluaran</a>
<div class="input-group col-md-4">
    <input class="form-control py-2" type="search" id="" placeholder="Search...">
    <span class="input-group-append">
        <button class="btn btn-outline-primary" type="button">
            <i class="fa fa-search"></i>
        </button>
    </span>
</div>
</form>
<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Categories</th>
        <th scope="col">Descriptions</th>
        <th scope="col">Prices</th>
        <th scope="col">Informartion</th>
      </tr>
    </thead>
    <tbody>
        {{-- @foreach ($collection as $item) --}}
        <tr>
            <th scope="row">1</th>
            <td>Bidang Penyelenggaraan Pemerintahan Desa</td>
            <td>Penghasilan Tetap dan Tunjangan</td>
            <td>Rp 3,000,000</td>
            <td></td>
        </tr>
        {{-- @endforeach --}}
    </tbody>
</table>
@endsection