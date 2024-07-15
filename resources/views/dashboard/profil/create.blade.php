@extends('master.masterDashboard')

@section('judul')
    Form Buat Profil
@endsection

@section('namaHalaman')
<h1>{{ $namaHalaman }}</h1>
@endsection

@push('style')
    
@endpush

@push('script')


@endpush

@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <form action="{{ route('profil_admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-lg-3">
                    <label for="email" class="col-md-6 col-form-label">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::guard('web')->user()->email }}" autocomplete="email" disabled>

                    @error('email')
                    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                </div>
                
                <div class="col-lg-3">
                    <label for="nama" class="col-md col-form-label">{{ __('Nama Pemberi Kerja*') }}</label>
                    <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ Auth::guard('web')->user()->nama ?? '' }}" autocomplete="nama">

                    @error('nama')
                    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                </div>

                <div class="col-lg-3">
                    <label for="no_hp" class="col-md-6 col-form-label">{{ __('Nomor HP*') }}</label>
                    <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ Auth::guard('web')->user()->no_hp ?? '' }}" autocomplete="no_hp">

                    @error('no_hp')
                    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                </div>

                <div class="col-lg-3">
                    <label for="link" class="col-md-6 col-form-label">{{ __('Alamat Web*') }}</label>
                    <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ Auth::guard('web')->user()->link ?? '' }}" autocomplete="link">

                    @error('link')
                    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                </div>


                <div class="col-lg">
                    <label for="gambar" class="col-md-4 col-form-label">{{ __('Gambar*') }}</label>
                    @if (Auth::guard('web')->user()->gambar)
                    <img src="{{ asset('profil/'.Auth::guard('web')->user()->gambar) }}" class="img-thumbnail d-block my-3" alt="{{ Auth::guard('web')->user()->slug }}" width="250" height="250">
                    @else
                    
                    @endif
                    <input class="form-control" type="file" id="gambar" name="gambar">

                    @error('gambar')
                    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                </div>

                <div class="col-lg-12 mb-3">
                    <label for="deskripsi" class="col-md col-form-label">{{ __('Deskripsi*') }}</label>
                    <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control" id="text-area">{!! Auth::guard('web')->user()->deskripsi !!}</textarea>

                    @error('deskripsi')
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                </div>
                
            </div>
            <button type="submit" class="btn btn-primary my-4" style="background-color: #5D87FF !important; float:right !important;">Simpan<i class="ti ti-brand-telegram mx-2"></i></button>
          </form>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.tiny.cloud/1/ipgxuvhcxjpgeqpq0yt3d944bfy9em041d6o0fyz5aijin20/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
    selector : "textarea",
    plugins: 'advlist link image lists',
    })
</script>
@endpush