<a href="/dashboard/lowongan-pekerjaan/{{ $model->slug }}/edit" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-success btn-sm edit">
    <span>
        <i class="ti ti-pencil"></i>
    </span>
    Edit
</a>
<a href="#" onclick="deletePemberiKerja(this)" class="btn btn-danger btn-sm" data-url="{{ route("lowongan_pekerjaan.delete", $model->id) }}" data-redirect="{{ route('lowongan_pekerjaan') }}" data-title="Lowongan Pekerjaan">

    <span>
        <i class="ti ti-trash"></i>
    </span>
    
    Hapus

</a>