@extends('master.masterDashboard')

@section('judul')
    Data Lowongan Pekerjaan
@endsection

@section('namaHalaman')
<h1>{{ $namaHalaman }}</h1>
@endsection

@section('content')
    <a class="btn btn-primary btn-sm mb-3" href="/dashboard/lowongan-pekerjaan/tambah">
        <span>
          <i class="ti ti-circle-plus"></i>
        </span>
        <span class="hide-menu">Tambah Data Baru</span>
    </a>

<table id="myTable" class="display" style="width:100%">

    <thead>
        <tr>
            <th>No.</th>
            <th>Judul Pekerjaan</th>
            <th>Nama Pemberi Kerja</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        
    </tbody>

</table>

@endsection

@push('scripts')
<script>

    $(document).ready(function() {

        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('lowongan_pekerjaan.data') !!}',
            columns : [
                {
                    data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false
                },
                {
                    data: 'nama_lowongan_pekerjaan', name: 'nama_lowongan_pekerjaan'
                },
                {
                    data: 'nama_pemberi_kerja', name:'nama_pemberi_kerja'
                },
                {
                    data: 'action', name: 'action', orderable:false
                },
            ]
        });

    });
</script>
@endpush
