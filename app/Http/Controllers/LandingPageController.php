<?php

namespace App\Http\Controllers;

use App\Models\r_tema;
use App\Models\t_infografis;
use App\Models\t_linkterkait;
use App\Models\t_produk;
use App\Models\t_survey;
use App\Models\t_tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    /**
     * fungsi yang digunakan untuk mengambil semua tema dengan memanggil model r_tema
     */
    public function getTemaPeraturan()
    {
        return r_tema::all();
    }

    /**
     * fungsi yang digunakan untuk mengambil data tentang dengan memanggil model t_tentang
     */
    public function getTentang()
    {
        return t_tentang::with('verifikasiTentangJDIHLatest')
            ->whereHas('verifikasiTentangJDIHLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '5');
            })->first();
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman beranda dan mengambil data peraturan sebanyak 3 data yang terakhir kali di tambahkan, infografis, dan link terkait
     */
    public function beranda()
    {
        /**
         * mengambil data peraturan dengan menggunakan model t_produk yang memiliki produk_jenis_id 1 (peraturan)
         */
        $peraturans = t_produk::where('produk_jenis_id', '1')
            ->orderBy('produk_id', 'desc')
            ->with('verifikasiPeraturanLatest')
            ->with('verifikasiPeraturanLatest')
            ->whereHas('verifikasiPeraturanLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '5');
            })
            ->limit(3)->get();

        /**
         * mengambil semua data infografis dengan menggunakan model t_infografis
         */
        $infografis = t_infografis::with('verifikasiInfografisLatest')
            ->whereHas('verifikasiInfografisLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '5');
            })
            ->get();

        /**
         * mengambil semua data link terkait dengan menggunakan model t_linkterkait
         */
        $linkterkait = t_linkterkait::with('verifikasiLinkTerkaitLatest')
            ->whereHas('verifikasiLinkTerkaitLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '5');
            })
            ->get();


        $peraturan = t_produk::where('produk_jenis_id', '1')
            ->orderBy('produk_id', 'desc')
            ->with('verifikasiPeraturanLatest')
            ->with('verifikasiPeraturanLatest')
            ->whereHas('verifikasiPeraturanLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '5');
            })
            ->count();

        $artikel = t_produk::where('produk_jenis_id', '4')
            ->orderBy('produk_id', 'desc')
            ->with('verifikasiPeraturanLatest')
            ->with('verifikasiPeraturanLatest')
            ->whereHas('verifikasiPeraturanLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '5');
            })
            ->count();

        return view('landingPage.page.beranda', [
            'peraturans' => $peraturans,
            'tema' => $this->getTemaPeraturan(),
            'infografis' => $infografis,
            'linkterkait' => $linkterkait,
            'count_perturan_verif' => $peraturan,
            'count_artikel_verif' => $artikel,
        ]);
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman tentang kami
     */
    public function landasan()
    {
        return view('landingPage.page.tentangkami.landasan', [
            'tema' => $this->getTemaPeraturan(),
            'tentang' => $this->getTentang()
        ]);
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman visi misi
     */
    public function visiMisi()
    {
        return view('landingPage.page.tentangkami.visimisi', [
            'tema' => $this->getTemaPeraturan(),
            'tentang' => $this->getTentang()
        ]);
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman struktur organisasi
     */
    public function strukturOrganisasi()
    {
        return view('landingPage.page.tentangkami.strukturorganisasi', [
            'tema' => $this->getTemaPeraturan(),
            'tentang' => $this->getTentang()
        ]);
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman SOP
     */
    public function sop()
    {
        return view('landingPage.page.tentangkami.sop', [
            'tema' => $this->getTemaPeraturan(),
            'tentang' => $this->getTentang(),
        ]);
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman dokumen hukum peraturan berdasarkan tema 
     */
    public function dokumenHukumPeraturan($id)
    {
        /**
         * mengambil data peraturan dengan menggunakan model t_produk yang memiliki produk_jenis_id 1 (peraturan) dan memiliki tema_id yang sesuai dengan parameter id
         */
        $produk = t_produk::where('produk_jenis_id', '1')
            ->whereHas('temas', function ($query) use ($id) {
                $query->where('r_tema.tema_id', $id);
            })
            ->whereHas('verifikasiPeraturanLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '5');
            })
            ->with(['temas', 'verifikasiPeraturanLatest'])
            ->orderBy('produk_id', 'desc')
            ->paginate(10);

        return view('landingPage.page.dokumenhukum.index', [
            'tema' => $this->getTemaPeraturan(),
            'produks' => $produk,
            'route' => 'fp-dokumenhukum-peraturan-detail',
            'title' => 'Peraturan'
        ]);
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman dokumen hukum peraturan dan mengambil semua peraturan
     */
    public function dokumenHukumAllPeraturan()
    {
        /**
         * mengambil data peraturan dengan menggunakan model t_produk yang diurutkan secara descending berdasarkan produk_id dan di paginasi sebanyak 10 data
         */
        $produk = t_produk::orderBy('produk_id', 'desc')
            ->with('verifikasiPeraturanLatest')
            ->whereHas('verifikasiPeraturanLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '5');
            })
            ->paginate(10);

        // return response()->json($produk);

        return view('landingPage.page.dokumenhukum.index', [
            'tema' => $this->getTemaPeraturan(),
            'produks' => $produk,
            'route' => 'fp-dokumenhukum-peraturan-detail',
            'title' => 'Peraturan'
        ]);
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman detail dokumen hukum peraturan berdasarkan id
     */
    public function dokumenHukumPeraturanDetail($id)
    {
        /**
         * mengambil data peraturan dengan menggunakan model t_produk yang memiliki produk_id yang sesuai dengan parameter id. Data tersebut juga diambil dengan relasi temas, clusters, dan verifikasiPeraturans
         */
        $produk = t_produk::where('produk_id', $id)
            ->with(['temas', 'clusters'])
            ->with('verfikasiPeraturans')
            ->first();

        return view('landingPage.page.dokumenhukum.peraturan.detail', [
            'tema' => $this->getTemaPeraturan(),
            'produk' => $produk,
        ]);
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman dokumen hukum putusan dengan identifikasi produk_jenis_id 2 (putusan)
     */
    public function dokumenHukumPutusan()
    {
        /**
         * mengambil data peraturan dengan menggunakan model t_produk yang memiliki produk_jenis_id 2 (putusan). Data tersebut juga diambil dengan relasi temas dan diurutkan secara descending berdasarkan produk_id dan di paginasi sebanyak 10 data
         */
        $produk = t_produk::where('produk_jenis_id', '2')
            ->with('temas')
            ->with('verifikasiPeraturanLatest')
            ->whereHas('verifikasiPeraturanLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '5');
            })
            ->orderBy('produk_id', 'desc')
            ->paginate(10);

        return view('landingPage.page.dokumenhukum.index', [
            'tema' => $this->getTemaPeraturan(),
            'produks' => $produk,
            'route' => 'fp-dokumenhukum-putusan-detail',
            'title' => 'Putusan'
        ]);
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman detail dokumen hukum putusan berdasarkan id
     */
    public function dokumenHukumPutusanDetail($id)
    {
        /**
         * mengambil data peraturan dengan menggunakan model t_produk yang memiliki produk_id yang sesuai dengan parameter id. Data tersebut juga diambil dengan relasi temas, clusters, dan verifikasiPeraturans
         */
        $produk = t_produk::where('produk_id', $id)
            ->with(['temas', 'clusters'])
            ->with('verfikasiPeraturans')
            ->first();

        return view('landingPage.page.dokumenhukum.putusan.detail', [
            'tema' => $this->getTemaPeraturan(),
            'produk' => $produk,
        ]);
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman dokumen hukum monografi dengan identifikasi produk_jenis_id 3 (monografi)
     */
    public function dokumenHukumMonografi()
    {
        /**
         * mengambil data peraturan dengan menggunakan model t_produk yang memiliki produk_jenis_id 3 (monografi). Data tersebut juga diambil dengan relasi temas dan diurutkan secara descending berdasarkan produk_id dan di paginasi sebanyak 10 data
         */
        $produk = t_produk::where('produk_jenis_id', '3')
            ->with('temas')
            ->with('verifikasiPeraturanLatest')
            ->whereHas('verifikasiPeraturanLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '5');
            })
            ->orderBy('produk_id', 'desc')
            ->paginate(10);

        return view('landingPage.page.dokumenhukum.index', [
            'tema' => $this->getTemaPeraturan(),
            'produks' => $produk,
            'route' => 'fp-dokumenhukum-monografi-detail',
            'title' => 'Monografi'
        ]);
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman detail dokumen hukum monografi berdasarkan id 
     */
    public function dokumenHukumMonografiDetail($id)
    {
        /**
         * mengambil data peraturan dengan menggunakan model t_produk yang memiliki produk_id yang sesuai dengan parameter id. Data tersebut juga diambil dengan relasi temas, clusters, dan verifikasiPeraturans
         */
        $produk = t_produk::where('produk_id', $id)
            ->with(['temas', 'clusters'])
            ->with('verfikasiPeraturans')
            ->first();

        return view('landingPage.page.dokumenhukum.monografi.detail', [
            'tema' => $this->getTemaPeraturan(),
            'produk' => $produk,
        ]);
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman dokumen hukum artikel dengan identifikasi produk_jenis_id 4 (artikel)
     */
    public function dokumenHukumArtikel()
    {
        $produk = t_produk::where('produk_jenis_id', '4')
            ->with('temas')
            ->with('verifikasiPeraturanLatest')
            ->whereHas('verifikasiPeraturanLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '5');
            })
            ->orderBy('produk_id', 'desc')
            ->paginate(10);

        return view('landingPage.page.dokumenhukum.index', [
            'tema' => $this->getTemaPeraturan(),
            'produks' => $produk,
            'route' => 'fp-dokumenhukum-artikel-detail',
            'title' => 'Aritkel'
        ]);
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman detail dokumen hukum artikel berdasarkan id
     */
    public function dokumenHukumArtikelDetail($id)
    {
        /**
         * mengambil data peraturan dengan menggunakan model t_produk yang memiliki produk_id yang sesuai dengan parameter id. Data tersebut juga diambil dengan relasi temas, clusters, dan verifikasiPeraturans
         */
        $produk = t_produk::where('produk_id', $id)
            ->with(['temas', 'clusters'])
            ->with('verfikasiPeraturans')
            ->first();

        return view('landingPage.page.dokumenhukum.artikel.detail', [
            'tema' => $this->getTemaPeraturan(),
            'produk' => $produk,
        ]);
    }

    /**
     * fungsi yang digunakan untuk menyimpan survey
     */
    public function storeSurvey(Request $request)
    {
        DB::beginTransaction();
        try {
            t_survey::create($request->all());

            DB::commit();

            return redirect()->back()->with('success', 'Terimakasih atas partisipasi anda dalam mengisi survey ini');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengisi survey');
        }
    }
}
