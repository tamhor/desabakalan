@extends('layout.master')

@section('title' , 'Laporan Pengeluaran')

@section('content')
<form method="get" action="/report">
    <div class="form-inline justify-content-around">
        <select name="source" class="form-control" id="sumber">
            <option value="1">Pendapatan Asli Desa</option>
            <option value="2">Alokasi Dana Desa</option>
            <option value="3">Dana Desa</option>
            <option value="4">Bagi Hasil Pajak & Restribusi</option>
        </select>
        <label>Dari</label>
        <input class="form-control" type="date"/>
        <label>Sampai</label>
        <input class="form-control" type="date"/>
        <button class="btn btn-primary" type="submit">
            <i class="fa fa-search" aria-hidden="true"></i>
        </button>
    </div>
</form>
<hr/>
<table id="report-table" class="table dt-responsive nowrap" style="width:100%">
    <thead class="thead-dark">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Sumber</th>
        <th scope="col">Kegiatan</th>
        <th scope="col">Uraian</th>
        <th scope="col">Harga</th>
        <th scope="col">Keterangan</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($outcome as $item)
        <tr>
            <td scope="row">{{ $loop->iteration }}</td>
            <td>{{ date('d F y', strtotime($item->created_at)) }}</td>
            <td>{{ $item->source }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->out_description }}</td>
            <td>{{ formatRp($item->out_balance) }}</td>
            <td>{{ $item->out_info }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('script')
<script>
$(document).ready(function() {
    $('#report-table').DataTable({
        "searching": false
        "pagination": false
    });
} );
</script>
@endsection