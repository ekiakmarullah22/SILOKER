<a href="/dashboard/pemberi-kerja/{{ $model->slug }}/edit" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-success btn-sm edit">
    <span>
        <i class="ti ti-pencil"></i>
    </span>
    Edit
</a>
<a href="#" onclick="deletePemberiKerja(this)" class="btn btn-danger btn-sm" data-url="{{ route("pemberi_kerja.delete", $model->id) }}" data-redirect="{{ route('pemberi_kerja') }}" data-title="Pemberi Kerja">

    <span>
        <i class="ti ti-trash"></i>
    </span>
    
    Hapus

</a>