@extends('layout.master')

@section('title' , 'Sisa Lebih Pembiayaan Anggaran (SILPA)')

@section('content')

<table id="data-table" class="table dt-responsive nowrap" style="width:100%">
  <thead class="thead-light">
    <tr>
      <th scope="col">NO</th>
      <th scope="col">SUMBER</th>
      <th scope="col">KEGIATAN</th>
      <th scope="col">RAB</th>
      <th scope="col">SILPA</th>
      <th scope="col">KETERANGAN</th>
      <th scope="col">DETAILS</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($silpa as $item)
      <tr>
          <td scope="row">{{ $loop->iteration }}</td>
          <td>{{ $item->source }}</td>
          <td>{{ $item->name }}</td>
          <td>{{ formatRp($item->balance) }}</td>
          <td>{{ formatRp($item->outcome) }}</td>
          <td>{{ $item->info }}</td>
          <td>
            <a href="" class="badge badge-info">Details</a>
          </td>
      </tr>
      @endforeach
  </tbody>
</table>
@endsection
@section('script')
@endsection