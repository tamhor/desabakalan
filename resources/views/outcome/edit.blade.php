@extends('layout.master')

@section('title' , 'Aplikasi Keuangan Desa Bakalan')

@section('content')
<h2 class="display-4 my-3">Form Ubah Data Pengeluaran</h2>
<form class="col-5" method="post" action="/outcome/{{ $outcome->id }}">
    @csrf
    @method('patch')
    <div class="form-group">
    <label for="category">Kategori</label>
    <select class="form-control" name="out_category" id="category">
      @foreach ($categories as $ctg)
      <option value="{{$ctg->id}}" @if ($ctg->id === $outcome->out_category)
          selected
      @endif>{{$ctg->name}}</option>
      @endforeach
    </select>
    </div>
    <div class="form-group">
      <label for="description">Kegiatan</label>
    <input type="text" class="form-control @error('out_description') is-invalid @enderror" name="out_description" id="description" placeholder="Uraian kegiatan" value="{{ $outcome->out_description }}">
        @error('out_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
      <label for="price">Harga</label>
      <input class="form-control @error('out_balance') is-invalid @enderror" id="rupiah" name="out_balance" placeholder="Harga" value="{{ $outcome->out_balance }}">
      @error('out_balance')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
        <label for="info">Information</label>
        <input type="text" class="form-control" name="out_info" id="info" placeholder="Keterangan Tambahan" value="{{ $outcome->out_info }}">
        <small id="info" class="form-text text-muted">(Optional)</small>
        </div>
    <button type="submit" class="btn btn-primary">Ubah Data</button>
  </form>
@endsection
@section('script')

@endsection