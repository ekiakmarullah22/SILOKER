<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilAdmin;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\LowonganPekerjaan;
use App\Models\PemberiKerja;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
//     public function __construct()
// {
//    $this->middleware('auth:admin');
// }
    public function index() {
        $judul = "SILOKER";
        $namaHalaman = "Dashboard Pemberi Kerja";
        $id = Auth::id();
        $profil = ProfilAdmin::where('admin_id', $id)->first();
        $totalProfilAdmin = ProfilAdmin::all();
        $totalAdmin = PemberiKerja::all();
        $totalPemberiKerja = PemberiKerja::all();
        $totalLowonganPekerjaan = LowonganPekerjaan::where('pemberi_kerja_id', '=', Auth::guard('web')->user()->id)->get();
        $totalLokasi = Lokasi::all();
        $totalTipePekerjaan = Kategori::all();

        $idPemberiKerja = Auth::guard('web')->user()->id;
        $dataLowonganPekerjaan = DB::table('lowongan_pekerjaan')->join('pemberi_kerja', 'lowongan_pekerjaan.pemberi_kerja_id', '=', 'pemberi_kerja.id')->join('kategori', 'lowongan_pekerjaan.kategori_id', '=', 'kategori.id')->where('pemberi_kerja_id', '=', $idPemberiKerja)->select("lowongan_pekerjaan.*","lowongan_pekerjaan.nama as nama_lowongan_pekerjaan", "lowongan_pekerjaan.created_at", "pemberi_kerja.nama as nama_pemberi_kerja", "kategori.nama_kategori")->latest()->limit(5)->get();


        // dd($dataLowonganPekerjaan);

        return view('dashboard.index', compact('judul', 'namaHalaman', 'profil', 'totalProfilAdmin', 'totalAdmin', 'totalPemberiKerja', 'totalLowonganPekerjaan', 'totalLokasi', 'totalTipePekerjaan', 'dataLowonganPekerjaan'));
    }

    public function indexAdmin() {
        $judul = "SILOKER | Admin Dashboard Page";
        $namaHalaman = "Dashboard Admin";
        $id = Auth::id();
        $profil = ProfilAdmin::where('admin_id', $id)->first();
        $totalProfilAdmin = ProfilAdmin::all();
        $totalAdmin = Admin::all();
        $totalPemberiKerja = PemberiKerja::all();
        $totalLowonganPekerjaan = LowonganPekerjaan::all();
        $totalLokasi = Lokasi::all();
        $totalTipePekerjaan = Kategori::all();

        return view('dashboard.admin.index', compact('judul', 'namaHalaman', 'profil', 'totalProfilAdmin', 'totalAdmin', 'totalPemberiKerja', 'totalLowonganPekerjaan', 'totalLokasi', 'totalTipePekerjaan'));
    }
}
