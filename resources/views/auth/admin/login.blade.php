<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SILOKER | Admin Login Page</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('master/src/assets/images/logos/favicon.ico') }}" />
  <link rel="stylesheet" href="{{ asset('master/src/assets/css/styles.min.css') }}" />
</head>

<body>

@if (session('error'))

<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
    
@endif

<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
data-sidebar-position="fixed" data-header-position="fixed">
<div
  class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
  <div class="d-flex align-items-center justify-content-center w-100">
    <div class="row justify-content-center w-100">
      <div class="col-md-8 col-lg-6 col-xxl-3">
        <div class="card mb-0">
          <div class="card-body">
            <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
              <img src="{{ asset('master/src/assets/images/logos/logo.png') }}" width="180" alt="">
            </a>
            <p class="text-center">Temukan Pekerjaan Impian Anda</p>
            <form action="" method="POST">
                @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" name="email" value="{{ old('email') }}" autocomplete="email">

                @error('email')
                    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="current-password">

                @error('password')
                    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
              </div>
              <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="form-check">
                  <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                  <label class="form-check-label text-dark" for="flexCheckChecked">
                    Remeber this Device
                  </label>
                </div>
                @if (Route::has('password.request'))
                    <a class="text-primary fw-bold" href="{{ route('password.request') }}">Forgot Password ?</a>
                @endif
                
              </div>
              <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
                {{ __('Login') }}
            </button>
              <div class="d-flex align-items-center justify-content-center">
                <p class="fs-4 mb-0 fw-bold">Baru di SILOKER ?</p>
                <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">Buat Akun</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script src="{{ asset('master/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('master/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
