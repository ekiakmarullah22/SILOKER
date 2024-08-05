@extends('master.masterHome')

@section('content')

<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gy-5 gx-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-5">
                    <img class="flex-shrink-0 img-fluid border rounded" src="{{ asset('lowongan_pekerjaan/'. $pekerjaan->gambar) }}" alt="{{ $pekerjaan->slug }}" style="width: 80px; height: 80px;">
                    <div class="text-start ps-4">
                        <h3 class="mb-3">{{ $pekerjaan->nama }}</h3>
                        <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $pekerjaan->lokasi->nama_kampung }}, {{ $pekerjaan->lokasi->nama_kecamatan }}</span>
                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{ $pekerjaan->kategori->nama_kategori }}</span>
                        <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>{{ $pekerjaan->besaran_gaji }}</span>
                    </div>
                    <div class="text-end ps-4" style="margin-top: -2.5rem;">
                        <a href="{{ route('home.lamar',$pekerjaan->slug) }}" class="btn btn-success">Lamar Pekerjaan</a>
                    </div>
                </div>

                <div class="mb-5">
                    {!! $pekerjaan->deskripsi !!}
                </div>

            </div>

            <div class="col-lg-4">
                <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                    <h4 class="mb-4">Ringkasan Pekerjaan</h4>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Diterbitkan: {{ $pekerjaan->created_at->diffForHumans() }}</p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Penerbit: {{ $pekerjaan->pemberi_kerja->nama }}</p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Kategori: {{ $pekerjaan->kategori->nama_kategori }}</p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Gaji: {{ $pekerjaan->besaran_gaji }}</p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Lokasi: {{ $pekerjaan->lokasi->nama_kampung }}, {{ $pekerjaan->lokasi->nama_kecamatan }}</p>
                    <p class="m-0"><i class="fa fa-angle-right text-primary me-2"></i>Batas Lamaran: {{ $pekerjaan->batas_lamaran }}</p>
                </div>
                <div class="bg-light rounded p-5 wow slideInUp" data-wow-delay="0.1s">
                    <h4 class="mb-4">Informasi Penerbit</h4>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Nama: {{ $pekerjaan->pemberi_kerja->nama }}</p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>URL: {{ $pekerjaan->pemberi_kerja->url }}</p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Email: {{ $pekerjaan->pemberi_kerja->email }}</p>
                    <p><i class="fa fa-angle-right text-primary me-2"></i>Nomor HP: {{ $pekerjaan->pemberi_kerja->no_hp }}</p>
                    <p class="m-0">{!! $pekerjaan->pemberi_kerja->deskripsi !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Job Detail End -->

@endsection
