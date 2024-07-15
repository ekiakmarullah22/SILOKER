@extends('master.masterDashboard')

@push('style')
<style>
    .fs-3 {
        font-size:.75rem !important;
    }
</style>
@endpush

@section('namaHalaman')
<h1>{{ $namaHalaman }}</h1>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-4 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body p-4">
          <div class="mb-4">
            <h5 class="card-title fw-semibold">Aktivitas Terbaru</h5>
          </div>
          <ul class="timeline-widget mb-0 position-relative mb-n5">
            @forelse ($dataLowonganPekerjaan as $item)
            <li class="timeline-item d-flex position-relative overflow-hidden">
                <div class="timeline-time text-dark flex-shrink-0 text-end">{{ date('H:i', strtotime($item->created_at)) }}</div>
                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                  <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                  <span class="timeline-badge-border d-block flex-shrink-0"></span>
                </div>
                <div class="timeline-desc fs-3 text-dark mt-n1">{{ $item->nama_lowongan_pekerjaan }} oleh {{ $item->nama_pemberi_kerja }}</div>
            </li>
            @empty
                <p>Data Aktivitas terbaru tidak ditemukan...</p>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-8 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body p-4">
          <h5 class="card-title fw-semibold mb-4">Postingan Terbaru Anda</h5>
          <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
              <thead class="text-dark fs-4">
                <tr>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Id</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Pemberi Kerja</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Lowongan Pekerjaan</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Waktu Publikasi</h6>
                  </th>
                </tr>
              </thead>
              <tbody>
                @forelse ($dataLowonganPekerjaan as $item)

                <tr>
                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6></td>
                    <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-1">{{ $item->nama_pemberi_kerja }}</h6>
                        <span class="fw-normal">{{ $item->nama_kategori }}</span>                          
                    </td>
                    <td class="border-bottom-0">
                      <p class="mb-0 fw-normal">{{ $item->nama_lowongan_pekerjaan }}</p>
                    </td>
                    <td class="border-bottom-0">
                      <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary rounded-3 fw-semibold">{{ date('Y-m-d', strtotime($item->created_at)) }}</span>
                      </div>
                    </td>
                  </tr>
                    
                @empty
                    <p>Data postingan terbaru tidak ditemukan...</p>
                @endforelse
                                      
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('script')

@endpush