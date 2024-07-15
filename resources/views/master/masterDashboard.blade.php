<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $judul }}</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('master/src/assets/images/logos/favicon.ico')}}" />
  <link rel="stylesheet" href="{{ asset('master/src/assets/css/styles.min.css')}}" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" >

    {{-- FRONT END STYLE --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('jobentry-1.0.0/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('jobentry-1.0.0/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('jobentry-1.0.0/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('jobentry-1.0.0/css/style.css')}}" rel="stylesheet">
  @stack('style')
  <style>
    a {
      text-decoration:none !important;
    }
  </style>
</head>

<body>
@if (session('success'))
<div class="swal" data-swal="{{ session('success') }}"></div>
@endif

  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('master.masterDashboardSidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('master.masterDashboardTopMenu')
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                @yield('namaHalaman')
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4 text-left">@yield('judul')</h5>
                @yield('content')
              </div>
            </div>
          </div>
        </div>
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('master/src/assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('master/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('master/src/assets/js/sidebarmenu.js')}}"></script>
  <script src="{{ asset('master/src/assets/js/app.min.js')}}"></script>
  <script src="{{ asset('master/src/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{ asset('master/src/assets/libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="{{ asset('master/src/assets/js/dashboard.js')}}"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    let swal = $(".swal").data("swal");

    if(swal) {
      Swal.fire({
                  position: "top-end",
                  icon: "success",
                  title: swal,
                  showConfirmButton: false,
                  timer: 2500
                });
    }
  </script>
  <script>
    function deletePemberiKerja(e) {
      let url = e.getAttribute('data-url');
      let urlRedirect = e.getAttribute('data-redirect');
      let title = e.getAttribute('data-title');

      Swal.fire({
        title:"Hapus Data " + title + " ?",
        text:"Data yang sudah dihapus tidak dapat dikembalikan",
        icon:"warning",
        showCancelButton:true,
        confirmButtonColor:"#d33",
        cancelButtonColor:"#3085d6",
        confirmButtonText:"Hapus",
        canceButtonText:"Batal",
      }).then((result)=>{
        if(result.value) {
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
            },
            type:"DELETE",
            url:url,
            dataType:"json",
            success: function(response) {

              Swal.fire({
                position:"top-end",
                title:"Success",
                text:response.message,
                icon:"success",
                showConfirmButton: false,
                timer: 2500
              }).then((result) => {
                window.location.href=urlRedirect;
              })

            }, error: function(xhr, ajaxOptions, thrownError) {
              console.log(thrownError);
            }
          });
        }
      })
    }
  </script>
  @stack('scripts')
</body>

</html>