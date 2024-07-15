<a href="/dashboard/lokasi/{{ $model->slug }}/edit" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-success btn-sm edit">
    <span>
        <i class="ti ti-pencil"></i>
    </span>
    Edit
</a>
<a href="#" onclick="deletePemberiKerja(this)" class="btn btn-danger btn-sm" data-url="{{ route('lokasi.delete', $model->id) }}" data-redirect="{{ route('lokasi.index') }}" data-title="Lokasi">

    <span>
        <i class="ti ti-trash"></i>
    </span>
    
    Hapus

</a>