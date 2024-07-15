@extends('master.masterDashboard')

@section('judul')
    Form Edit Data Lowongan Pekerjaan
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
        <form action="{{ route('lowongan_pekerjaan.update', $lowongan_pekerjaan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-4">
                    <label for="nama" class="col-md col-form-label">{{ __('Judul Lowongan Pekerjaan*') }}</label>
                    <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $lowongan_pekerjaan->nama ?? '' }}" autocomplete="nama">

                    @error('nama')
                    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                </div>

                <div class="col-lg-4">
                    <label for="batas_lamaran" class="col-md col-form-label">{{ __('Batas Lamaran Pekerjaan*') }}</label>
                    <input id="batas_lamaran" type="text" class="form-control @error('batas_lamaran') is-invalid @enderror" name="batas_lamaran" value="{{ $lowongan_pekerjaan->batas_lamaran ?? '' }}" autocomplete="batas_lamaran">

                    @error('batas_lamaran')
                    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                </div>

                <div class="col-lg-4">
                    <label for="besaran_gaji" class="col-md col-form-label">{{ __('Besaran Gaji*') }}</label>
                    <input id="besaran_gaji" type="text" class="form-control @error('besaran_gaji') is-invalid @enderror" name="besaran_gaji" value="{{ $lowongan_pekerjaan->besaran_gaji ?? '' }}" autocomplete="besaran_gaji">

                    @error('besaran_gaji')
                    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                </div>

                

                <div class="col-lg-6">
                    <label for="lokasi_id" class="col-md col-form-label">{{ __('Lokasi Pekerjaan*') }}</label>
                    <a href="{{ route('lokasi.create') }}" class="btn btn-primary btn-sm" target="__blank" title="Tambah Data Baru">
                        <span>
                            <i class="ti ti-circle-plus"></i>
                        </span>
                    </a>
                    <select class="form-select form-select mb-3" aria-label=".form-select-lg example" name="lokasi_id">

                        <option selected disabled>Pilih Lokasi Pekerjaan</option>
                        @forelse ($lokasi as $item)
                        @if ($item->id === $lowongan_pekerjaan->lokasi_id)
                        <option value="{{ $item->id }}" selected>{{ $item->nama_kampung }}</option>
                        @endif
                        <option value="{{ $item->id }}">{{ $item->nama_kampung }}</option>
                        @empty
                        <option value="">Data Lokasi Tidak Ditemukan...</option>
                        @endforelse

                    </select>

                    @error('lokasi_id')
                    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror

                </div>

                <div class="col-lg-6">
                    <label for="kategori_id" class="col-md col-form-label">{{ __('Tipe Pekerjaan*') }}</label>
                    <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm" target="__blank" title="Tambah Data Baru">
                        <span>
                            <i class="ti ti-circle-plus"></i>
                        </span>
                    </a>
                    <select class="form-select form-select mb-3" aria-label=".form-select-lg example" name="kategori_id">

                        <option selected disabled>Pilih Tipe Pekerjaan</option>
                        @forelse ($tipePekerjaan as $tp)
                        @if ($tp->id === $lowongan_pekerjaan->kategori_id)
                        <option value="{{ $tp->id }}" selected>{{ $tp->nama_kategori }}</option>
                        @endif
                        <option value="{{ $tp->id }}">{{ $tp->nama_kategori }}</option>
                        @empty
                        <option value="">Data Tipe Pekerjaan Tidak Ditemukan...</option>
                        @endforelse

                    </select>

                    @error('kategori_id')
                    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror

                </div>

                

                <div class="col-lg-12">
                    <label for="gambar" class="col-md col-form-label">{{ __('Gambar*') }}</label>
                    @if($lowongan_pekerjaan->gambar)
                    <img src="{{ asset('lowongan_pekerjaan/'.$lowongan_pekerjaan->gambar) }}" class="img-thumbnail d-block my-3" alt="{{ $lowongan_pekerjaan->slug }}" width="250" height="250">
                    <input class="form-control" type="file" id="gambar" name="gambar">
                    @endif

                    @error('gambar')
                    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                </div>

                <div class="col-lg-12 mb-3">
                    <label for="deskripsi" class="col-md col-form-label">{{ __('Deskripsi*') }}</label>
                    <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control" id="text-area">{{ $lowongan_pekerjaan->deskripsi }}</textarea>

                    @error('deskripsi')
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                </div>
                
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: #5D87FF !important; float:right !important;">Simpan<i class="ti ti-brand-telegram mx-2"></i></button>
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