@extends('master.masterDashboard')

@section('judul')
    Form Tambah Data Lokasi
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
        <form action="{{ route('lokasi.store') }}" method="POST">
            @csrf
            <div class="row">

                <div class="col-lg-6">
                    <label for="nama_kampung" class="col-md-6 col-form-label">{{ __('Nama Kampung*') }}</label>
                    <input id="nama_kampung" type="text" class="form-control @error('nama_kampung') is-invalid @enderror" name="nama_kampung" value="{{ old('nama_kampung') }}" autocomplete="nama_kampung">

                    @error('nama_kampung')
                    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                </div>
                
                <div class="col-lg-6">
                    <label for="nama_kecamatan" class="col-md-6 col-form-label">{{ __('Nama Kecamatan*') }}</label>
                    <input id="nama_kecamatan" type="text" class="form-control @error('nama_kecamatan') is-invalid @enderror" name="nama_kecamatan" value="{{ old('nama_kecamatan') }}" autocomplete="nama_kecamatan">

                    @error('nama_kecamatan')
                    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
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