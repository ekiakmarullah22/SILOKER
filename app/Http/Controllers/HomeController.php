<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\LowonganPekerjaan;
use App\Models\TipePekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dataLowonganPekerjaan = DB::table('lowongan_pekerjaan')->join('pemberi_kerja', 'lowongan_pekerjaan.pemberi_kerja_id', '=', 'pemberi_kerja.id')->join('lokasi', 'lowongan_pekerjaan.lokasi_id', '=', 'lokasi.id')->join('kategori', 'lowongan_pekerjaan.kategori_id', '=', 'kategori.id')->select("lowongan_pekerjaan.*", "lowongan_pekerjaan.nama as nama_lowongan_pekerjaan", "lowongan_pekerjaan.batas_lamaran as batas_lamaran_pekerjaan", "lowongan_pekerjaan.gambar as gambar_lowongan_pekerjaan", "lowongan_pekerjaan.besaran_gaji as besaran_gaji_lowongan_pekerjaan", "lowongan_pekerjaan.deskripsi as deskripsi_lowongan_pekerjaan", "lowongan_pekerjaan.created_at as tgl_publikasi_lowongan_pekerjaan", "pemberi_kerja.nama as nama_pemberi_kerja", "lokasi.nama_kampung", "lokasi.nama_kecamatan", "kategori.nama_kategori")->limit(5)->latest()->get();

        $dataSlider = DB::table('lowongan_pekerjaan')->join('pemberi_kerja', 'lowongan_pekerjaan.pemberi_kerja_id', '=', 'pemberi_kerja.id')->join('lokasi', 'lowongan_pekerjaan.lokasi_id', '=', 'lokasi.id')->join('kategori', 'lowongan_pekerjaan.kategori_id', '=', 'kategori.id')->select("lowongan_pekerjaan.*", "lowongan_pekerjaan.nama as nama_lowongan_pekerjaan", "lowongan_pekerjaan.batas_lamaran as batas_lamaran_pekerjaan", "lowongan_pekerjaan.gambar as gambar_lowongan_pekerjaan", "lowongan_pekerjaan.besaran_gaji as besaran_gaji_lowongan_pekerjaan", "lowongan_pekerjaan.deskripsi as deskripsi_lowongan_pekerjaan", "lowongan_pekerjaan.created_at as tgl_publikasi_lowongan_pekerjaan", "pemberi_kerja.nama as nama_pemberi_kerja", "lokasi.nama_kampung", "lokasi.nama_kecamatan", "kategori.nama_kategori")->limit(3)->latest()->get();

        $category = Kategori::all();
        $lokasi = Lokasi::all();

        // dd($dataLowonganPekerjaanFullTime);
        return view('frontend.index', compact('dataLowonganPekerjaan', 'dataSlider', 'category', 'lokasi'));
    }

    public function cari(Request $request) {

        $search = $request["search"];
        $category = $request["category"];
        $lokasi = $request["location"];

        

        $dataRaw = DB::table('lowongan_pekerjaan')->join('pemberi_kerja', 'lowongan_pekerjaan.pemberi_kerja_id', '=', 'pemberi_kerja.id')->join('lokasi', 'lowongan_pekerjaan.lokasi_id', '=', 'lokasi.id')->join('kategori', 'lowongan_pekerjaan.kategori_id', '=', 'kategori.id');

        if($request->has("category")){
            $pekerjaan = $dataRaw->where('lowongan_pekerjaan.kategori_id', 'LIKE', "%".$category."%")->select("lowongan_pekerjaan.*", "lowongan_pekerjaan.nama as nama_lowongan_pekerjaan", "lowongan_pekerjaan.batas_lamaran as batas_lamaran_pekerjaan", "lowongan_pekerjaan.gambar as gambar_lowongan_pekerjaan", "lowongan_pekerjaan.besaran_gaji as besaran_gaji_lowongan_pekerjaan", "lowongan_pekerjaan.deskripsi as deskripsi_lowongan_pekerjaan", "lowongan_pekerjaan.created_at as tgl_publikasi_lowongan_pekerjaan", "pemberi_kerja.nama as nama_pemberi_kerja", "lokasi.nama_kampung", "lokasi.nama_kecamatan", "kategori.nama_kategori")->latest()->paginate(5);
        } elseif($request->has("location")) {
            $pekerjaan = $dataRaw->where('lowongan_pekerjaan.lokasi_id', 'LIKE', "%".$lokasi."%")->select("lowongan_pekerjaan.*", "lowongan_pekerjaan.nama as nama_lowongan_pekerjaan", "lowongan_pekerjaan.batas_lamaran as batas_lamaran_pekerjaan", "lowongan_pekerjaan.gambar as gambar_lowongan_pekerjaan", "lowongan_pekerjaan.besaran_gaji as besaran_gaji_lowongan_pekerjaan", "lowongan_pekerjaan.deskripsi as deskripsi_lowongan_pekerjaan", "lowongan_pekerjaan.created_at as tgl_publikasi_lowongan_pekerjaan", "pemberi_kerja.nama as nama_pemberi_kerja", "lokasi.nama_kampung", "lokasi.nama_kecamatan", "kategori.nama_kategori")->latest()->paginate(5);
        }

        $pekerjaan = $dataRaw->where('lowongan_pekerjaan.nama', 'LIKE', "%".$search."%")->select("lowongan_pekerjaan.*", "lowongan_pekerjaan.nama as nama_lowongan_pekerjaan", "lowongan_pekerjaan.batas_lamaran as batas_lamaran_pekerjaan", "lowongan_pekerjaan.gambar as gambar_lowongan_pekerjaan", "lowongan_pekerjaan.besaran_gaji as besaran_gaji_lowongan_pekerjaan", "lowongan_pekerjaan.deskripsi as deskripsi_lowongan_pekerjaan", "lowongan_pekerjaan.created_at as tgl_publikasi_lowongan_pekerjaan", "pemberi_kerja.nama as nama_pemberi_kerja", "lokasi.nama_kampung", "lokasi.nama_kecamatan", "kategori.nama_kategori")->latest()->paginate(5);

        // dd($pekerjaan);
        
        
        

        return view('frontend.cari', compact('pekerjaan'));


    }

    public function pekerjaan() {
        $pekerjaan= LowonganPekerjaan::with(['lokasi', 'kategori'])->latest()->paginate(5);

        // dd($pekerjaan);



        return view('frontend.pekerjaan', compact('pekerjaan'));
    }

    public function show(string $slug) {
        $pekerjaan = LowonganPekerjaan::with(['lokasi', 'kategori', 'pemberi_kerja'])->where('slug', $slug)->first();
        // dd($pekerjaan);

        return view('frontend.detail', compact('pekerjaan'));
    }

    public function kategori() {
        $kategori = DB::table('kategori')->latest()->paginate(8);

        return view('frontend.kategori', compact('kategori'));
    }

    public function pekerjaanByKategori(string $id) {
        $pekerjaan = LowonganPekerjaan::with(['lokasi', 'kategori'])->where('kategori_id', $id)->latest()->paginate(5);

        return view('frontend.pekerjaanByCategory', compact('pekerjaan'));
    }
}
