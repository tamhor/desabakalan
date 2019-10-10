@extends('layout.master')

@section('title', 'Daftar Kegiatan')
    
@section('content')
<span class="form-inline my-2 d-flex justify-content-between">
    <button class="btn btn-primary my-2" data-toggle="modal" data-target="#CreateData">Buat Kegiatan Baru</button>
    
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</span>

<table id="data-table" class="table dt-responsive nowrap" style="width:100%">
<thead class="thead-dark">
  <tr>
    <th scope="col">No</th>
    <th scope="col">Sumber</th>
    <th scope="col">Kegiatan</th>
    <th scope="col">RAB</th>
    <th scope="col">Aksi</th>
  </tr>
</thead>
<tbody>
    @foreach ($category as $item)
    <tr>
        <td scope="row">{{ $loop->iteration }}</td>
        <td>{{ $item->source->source }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ formatRp($item->balance) }}</td>
        <td>
            <a href="{{ url('category/'.$item->id.'/edit') }}" class="badge badge-success" title="Ubah data">
                <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
            <a href="#" data-target="#HapusData" class="badge badge-danger deleteKegiatan" data-toggle="modal" data-id="{{ $item->id }}" title="Hapus data">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
            <a href="{{ url('/category/show/'.$item->id) }}" class="badge badge-info" title="Detail data">
                <i class="fa fa-search" aria-hidden="true"></i>
            </a>
            <a href="#" class="badge badge-secondary" data-toggle="modal" title="Laporan">
                <i class="fa fa-print" aria-hidden="true"></i>
            </a>
        </td>
    </tr>
    @endforeach
</tbody>
</table>

<div class="modal fade" id="CreateData" tabindex="-1" role="dialog" aria-labelledby="CreateDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="CreateDataLabel">Buat Kegiatan Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="{{ action('CategoriesController@store')}}">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="source">Sumber</label>
                    <select class="form-control" name="source_id" id="source">
                      @foreach ($source as $src)
                      <option value="{{$src->id}}">{{$src->source}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Kegiatan</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="description" placeholder="Uraian kegiatan" value="{{old('name')}}">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="price">Rencana Anggaran Belanja</label>
                    <input type="text" class="form-control @error('balance') is-invalid @enderror" name="balance" id="rupiah" placeholder="Harga" value="{{old('balance')}}">
                    @error('balance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="form-text text-muted"></small>
                </div>
                <button type="submit" id="submit" class="btn btn-primary">Tambah Data</button>
            </div>
        </form>
        </div>
    </div>
</div>

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
    $(document).on('click', '.deleteKegiatan', function(){
        var data_id = $(this).data("id");
        var APP_URL = {!! json_encode(url('/')) !!};
        $('#FormHapus').attr('action', APP_URL+'/category/'+data_id);
    });
</script>
@endsection