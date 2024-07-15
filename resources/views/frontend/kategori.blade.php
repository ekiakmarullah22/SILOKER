@extends('master.masterHome')

@section('content')

<!-- Category Start -->
<!-- Header End -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
    <div class="container my-5 pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Kategori Pekerjaan</h1>
        
    </div>
</div>
<!-- Header End -->

<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Cari Pekerjaan Berdasarkan Kategori</h1>
        <div class="row g-4">
            @forelse ($kategori as $item)

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a class="cat-item rounded p-4" href="{{ route('home.pekerjaan.kategori', $item->id) }}">
                    <i class="fa fa-3x fa-clock text-primary mb-4"></i>
                    <h6 class="mb-3">{{ $item->nama_kategori }}</h6>
                </a>
            </div>
                
            @empty
                <p>Data Kategori Tidak Ditemukan...</p>
            @endforelse
            
            
            
            
            
            
            
            {{ $kategori->links() }}
        </div>
    </div>
</div>
<!-- Category End -->

@endsection