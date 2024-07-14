<?php

// app/Http/Controllers/PutusanController.php

namespace App\Http\Controllers;

use App\Models\r_cluster;
use App\Models\r_tema;
use App\Models\t_produk;
use App\Models\r_jenis;
use App\Models\t_produk_cluster;
use App\Models\t_produk_tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PutusanController extends Controller
{
    /**
     * menampilkan halaman putusan
     */
    public function index()
    {
        /**
         * mengambil data peraturan dengan menggunakan model t_produk yang memiliki produk_jenis_id 2 (putusan). Data diurutkan berdasarkan produk_id secara descending dan di paginasi 5 data. Data yang diambil juga berelasi dengan model verifikasiPeraturanLatest
         */
        $putusans = t_produk::where('produk_jenis_id', '2')->orderBy('produk_id', 'desc')->with('verifikasiPeraturanLatest')->paginate(5);
        return view('putusan.index', compact('putusans'));
    }

    /**
     * menampilkan halaman verifikasi
     */
    public function viewVerifikasi()
    {
        /**
         * variabel ini digunakan untuk menyimpan data t_produk 
         */
        $produks = [];

        /**
         * Jika user yang login memiliki role operator, maka data yang diambil adalah data putusan yang memiliki produk_jenis_id 2 (putusan) dan status verifikasi adalah 1. Data diurutkan berdasarkan produk_id secara descending dan di paginasi sebanyak 10 data. Data yang diambil juga berelasi dengan model t_verifikasi_peraturan sebagai pivot table.
         */
        if (Gate::allows('operator')) {
            $produks = t_produk::where('produk_jenis_id', '2')->orderBy('produk_id', 'desc')
                ->whereHas('verifikasiPeraturanLatest', function ($query) {
                    $query->where('status', '1');
                })
                ->with('verifikasiPeraturanLatest')
                ->paginate(10);
        }

        /**
         * Jika user yang login memiliki role verifikator, maka data yang diambil adalah data putusan yang memiliki produk_jenis_id 2 (putusan) dan status verifikasi adalah 1 dan aksi adalah 1. Data diurutkan berdasarkan produk_id secara descending dan di paginasi sebanyak 10 data. Data yang diambil juga berelasi dengan model t_verifikasi_peraturan sebagai pivot table.
         */
        if (Gate::allows('verifikator')) {
            $produks = t_produk::where('produk_jenis_id', '2')->orderBy('produk_id', 'desc')
                ->whereHas('verifikasiPeraturanLatest', function ($query) {
                    $query->where('status', '1')->where('aksi', '1');
                })
                ->with('verifikasiPeraturanLatest')
                ->paginate(10);
        }

        /**
         * Jika user yang login memiliki role birohukum, maka data yang diambil adalah data putusan yang memiliki produk_jenis_id 2 (putusan) dan status verifikasi adalah 1 dan aksi adalah 3. Data diurutkan berdasarkan produk_id secara descending dan di paginasi sebanyak 10 data. Data yang diambil juga berelasi dengan model t_verifikasi_peraturan sebagai pivot table.
         */
        if (Gate::allows('birohukum')) {
            $produks = t_produk::where('produk_jenis_id', '2')->orderBy('produk_id', 'desc')
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
     * menampilkan halaman pembuatan putusan
     */
    public function create()
    {
        $jenis = r_jenis::where('jenis_id', 2)->first();
        $temas = r_tema::all();
        $clusters = r_cluster::all();
        return view('putusan.create', [
            // 'putusan' => $putusan,
            'temas' => $temas,
            'jenis' => $jenis,
            'clusters' => $clusters
        ]);
    }

    /**
     * menyimpan data putusan
     */
    public function store(Request $request)
    {
        /**
         * Menggunakan try catch untuk mengidentifikasi kesalahan. Jika terjadi kesalahan, maka akan diarahkan kembali ke halaman edit putusan dengan pesan error. Jika tidak terjadi kesalahan, maka data putusan akan disimpan.
         */
        try {

            /**
             * Validasi data yang diinputkan oleh user
             */
            $request->validate([
                'produk_judul' => 'required',
                'produk_tema_id' => 'required',
                'produk_sumber' => 'required',
                'produk_jenis_id' => 'required',
                'produk_dibuat' => 'required',
                'produk_tajuk' => 'required',
                'produk_tempatterbit' => 'required',
                'produk_bahasa' => 'required',
                'produk_nomor' => 'required',
                'produk_lokasi' => 'required',
                'produk_singkatan' => 'required',
                'produk_bidanghukum' => 'required',
                'produk_subjek' => 'required',
                'produk_statusberlaku' => 'required',
                'produk_abstrak' => 'required',
                'produk_ttd' => 'required',
                'produk_pemrakarsa' => 'required',
                'produk_terkait' => 'required',
                'produk_keyword' => 'required',
                'produk_tgldiundangkan' => 'required',
            ]);

            /**
             * Menyimpan data putusan. Data yang disimpan adalah data yang diinputkan oleh user kecuali data produk_tema_id. Data produk_tema_id disimpan ke dalam tabel t_produk_tema.
             */
            $produk = t_produk::create($request->except(['produk_tema_id']));

            /**
             * Menyimpan data produk_tema_id ke dalam tabel t_produk_tema
             */
            $produk_tema_id =  $request->get('produk_tema_id');
            foreach ($produk_tema_id as $value) {
                t_produk_tema::create([
                    'produk_id' => $produk->produk_id,
                    'tema_id' => $value
                ]);
            }

            /**
             * Jika user mengupload file dokumen, maka file tersebut akan disimpan ke dalam folder dokumen
             */
            if ($request->hasFile('produk_dokumen')) {
                $request->file('produk_dokumen')->move('dokumen/', $request->file('produk_dokumen')->getClientOriginalName());
                $produk->produk_dokumen = $request->file('produk_dokumen')->getClientOriginalName();
                $produk->save();
            }

            /**
             * Jika data berhasil diperbarui, maka user akan diarahkan kembali ke halaman putusan dengan pesan sukses.
             */
            return redirect()->route('putusan')
                ->with('success', 'Item Created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {

            /**
             * Jika terjadi kesalahan validasi, maka user akan diarahkan kembali ke halaman putusan dengan pesan error.
             */
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Throwable $th) {

            /**
             * Jika terjadi kesalahan lainnya, maka user akan diarahkan kembali ke halaman putusan dengan pesan error.
             */
            return redirect()->route('putusan')->with('error', 'Item Created failed.');
        }
    }

    /**
     * menampilkan halaman edit putusan
     */
    public function edit($id)
    {
        /**
         * Mengambil data putusan berdasarkan id yang diinputkan oleh user. Data yang diambil juga berelasi dengan model temas dan clusters.
         */
        $produk = t_produk::where('produk_id', $id)->with('temas')->first();
        $jenis = r_jenis::where('jenis_id', 2)->first();
        $temas = r_tema::all();
        $clusters = r_cluster::all();
        return view('putusan.edit', [
            'produk' => $produk,
            // 'putusan' => $putusan,
            'temas' => $temas,
            'clusters' => $clusters,
            'jenis' => $jenis,
        ]);
    }

    /**
     * mengupdate data putusan
     */
    public function update(Request $request, $id)
    {
        /**
         * Menggunakan try catch untuk mengidentifikasi kesalahan. Jika terjadi kesalahan, maka akan diarahkan kembali ke halaman edit putusan dengan pesan error. Jika tidak terjadi kesalahan, maka data putusan akan diperbarui.
         */
        try {

            /**
             * mengambil data putusan berdasarkan id yang diinputkan oleh user
             */
            $produk = t_produk::find($id);

            /**
             * Validasi data yang diinputkan oleh user
             */
            $request->validate([
                'produk_judul' => 'required',
                'produk_tema_id' => 'required',
                'produk_sumber' => 'required',
                'produk_jenis_id' => 'required',
                'produk_dibuat' => 'required',
                'produk_tajuk' => 'required',
                'produk_tempatterbit' => 'required',
                'produk_bahasa' => 'required',
                'produk_nomor' => 'required',
                'produk_lokasi' => 'required',
                'produk_singkatan' => 'required',
                'produk_bidanghukum' => 'required',
                'produk_subjek' => 'required',
                'produk_statusberlaku' => 'required',
                'produk_abstrak' => 'required',
                'produk_ttd' => 'required',
                'produk_cluster' => 'required',
                'produk_pemrakarsa' => 'required',
                'produk_terkait' => 'required',
                'produk_keyword' => 'required',
                'produk_penerbit' => 'required'
            ]);

            /**
             * Mengupdate data putusan. Data yang diupdate adalah data yang diinputkan oleh user kecuali data produk_tema_id. 
             */
            $produk->update($request->except('produk_tema_id'));
            $produk_tema_id = $request->get('produk_tema_id');

            /**
             * Data produk_tema_id yang sebelumnya disimpan di tabel t_produk_tema akan dihapus terlebih dahulu.
             */
            t_produk_tema::where('produk_id', $id)->delete();

            /**
             * Data produk_tema_id disimpan ke dalam tabel t_produk_tema.
             */
            foreach ($produk_tema_id as $value) {
                t_produk_tema::create([
                    'produk_id' => $id,
                    'tema_id' => $value
                ]);
            }
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
            }
            $produk->save();

            /**
             * Jika data berhasil diperbarui, maka user akan diarahkan kembali ke halaman putusan dengan pesan sukses.
             */
            return redirect()->route('putusan')->with('success', 'Data berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {

            /**
             * Jika terjadi kesalahan validasi, maka user akan diarahkan kembali ke halaman edit putusan dengan pesan error.
             */
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Throwable $th) {

            /**
             * Jika terjadi kesalahan lainnya, maka user akan diarahkan kembali ke halaman edit putusan dengan pesan error.
             */
            return redirect()->route('putusan')->with('error', 'Data gagal diperbarui.');
        }
    }

    /**
     * menampilkan file PDF
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
     * menghapus data putusan
     */
    public function destroy($id)
    {
        /**
         * Menggunakan try catch untuk mengidentifikasi kesalahan. Jika terjadi kesalahan, maka akan diarahkan kembali ke halaman putusan dengan pesan error. Jika tidak terjadi kesalahan, maka data putusan akan dihapus.
         */
        try {

            /**
             * Mengambil data putusan berdasarkan id yang diinputkan oleh user
             */
            $produk = t_produk::findOrFail($id);

            // Delete associated files
            if ($produk->produk_dokumen && File::exists(public_path('dokumen/' . $produk->produk_dokumen))) {
                File::delete(public_path('dokumen/' . $produk->produk_dokumen));
            }

            if ($produk->produk_abstrak && File::exists(public_path('dokumen/' . $produk->produk_abstrak))) {
                File::delete(public_path('dokumen/' . $produk->produk_abstrak));
            }

            if ($produk->produk_terjemah && File::exists(public_path('dokumen/' . $produk->produk_terjemah))) {
                File::delete(public_path('dokumen/' . $produk->produk_terjemah));
            }

            // Delete associated lampirans
            // $lampirans = t_lampiran::where('lampiran_produk_id', $produk->produk_id)->get();
            // foreach ($lampirans as $lampiran) {
            //     if (File::exists(public_path('dokumen/' . $lampiran->lampiran_nama))) {
            //         File::delete(public_path('dokumen/' . $lampiran->lampiran_nama));
            //     }
            //     $lampiran->delete();
            // }

            // Delete the produk record
            t_produk_tema::where('produk_id', $produk->produk_id)->delete();
            $produk->delete();

            /**
             * Jika data berhasil dihapus, maka user akan diarahkan kembali ke halaman putusan dengan pesan sukses.
             */
            return redirect()->route('putusan')->with('success', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {

            /**
             * Jika terjadi kesalahan, maka user akan diarahkan kembali ke halaman putusan dengan pesan error.
             */
            return redirect()->route('putusan')->with('error', 'Data gagal dihapus.');
        }
    }

    /**
     * menampilkan detail putusan
     */
    public function detail($id)
    {
        /**
         * Mengambil data putusan berdasarkan id yang diinputkan oleh user. Data yang diambil juga berelasi dengan model temas.
         */
        $produk = t_produk::where('produk_id', $id)->with('temas')->first();
        $jenis = r_jenis::where('jenis_id', 2)->first();
        $temas = r_tema::all();
        $clusters = r_cluster::all();
        return view('putusan.detail', [
            'produk' => $produk,
            'temas' => $temas,
            'clusters' => $clusters,
            'jenis' => $jenis,
        ]);  
    }
}
