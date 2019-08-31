@extends('layout.master')

@section('title' , 'Aplikasi Keuangan Desa Bakalan')

@section('content')
<h2 class="display-4 my-3">Form Tambah Data Pendapatan</h2>
<form class="col-5" method="post" id="create" action="/income">
    @csrf
    <div class="form-group">
    <label for="category">Kategori</label>
    <select class="form-control" name="in_category" id="category">
      @foreach ($categories as $ctg)
      <option value="{{$ctg->id}}">{{$ctg->name}}</option>
      @endforeach
    </select>
    </div>
    <div class="form-group">
      <label for="price">Harga</label>
      <input type="text" class="form-control @error('in_balance') is-invalid @enderror" name="in_balance" id="rupiah" placeholder="Harga" value="{{old('in_balance')}}">
      @error('in_balance')<div class="invalid-feedback">{{ $message }}</div>@enderror
      <small class="form-text text-muted"></small>
    </div>
    <input type="hidden" id="rupiah"/>
    <div class="form-group">
        <label for="info">Information</label>
        <input type="text" class="form-control" name="in_info" id="info" placeholder="Keterangan Tambahan" value="{{old('in_info')}}">
        <small id="info" class="form-text text-muted">(Optional)</small>
    </div>
    <button type="submit" id="submit" class="btn btn-primary">Tambah Data</button>
  </form>
@endsection
@section('script')

@endsection
