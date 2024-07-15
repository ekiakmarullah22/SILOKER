@extends('master.masterHome')

@section('content')

<!-- Header End -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Semua Lowongan Pekerjaan</h1>
    </div>
</div>
<!-- Header End -->

<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Daftar Lowongan Pekerjaan</h1>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                        <h6 class="mt-n1 mb-0">Semua Pekerjaan</h6>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    @forelse ($pekerjaan as $item)

                    <div class="job-item p-4 mb-4">
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid border rounded" src="{{ asset('lowongan_pekerjaan/'.$item->gambar) }}" alt="" style="width: 80px; height: 80px;">
                                <div class="text-start ps-4">
                                    <h5 class="mb-3">{{ $item->nama }}</h5>
                                    <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $item->lokasi->nama_kampung }}, {{ $item->lokasi->nama_kecamatan }}</span>
                                    <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{ $item->kategori->nama_kategori }}</span>
                                    <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>{{ $item->besaran_gaji }}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                <div class="d-flex mb-3">
                                    <a class="btn btn-light btn-square me-3" href="{{ route('home.show', $item->slug) }}"><i class="far fa-heart text-primary"></i></a>
                                    <a class="btn btn-primary" href="{{ route('home.show', $item->slug) }}">Lamar Sekarang</a>
                                </div>
                                <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Batas Lamaran: {{ $item->batas_lamaran }}</small>
                            </div>
                        </div>
                    </div>

                    
                        
                    @empty
                        <p>Data Pencarian Pekerjaan Tidak Ditemukan...</p>
                    @endforelse

                    {{ $pekerjaan->links() }}
                    
                    
                </div>
                
                
            </div>
        </div>
    </div>
</div>

@endsection
