@extends('layout.master')

@section('title' , 'Aplikasi Keuangan Desa Bakalan')

@section('content')
<h2 class="display-4 my-3">Form Tambah Data Pengeluaran</h2>
<form class="col-5" method="post" action="/outcome">
    @csrf
    <div class="form-group">
    <label for="category">Kategori</label>
    <select class="form-control" name="out_category" id="category">
      <option value="Belanja Langsung" selected>Belanja Langsung</option>
      <option value="Belanja Tidak Langsung">Belanja Tidak Langsung</option>
    </select>
    </div>
    <div class="form-group">
      <label for="description">Kegiatan</label>
      <input type="text" class="form-control @error('out_description') is-invalid @enderror" name="out_description" id="description" placeholder="Uraian kegiatan" value="{{old('out_description')}}">
        @error('out_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
      <label for="price">Harga</label>
      <input class="form-control @error('out_balance') is-invalid @enderror" id="rupiah" name="out_balance" placeholder="Harga" value="{{old('out_balance')}}">
      @error('out_balance')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
        <label for="info">Information</label>
        <input type="text" class="form-control" name="out_info" id="info" placeholder="Keterangan Tambahan" value="{{old('out_info')}}">
        <small id="info" class="form-text text-muted">(Optional)</small>
        </div>
    <button type="submit" class="btn btn-primary">Tambah Data</button>
  </form>
@endsection
@section('script')

@endsection