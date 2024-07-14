<?php

namespace App\Http\Controllers;

use App\Models\t_produk;
use App\Models\t_survey;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Fungsi yang digunakan untuk menampilkan halaman dashboard
    public function index()
    {
        // Menghitung jumlah data peraturan yang sudah diverifikasi
        $peraturan = t_produk::where('produk_jenis_id', '1')
            ->orderBy('produk_id', 'desc')
            ->with('verifikasiPeraturanLatest')
            ->with('verifikasiPeraturanLatest')
            ->whereHas('verifikasiPeraturanLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '5');
            })
            ->count();

        // Menghitung jumlah data putusan yang sudah diverifikasi
        $putusan = t_produk::where('produk_jenis_id', '2')
            ->orderBy('produk_id', 'desc')
            ->with('verifikasiPeraturanLatest')
            ->with('verifikasiPeraturanLatest')
            ->whereHas('verifikasiPeraturanLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '5');
            })
            ->count();

        // Menghitung jumlah data monografi yang sudah diverifikasi
        $monografi = t_produk::where('produk_jenis_id', '3')
            ->orderBy('produk_id', 'desc')
            ->with('verifikasiPeraturanLatest')
            ->with('verifikasiPeraturanLatest')
            ->whereHas('verifikasiPeraturanLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '5');
            })
            ->count();

        // Menghitung jumlah data artikel yang sudah diverifikasi
        $artikel = t_produk::where('produk_jenis_id', '4')
            ->orderBy('produk_id', 'desc')
            ->with('verifikasiPeraturanLatest')
            ->with('verifikasiPeraturanLatest')
            ->whereHas('verifikasiPeraturanLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '5');
            })
            ->count();

        $count_peraturan = t_produk::where('produk_jenis_id', '1')->count();
        $count_peraturan_blm_verif = $count_peraturan - $peraturan;
        $count_putusan = t_produk::where('produk_jenis_id', '2')->count();
        $count_putusan_blm_verif = $count_putusan - $putusan;
        $count_monografi = t_produk::where('produk_jenis_id', '3')->count();
        $count_monografi_blm_verif = $count_monografi - $monografi;
        $count_artikel = t_produk::where('produk_jenis_id', '4')->count();
        $count_artikel_blm_verif = $count_artikel - $artikel;

        $survey = t_survey::all();
        return view('users.index', [
            'count_peraturan' => $count_peraturan,
            'count_putusan' => $count_putusan,
            'count_monografi' => $count_monografi,
            'count_artikel' => $count_artikel,
            'count_perturan_verif' => $peraturan,
            'count_perturan_blm_verif' => $count_peraturan_blm_verif,
            'count_putusan_verif' => $putusan,
            'cound_putusan_blm_verif' => $count_putusan_blm_verif,
            'count_monografi_verif' => $monografi,
            'count_monografi_blm_verif' => $count_monografi_blm_verif,
            'count_artikel_verif' => $artikel,
            'count_artikel_blm_verif' => $count_artikel_blm_verif,
            'survey' => $survey
        ]);
    }

    /**
     * fungsi yang digunakan untuk mengupload gambar tema
     */
    public function uploadImage(Request $request)
    {
        /**
         * Menggunakan try catch untuk mengidentifikasi kesalahan. Jika terjadi kesalahan, maka akan diarahkan kembali ke halaman dashboard dengan pesan error. Jika tidak terjadi kesalahan, maka data image akan diupload.
         */
        try {

            /**
             * Jika request memiliki file image, maka file image akan dipindahkan ke folder gambar_tema dengan nama gambar_tema.webp
             */
            if ($request->hasFile('image')) {
                $request->file('image')->move('gambar_tema/', 'gambar_tema.webp');
            }

            /**
             * Jika berhasil, maka akan diarahkan kembali ke halaman dashboard dengan pesan success
             */
            return redirect()->route('dashboard')->with('success', 'Image uploaded successfully');
        } catch (\Throwable $th) {

            /**
             * Jika terjadi kesalahan, maka akan diarahkan kembali ke halaman dashboard dengan pesan error
             */
            return redirect()->route('dashboard')->with('error', 'Image uploaded failed');
        }
    }
}
