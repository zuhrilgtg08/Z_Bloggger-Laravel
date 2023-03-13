<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ahmad-Zuhril">
    <title>Z-blog | Dashboard</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/blogging.png') }}" />
    <link href="{{ asset('admin/css/simple-datatables@latest.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/styles.css')}}" rel="stylesheet" />
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- trix-editor -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/trix.css') }}" />
    <style>
      trix-toolbar [data-trix-button-group="file-tools"]{
        display: none;
      }

      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }
    </style>
    @yield('styles')
  </head>
  <body class="sb-nav-fixed">
    @include('layouts.dashboard.partials.header')
    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        @include('layouts.dashboard.partials.sidebar')
      </div>

      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
            @yield('content')
          </div>
        </main>
        <footer class="py-4 mt-auto" style="background-color: #ece7e7;">
          <div class="container-fluid px-4">
            <div class="d-flex justify-content-center small">
              <div class="text-center text-dark">Copyright &copy; Z-Blgger {{ date('Y') }}</div>
            </div>
          </div>
        </footer>
      </div>
    </div>

      <script src="{{ asset('admin/js/jquery-3.6.3.min.js') }}"></script>
      <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('admin/js/scripts.js') }}"></script>
      <script src="{{ asset('admin/js/Chart.min.js') }}"></script>
      <script src="{{ asset('admin/assets/demo/chart-area-demo.js') }}"></script>
      <script src="{{ asset('admin/assets/demo/chart-bar-demo.js') }}"></script>
      <script src="{{ asset('admin/js/simple-datatables@latest.js') }}"></script>
      <script src="{{ asset('admin/js/datatables-simple-demo.js') }}"></script>
      <script src="{{ asset('admin/js/trix.js') }}" type="text/javascript"></script>
      <script src="{{ asset('admin/js/all.js') }}"></script>
      <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
      @yield('script')
  </body>
</html>
