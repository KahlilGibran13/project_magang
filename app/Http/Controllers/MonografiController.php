<?php

namespace App\Http\Controllers;

use App\Models\r_cluster;
use App\Models\r_tema;
use App\Models\t_produk;
use App\Models\r_jenis;
use App\Models\t_produk_tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class MonografiController extends Controller

{

    /**
     * Menampilkan data monografi
     */
    public function index()
    {

        /**
         * Mengambil data monografi dengan menggunakan model t_produk yang memiliki produk_jenis_id 3 (monografi)
         */
        $monografis = t_produk::where('produk_jenis_id', '3')->orderBy('produk_id', 'desc')->paginate(8);
        
        return view('monografi.index', compact('monografis'));
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman verifikasi monografi
     */
    public function viewVerifikasi()
    {
        /**
         * variabel ini digunakan untuk menyimpan data t_produk 
         */
        $produks = [];

        /**
         * Jika user yang login memiliki role operator, maka data yang diambil adalah data monografi yang memiliki produk_jenis_id 3 (monografi) dan status verifikasi adalah 1. Data diurutkan berdasarkan produk_id secara descending dan di paginasi sebanyak 10 data. Data yang diambil juga berelasi dengan model t_verifikasi_peraturan sebagai pivot table.
         */
        if (Gate::allows('operator')) {
            $produks = t_produk::where('produk_jenis_id', '3')->orderBy('produk_id', 'desc')
                ->whereHas('verifikasiPeraturanLatest', function ($query) {
                    $query->where('status', '1');
                })
                ->with('verifikasiPeraturanLatest')
                ->paginate(10);
        }

        /**
         * Jika user yang login memiliki role verifikator, maka data yang diambil adalah data monografi yang memiliki produk_jenis_id 3 (monografi) dan status verifikasi adalah 1 dan aksi adalah 1. Data diurutkan berdasarkan produk_id secara descending dan di paginasi sebanyak 10 data. Data yang diambil juga berelasi dengan model t_verifikasi_peraturan sebagai pivot table.
         */
        if (Gate::allows('verifikator')) {
            $produks = t_produk::where('produk_jenis_id', '3')->orderBy('produk_id', 'desc')
                ->whereHas('verifikasiPeraturanLatest', function ($query) {
                    $query->where('status', '1')->where('aksi', '1');
                })
                ->with('verifikasiPeraturanLatest')
                ->paginate(10);
        }
        
        /**
         * Jika user yang login memiliki role biro hukum, maka data yang diambil adalah data monografi yang memiliki produk_jenis_id 3 (monografi) dan status verifikasi adalah 1 dan aksi adalah 3. Data diurutkan berdasarkan produk_id secara descending dan di paginasi sebanyak 10 data. Data yang diambil juga berelasi dengan model t_verifikasi_peraturan sebagai pivot table.
         */
        if (Gate::allows('birohukum')) {
            $produks = t_produk::where('produk_jenis_id', '3')->orderBy('produk_id', 'desc')
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
     * fungsi yang digunakan untuk menampilkan halaman pembuatan monografi
     */
    public function create()
    {
        /**
         * variabel ini digunakan untuk menyimpan data r_jenis yang memiliki jenis_id 3 (monografi)
         */
        $jenis = r_jenis::where('jenis_id', 3)->first();

        /**
         * variabel ini digunakan untuk mengambil semua data r_tema
         */
        $temas = r_tema::all();
        return view('monografi.create', [
            'temas' => $temas,
            'jenis' => $jenis,
        ]);
    }

    /**
     * fungsi yang digunakan untuk menyimpan data monografi
     */
    public function store(Request $request)
    {
        /**
         * Menggunakan try catch untuk mengidentifikasi kesalahan. Jika terjadi kesalahan, maka akan diarahkan kembali ke halaman monografi dengan pesan error. Jika tidak terjadi kesalahan, maka data monografi akan disimpan.
         */
        try {

            /**
             * Validasi data yang diinputkan oleh user
             */
            $request->validate([
                'produk_judul' => 'required',
                'produk_tema_id' => 'required',
                'produk_deskripsifisik' => 'required',
                'produk_jenis_id' => 'required',
                'produk_dibuat' => 'required',
                'produk_penerbit' => 'required',
                'produk_tajuk' => 'required',
                'produk_tempatterbit' => 'required',
                'produk_bahasa' => 'required',
                'produk_nomor' => 'required',
                'produk_lokasi' => 'required',
                'produk_subjek' => 'required',
                'produk_cetakan' => 'required',
                'produk_isbn' => 'required',
                'produk_abstrak' => 'required',
                'produk_bidanghukum' => 'required',
            ]);

            /**
             * Menyimpan data monografi ke dalam tabel t_produk. Data yang disimpan adalah data yang diinputkan oleh user kecuali produk_tema_id.
             */
            $produk = t_produk::create($request->except(['produk_tema_id']));

            /**
             * Menyimpan data tema ke dalam tabel t_produk_tema.
             */
            $produk_tema_id =  $request->get('produk_tema_id');
            foreach ($produk_tema_id as $value) {
                t_produk_tema::create([
                    'produk_id' => $produk->produk_id,
                    'tema_id' => $value
                ]);
            }

            /**
             * Jika user mengupload file, maka file akan disimpan ke dalam folder dokumen.
             */
            if ($request->hasFile('produk_dokumen')) {
                $request->file('produk_dokumen')->move('dokumen/', $request->file('produk_dokumen')->getClientOriginalName());
                $produk->produk_dokumen = $request->file('produk_dokumen')->getClientOriginalName();
                $produk->save();
            }

            /**
             * Jika data berhasil disimpan, maka user akan diarahkan kembali ke halaman monografi dengan pesan sukses.
             */
            return redirect()->route('monografi')
                ->with('success', 'Item Created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {

            /**
             * Jika terjadi kesalahan validasi, maka user akan diarahkan kembali ke halaman pembuatan monografi dengan pesan error dan data yang diinputkan sebelumnya.
             */
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Throwable $th) {

            /**
             * Jika terjadi kesalahan lainnya, maka user akan diarahkan kembali ke halaman monografi dengan pesan error.
             */
            return redirect()->route('monografi')->with('error', 'Item Created Failed');
        }
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman edit monografi
     */
    public function edit($id)
    {
        /**
         * variabel produk ini digunakan untuk mengambil data t_produk yang memiliki produk_id sesuai dengan parameter id
         */
        $produk = t_produk::find($id);
        $jenis = r_jenis::where('jenis_id', 3)->first();
        $putusan = t_produk::join('r_jenis', 'r_jenis.jenis_id', '=', 't_produk.produk_jenis_id')
            ->where('t_produk.produk_jenis_id', '3')->first();
        $temas = r_tema::all();
        return view('monografi.edit', [
            'produk' => $produk,
            'putusan' => $putusan,
            'temas' => $temas,
            'jenis' => $jenis,
        ]);
    }

    /**
     * fungsi yang digunakan untuk menyimpan data monografi yang telah diubah
     */
    public function update($id, Request $request)
    {
        /**
         * Menggunakan try catch untuk mengidentifikasi kesalahan. Jika terjadi kesalahan, maka akan diarahkan kembali ke halaman monografi dengan pesan error. Jika tidak terjadi kesalahan, maka data monografi akan diperbarui.
         */
        try {
            /**
             * mengambil data t_produk yang memiliki produk_id sesuai dengan parameter id
             */
            $produk = t_produk::find($id);

            /**
             * Validasi data yang diinputkan oleh user
             */
            $request->validate([
                'produk_judul' => 'required',
                'produk_tema_id' => 'required',
                'produk_deskripsifisik' => 'required',
                'produk_jenis_id' => 'required',
                'produk_dibuat' => 'required',
                'produk_penerbit' => 'required',
                'produk_tajuk' => 'required',
                'produk_tempatterbit' => 'required',
                'produk_bahasa' => 'required',
                'produk_nomor' => 'required',
                'produk_lokasi' => 'required',
                'produk_subjek' => 'required',
                'produk_cetakan' => 'required',
                'produk_isbn' => 'required',
                'produk_abstrak' => 'required',
                'produk_bidanghukum' => 'required',
            ]);

            /**
             * Mengupdate data monografi ke dalam tabel t_produk. Data yang diupdate adalah data yang diinputkan oleh user kecuali produk_tema_id.
             */
            $produk->update($request->except(['produk_dokumen', 'produk_tema_id']));

            
            $produk_tema_id = $request->get('produk_tema_id');

            /** 
             * menghapus data tema ke dalam tabel t_produk_tema.
             */
            t_produk_tema::where('produk_id', $id)->delete();

            /**
             * Menyimpan data tema ke dalam tabel t_produk_tema.
             */
            foreach ($produk_tema_id as $value) {
                t_produk_tema::create([
                    'produk_id' => $id,
                    'tema_id' => $value
                ]);
            }

            /**
             * Jika user mengupload file, maka file akan disimpan ke dalam folder dokumen.
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
             * Jika data berhasil diperbarui, maka user akan diarahkan kembali ke halaman monografi dengan pesan sukses.
             */
            return redirect()->route('monografi')->with('success', 'Data berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {

            /**
             * Jika terjadi kesalahan validasi, maka user akan diarahkan kembali ke halaman edit monografi dengan pesan error dan data yang diinputkan sebelumnya.
             */
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Throwable $th) {

            /**
             * Jika terjadi kesalahan lainnya, maka user akan diarahkan kembali ke halaman monografi dengan pesan error.
             */
            return redirect()->route('monografi')->with('error', 'Data gagal diperbarui.');
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
     * fungsi yang digunakan untuk menghapus data monografi
     */
    public function destroy($id)
    {
        // Cari data produk berdasarkan ID
        $produk = t_produk::find($id);

        // Hapus file terkait jika ada
        if (File::exists(public_path('dokumen/' . $produk->produk_dokumen))) {
            File::delete(public_path('dokumen/' . $produk->produk_dokumen));
        }

        // Hapus record produk dari database
        t_produk_tema::where('produk_id', $produk->produk_id)->delete();
        $produk->delete();

        return redirect()->route('monografi')->with('success', 'Item berhasil dihapus.');
    }

    /**
     * Menampilkan detail monografi
     */
    public function detail($id)
    {
        /**
         * Mengambil data monografi dengan menggunakan model t_produk yang memiliki produk_id sesuai dengan parameter id. Data yang diambil juga berelasi dengan model r_tema.
         */
        $produk = t_produk::where('produk_id', $id)->with('temas')->first();

        $jenis = r_jenis::where('jenis_id', 2)->first();
        $temas = r_tema::all();
        $clusters = r_cluster::all();
        return view('monografi.detail', [
            'produk' => $produk,
            'temas' => $temas,
            'clusters' => $clusters,
            'jenis' => $jenis,
        ]);  
    }
}
