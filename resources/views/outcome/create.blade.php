@extends('layout.master')

@section('title' , 'Aplikasi Keuangan Desa Bakalan')

@section('content')
<h2 class="display-4 my-3">Form Tambah Data Pengeluaran</h2>
<form class="col-5" method="post" id="create" action="/outcome">
    @csrf
    <div class="form-group">
    <label for="category">Kategori</label>
    <select class="form-control" name="out_category" id="category">
      @foreach ($categories as $ctg)
      <option value="{{$ctg->id}}">{{$ctg->name}}</option>
      @endforeach
    </select>
    </div>
    <div class="form-group">
      <label for="description">Kegiatan</label>
      <input type="text" class="form-control @error('out_description') is-invalid @enderror" name="out_description" id="description" placeholder="Uraian kegiatan" value="{{old('out_description')}}">
        @error('out_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
      <label for="price">Harga</label>
      <input type="text" class="form-control @error('out_balance') is-invalid @enderror" name="out_balance" id="rupiah" placeholder="Harga" value="{{old('out_balance')}}">
      @error('out_balance')<div class="invalid-feedback">{{ $message }}</div>@enderror
      <small class="form-text text-muted"></small>
    </div>
    <input type="hidden" id="rupiah"/>
    <div class="form-group">
        <label for="info">Information</label>
        <input type="text" class="form-control" name="out_info" id="info" placeholder="Keterangan Tambahan" value="{{old('out_info')}}">
        <small id="info" class="form-text text-muted">(Optional)</small>
    </div>
    <button type="submit" id="submit" class="btn btn-primary">Tambah Data</button>
  </form>
@endsection
@section('script')
  <script>
    var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
		}
    $('#create').submit(function(){
      // $('#submit').on('click', function(){
      var rupiah = document.getElementById('rupiah');
      rep = parseInt(rupiah.value.replace(/,.*|[^0-9]/g, ''), 10);
      return rep;
      // console.log(rep);
    });
  </script>
@endsection
