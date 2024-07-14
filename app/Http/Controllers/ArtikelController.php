<?php

namespace App\Http\Controllers;

use App\Models\r_tema;
use App\Models\r_jenis;
use App\Models\t_produk;
use App\Models\t_produk_tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class ArtikelController extends Controller
{
    /**
     * fungsi yang digunakan untuk menampilkan halaman artikel
     */
    public function index()
    {
        /**
         * Mengambil data artikel yang memiliki produk_jenis_id 4 (artikel). Data diurutkan berdasarkan produk_id secara descending dan di paginasi sebanyak 5 data. Data yang diambil juga berelasi dengan model t_verifikasi_peraturan sebagai pivot table.
         */
        $artikels = t_produk::where('produk_jenis_id', '4')->orderBy('produk_id', 'desc')->with('verifikasiPeraturanLatest')->paginate(5);
        
        return view('artikel.index', compact('artikels'));
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman verifikasi artikel
     */
    public function viewVerifikasi()
    {
        /**
         * variabel ini digunakan untuk menyimpan data t_produk 
         */
        $produks = [];

        /**
         * Jika user yang login memiliki role operator, maka data yang diambil adalah data artikel yang memiliki produk_jenis_id 4 (artikel) dan status verifikasi adalah 1. Data diurutkan berdasarkan produk_id secara descending dan di paginasi sebanyak 10 data. Data yang diambil juga berelasi dengan model t_verifikasi_peraturan sebagai pivot table.
         */
        if (Gate::allows('operator')) {
            $produks = t_produk::where('produk_jenis_id', '4')->orderBy('produk_id', 'desc')
                ->whereHas('verifikasiPeraturanLatest', function ($query) {
                    $query->where('status', '1');
                })
                ->with('verifikasiPeraturanLatest')
                ->paginate(10);
        }

        /**
         * Jika user yang login memiliki role verifikator, maka data yang diambil adalah data artikel yang memiliki produk_jenis_id 4 (artikel) dan status verifikasi adalah 1 dan aksi adalah 1. Data diurutkan berdasarkan produk_id secara descending dan di paginasi sebanyak 10 data. Data yang diambil juga berelasi dengan model t_verifikasi_peraturan sebagai pivot table.
         */
        if (Gate::allows('verifikator')) {
            $produks = t_produk::where('produk_jenis_id', '4')->orderBy('produk_id', 'desc')
                ->whereHas('verifikasiPeraturanLatest', function ($query) {
                    $query->where('status', '1')->where('aksi', '1');
                })
                ->with('verifikasiPeraturanLatest')
                ->paginate(10);
        }

        /**
         * Jika user yang login memiliki role biro hukum, maka data yang diambil adalah data artikel yang memiliki produk_jenis_id 4 (artikel) dan status verifikasi adalah 1 dan aksi adalah 3. Data diurutkan berdasarkan produk_id secara descending dan di paginasi sebanyak 10 data. Data yang diambil juga berelasi dengan model t_verifikasi_peraturan sebagai pivot table.
         */
        if (Gate::allows('birohukum')) {
            $produks = t_produk::where('produk_jenis_id', '4')->orderBy('produk_id', 'desc')
                ->whereHas('verifikasiPeraturanLatest', function ($query) {
                    $query->where('status', '1')->where('aksi', '3');
                })
                ->with('verifikasiPeraturanLatest')
                ->paginate(10);
        }
        return view('verifikasi.index', [
            'produks' => $produks
        ]);
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman pembuatan artikel
     */
    public function create()
    {
        /**
         * variabel jenis ini digunakan untuk menyimpan data r_jenis yang memiliki jenis_id 4 (artikel). 
         */
        $jenis = r_jenis::where('jenis_id', 4)->first();
        
        /**
         * variabel temas ini digunakan untuk menyimpan data r_tema.
         */
        $temas = r_tema::all();
        return view('artikel.create', [
            'jenis' => $jenis,
            'temas' => $temas,
        ]);
    }

    /**
     * fungsi yang digunakan untuk menyimpan data artikel
     */
    public function store(Request $request)
    {
        /**
         * Menggunakan try catch untuk mengidentifikasi kesalahan. Jika terjadi kesalahan, maka akan diarahkan kembali ke halaman artikel dengan pesan error. Jika tidak terjadi kesalahan, maka data artikel akan disimpan.
         */
        try {

            /**
             * Validasi data yang diinputkan oleh user
             */
            $request->validate([
                'produk_judul' => 'required',
                'produk_dibuat' => 'required',
                'produk_penerbit' => 'required',
                'produk_tajuk' => 'required',
                'produk_tempatterbit' => 'required',
                'produk_bahasa' => 'required',
                'produk_bidanghukum' => 'required',
                'produk_lokasi' => 'required',
                'produk_sumber' => 'required',
                'produk_subjek' => 'required',
                'produk_cetakan' => 'required',
                'produk_abstrak' => 'required',
            ]);

            /**
             * Menyimpan data artikel
             */
            $produk = t_produk::create($request->all());

            /**
             * Jika user mengupload file, maka file akan disimpan di folder dokumen
             */
            if ($request->hasFile('produk_dokumen')) {
                $request->file('produk_dokumen')->move('dokumen/', $request->file('produk_dokumen')->getClientOriginalName());
                $produk->produk_dokumen = $request->file('produk_dokumen')->getClientOriginalName();
                $produk->save();
            }

            /**
             * Jika berhasil disimpan, maka user akan diarahkan kembali ke halaman artikel dengan pesan sukses
             */
            return redirect()->route('artikel')
                ->with('success', 'Item Created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {

            /**
             * Jika terjadi kesalahan validasi, maka user akan diarahkan kembali ke halaman create artikel dengan pesan error
             */
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Throwable $th) {

            /**
             * Jika terjadi kesalahan lainnya, maka user akan diarahkan kembali ke halaman artikel dengan pesan error
             */
            return redirect()->route('artikel')
                ->with('error', 'Item Created failed.');
        }
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman edit artikel
     */
    public function edit($id)
    {
        /**
         * variabel produk ini digunakan untuk mengambil data t_produk berdasarkan paramter id
         */
        $produk = t_produk::find($id);

        /**
         * variabel jenis ini digunakan untuk mengambil data r_jenis yang memiliki jenis_id 4 (artikel). 
         */
        $jenis = r_jenis::where('jenis_id', 4)->first();

        /**
         * variabel temas ini digunakan untuk mengambil data r_tema.
         */
        $temas = r_tema::all();
        return view('artikel.edit', [
            'produk' => $produk,
            'temas' => $temas,
            'jenis' => $jenis,
        ]);
    }

    /**
     * fungsi yang digunakan untuk menyimpan data artikel yang telah diubah
     */
    public function update($id, Request $request)
    {
        try {

            /**
             * variabel produk ini digunakan untuk mengambil data t_produk berdasarkan paramter id
             */
            $produk = t_produk::find($id);

            /**
             * Validasi data yang diinputkan oleh user
             */
            $request->validate([
                'produk_judul' => 'required',
                'produk_dibuat' => 'required',
                'produk_penerbit' => 'required',
                'produk_tajuk' => 'required',
                'produk_tempatterbit' => 'required',
                'produk_bahasa' => 'required',
                'produk_bidanghukum' => 'required',
                'produk_lokasi' => 'required',
                'produk_sumber' => 'required',
                'produk_subjek' => 'required',
                'produk_cetakan' => 'required',
                'produk_abstrak' => 'required',
            ]);

            /**
             * Menyimpan data artikel yang telah diubah
             */
            $produk->update($request->except(['produk_dokumen']));

            /**
             * Jika user mengupload file, maka file akan disimpan di folder dokumen
             */
            if ($request->hasFile('produk_dokumen')) {
                // Hapus file lama jika ada
                if (File::exists(public_path('dokumen/' . $produk->produk_dokumen))) {
                    File::delete(public_path('dokumen/' . $produk->produk_dokumen));
                }

                // Pindahkan file baru
                $file = $request->file('produk_dokumen');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('dokumen'), $fileName);

                // Perbarui nama file di database
                $produk->produk_dokumen = $fileName;
                $produk->save();
            }

            /**
             * Jika berhasil disimpan, maka user akan diarahkan kembali ke halaman artikel dengan pesan sukses
             */
            return redirect()->route('artikel')->with('success', 'Data berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {

            /**
             * Jika terjadi kesalahan validasi, maka user akan diarahkan kembali ke halaman edit artikel dengan pesan error
             */
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Throwable $th) {

            /**
             * Jika terjadi kesalahan lainnya, maka user akan diarahkan kembali ke halaman artikel dengan pesan error
             */
            return redirect()->route('artikel')->with('error', 'Data gagal diperbarui.');
        }
    }

    /**
     * fungsi yang digunakan untuk menampilkan file PDF
     */
    public function showPDF($filename)
    {
        $path = public_path('dokumen/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
        ]);
    }

    /**
     * fungsi yang digunakan untuk menghapus data artikel
     */
    public function destroy($id)
    {
        try {
            /**
             * variabel produk ini digunakan untuk mengambil data t_produk berdasarkan paramter id
             */
            $produk = t_produk::find($id);

            // Hapus file terkait jika ada
            if (File::exists(public_path('dokumen/' . $produk->produk_dokumen))) {
                File::delete(public_path('dokumen/' . $produk->produk_dokumen));
            }

            // Hapus record produk dari database
            $produk->delete();

            // Redirect kembali ke halaman artikel dengan pesan sukses
            return redirect()->back()->with('success', 'Item berhasil dihapus.');
        } catch (\Throwable $th) {
            
            // Redirect kembali ke halaman artikel dengan pesan error
            return redirect()->back()->with('error', 'Item gagal dihapus.');
        }
    }

    /**
     * fungsi yang digunakan untuk menampilkan detail artikel
     */
    public function detail($id)
    {
        /**
         * variabel produk ini digunakan untuk mengambil data t_produk berdasarkan paramter id
         */
        $produk = t_produk::find($id);

        /**
         * variabel jenis ini digunakan untuk mengambil data r_jenis yang memiliki jenis_id 4 (artikel).
         */
        $jenis = r_jenis::where('jenis_id', 4)->first();

        /**
         * variabel temas ini digunakan untuk mengambil data r_tema.
         */
        $temas = r_tema::all();

        return view('artikel.detail', [
            'produk' => $produk,
            'temas' => $temas,
            'jenis' => $jenis,
        ]);
    }
}
