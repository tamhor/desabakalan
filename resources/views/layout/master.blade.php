<!doctype html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap4.min.css') }}">

    <style>
    .navbar .dropdown:hover .dropdown-menu {
      display: block;
    }
    </style>

  </head>
  <body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
      <a class="navbar-brand" href="/">Nalakab</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/category') }}">KEGIATAN</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/silpa') }}">SILPA</a>
          </li>
        </ul>
        <ul class="form-inline my-2 my-lg-0">
              {{-- <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="{{ url('/outcome/source/0') }}" id="navbarDropdown" role="button">
                  Sumber
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ url('/outcome/source/1') }}" title="Pendapatan Asli Desa">Pendapatan Asli Desa</a>
                  <a class="dropdown-item" href="{{ url('/outcome/source/2') }}" title="Alokasi Dana Desa">Alokasi Dana Desa</a>
                  <a class="dropdown-item" href="{{ url('/outcome/source/3') }}" title="Hasil Pajak">Dana Desa</a>
                  <a class="dropdown-item" href="{{ url('/outcome/source/4') }}" title="Hasil Pajak">Bagi Hasil Pajak & Restribusi</a>
                </div>
              </div> --}}
          <a href="{{ url('/report') }}" class="btn btn-success ml-2 my-sm-0">LAPORAN</a>
        </ul>
      </div>
    </nav>
    <div class="container" style="margin-top:60px;">
      <h3 class="my-3 text-center">@yield('title')</h3>
      @yield('content')
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
    <script>
      $(document).ready(function() {
          $('#data-table').DataTable();
      } );
    </script>
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
    </script>
    <script>
    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
      $(".alert").slideUp(500);
    });
    </script>
    @yield('script')

  </body>
</html>
