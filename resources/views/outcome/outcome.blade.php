@extends('layout.master')

@section('title' , 'Aplikasi Keuangan Desa Bakalan')

@section('content')
<h2 class="display-4 my-3">Data Pengeluaran</h2>
<form class="form-inline my-2 d-flex justify-content-between">
<a href="/outcomes/create" class="btn btn-primary my-2">Tambah Data Pengeluaran</a>
@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
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
        <th scope="col">Tanggal</th>
        <th scope="col">Categories</th>
        <th scope="col">Descriptions</th>
        <th scope="col">Prices</th>
        <th scope="col">Informartion</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($outcomes as $item)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ date('d F y', strtotime($item->created_at)) }}</td>
            <td>{{ $item->out_category }}</td>
            <td>{{ $item->out_description }}</td>
            <td>{{ $item->out_balance }}</td>
            <td></td>
            <td>
                <a href="outcome/{{ $item->id }}/edit" class="badge badge-success">Edit</a>
            <form method="post" action="outcome/{{ $item->id }}" class="d-inline">
                @method('delete')
                @csrf
                <button type="submit" class="badge badge-danger">Delete</button>
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection