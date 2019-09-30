@extends('layout.master')

@section('title' , 'Aplikasi Keuangan Desa Bakalan')

@section('content')
<h2 class="display-4 my-3">Form Ubah Kegiatan</h2>
<form class="col-5" method="post" action="/category/{{ $category->id }}">
    @csrf
    @method('patch')
    <div class="form-group">
    <label for="source">Sumber</label>
    <select class="form-control" name="source_id" id="source">
      @foreach ($source as $src)
      <option value="{{$src->id}}" @if ($src->id === $category->source_id)
          selected
      @endif>{{$src->source}}</option>
      @endforeach
    </select>
    </div>
    <div class="form-group">
      <label for="category">Kegiatan</label>
      <input class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Kegiatan" value="{{ $category->name }}">
      @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror      
    </div>
    <div class="form-group">
      <label for="price">Harga</label>
      <input class="form-control @error('balance') is-invalid @enderror" id="rupiah" name="balance" placeholder="Harga" value="{{ formatRp($category->balance) }}">
      @error('balance')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn btn-primary">Ubah Data</button>
  </form>
@endsection
@section('script')

@endsection