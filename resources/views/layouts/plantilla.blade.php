<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Font Awesome -->
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('template/vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{ asset('template/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{ asset('template/vendors/css/vendor.bundle.addons.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('template/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('template/css/estilos.css')}}">

  <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/responsive.dataTables.min.css') }}">
  @stack('styles')
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/logo.png')}}" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
        @include('partials.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
        @include('partials.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper fondocolor">
            @include('partials.alert')
            @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © {{date('Y') }}
              <a href="http://www.bootstrapdash.com/" target="_blank">Sanna</a>. Todos los derechos reservados.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Mereces una vida Sanna
              <i class="mdi mdi-heart text-danger"></i>
            </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->

  @include('sweet::alert')
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('template/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('template/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('template/js/off-canvas.js') }}"></script>
  <script src="{{ asset('template/js/misc.js') }}"></script>
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>

  <script src="{{ asset('js/form.js') }}"></script>
  @stack('scripts')
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->


</body>

</html>
