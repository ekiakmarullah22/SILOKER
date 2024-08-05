@extends('master.masterHome')

@section('content')


        <!-- Carousel Start -->
        <div class="container-fluid p-0">
            <div class="owl-carousel header-carousel position-relative">
                @forelse ($dataSlider as $data)

                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{asset('lowongan_pekerjaan/'.$data->gambar)}}" alt="{{ $data->slug }}" style="max-width: 1366px !important; height:768px">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">{{ $data->nama_lowongan_pekerjaan }}</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">{{ $data->nama_pemberi_kerja }}</p>
                                    <a href="{{ route('home.show', $data->slug) }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Lamar Pekerjaan</a>
                                    <a href="{{ route('home.pekerjaan') }}" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Lebih Banyak Pekerjaan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                @empty

                <p>Data Lowongan Pekerjaan Tidak Ditemukan</p>
                    
                @endforelse
                
                
            </div>
        </div>
        <!-- Carousel End -->


        <!-- Search Start -->
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <form action="cari">
                                <input type="text" class="form-control border-0" placeholder="Keyword" name="search"/>

                                
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0" name="category">
                                    <option selected disabled>Pilih Kategori</option>
                                    @forelse ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                    @empty
                                        <p>Data Kategori Tidak Ditemukan...</p>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0" name="location">
                                    <option selected disabled>Pilih Lokasi</option>
                                    @forelse ($lokasi as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kampung }}</option>
                                    @empty
                                        <p>Data Lokasi Tidak Ditemukan...</p>
                                    @endforelse
                                    
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark border-0 w-100">Search</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- Search End -->


        <!-- Category Start -->
        
        <!-- Category End -->


        <!-- About Start -->
        
        <!-- About End -->


        <!-- Jobs Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Lowongan Pekerjaan</h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                                <h6 class="mt-n1 mb-0">Semua Lowongan Pekerjaan</h6>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                                <h6 class="mt-n1 mb-0">Lowongan Pekerjaan Dari Instagram</h6>
                            </a>
                        </li>
                            
            
                    </ul>
                    <div class="tab-content">

                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        @forelse ($dataLowonganPekerjaan as $dataLoker)

                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded" src="{{asset('lowongan_pekerjaan/'.$dataLoker->gambar_lowongan_pekerjaan)}}" alt="" style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3">{{ $dataLoker->nama_lowongan_pekerjaan }}</h5>
                                        <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $dataLoker->nama_kampung }}, {{ $dataLoker->nama_kecamatan }}</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{ $dataLoker->nama_kategori }}</span>
                                        <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>{{ $dataLoker->besaran_gaji_lowongan_pekerjaan }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href="{{ route('home.show', $dataLoker->slug) }}"><i class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="{{ route('home.show', $dataLoker->slug) }}">Lamar Sekarang</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Batas Lamaran: {{ $dataLoker->batas_lamaran_pekerjaan }}</small>
                                </div>
                            </div>
                        </div>
                            
                        @empty
                            <p>Data Lowongan Pekerjaan Tidak Ditemukan...</p>
                        @endforelse
                        
                        <a class="btn btn-primary py-3 px-5" href="{{ route('home.pekerjaan') }}">Temukan Lebih Banyak Pekerjaan</a>
                    </div>
                        

                    <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="job-item p-4 mb-4">

                            <div data-behold-id="6HF8q1OCHzrZ2RJpzFuO"></div>
                            <script>
                            (() => {
                                const d=document,s=d.createElement("script");s.type="module";
                                s.src="https://w.behold.so/widget.js";d.head.append(s);
                            })();
                            </script>

                        </div>
                        
                        <a class="btn btn-primary py-3 px-5 my-4" href="{{ route('home.pekerjaan') }}">Temukan Lebih Banyak Pekerjaan</a>
                    </div>
                        

                        
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Jobs End -->


        <!-- Testimonial Start -->
        
        <!-- Testimonial End -->
@endsection
        

        