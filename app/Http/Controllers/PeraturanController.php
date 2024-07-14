<?php

namespace App\Http\Controllers;

use App\Models\t_produk_cluster;
use App\Models\r_tema;
use App\Models\r_jenis;
use App\Models\t_produk;
use App\Models\r_cluster;
use App\Models\t_lampiran;
use App\Models\t_produk_tema;
use App\Models\t_verifikasi_peraturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PeraturanController extends Controller
{

    /**
     * fungsi yang digunakan untuk menampilkan data peraturan
     */
    public function index()
    {
        $peraturans = t_produk::where('produk_jenis_id', '1')->orderBy('produk_id', 'desc')->with('verifikasiPeraturanLatest')->paginate(10);
        
        return view('peraturan.index', compact('peraturans'));
    }

    /**
     * fungsi yang digunakan untuk menampilkan form tambah peraturan
     */
    public function create()
    {
        $jenis = r_jenis::where('jenis_id', 1)->first();
        $temas = r_tema::all();
        $clusters = r_cluster::all();
        $produks = t_produk::all();
        return view('peraturan.create', [
            'jenis' => $jenis,
            'temas' => $temas,
            'clusters' => $clusters,
            'produks' => $produks,
        ]);
    }

    /**
     * fungsi yang digunakan untuk menyimpan data peraturan
     */
    public function store(Request $request)
    {
        /**
         * Menggunakan try catch untuk mengidentifikasi kesalahan. Jika terjadi kesalahan, maka akan diarahkan kembali ke halaman perturan dengan pesan error. Jika tidak terjadi kesalahan, maka data perturan akan disimpan.
         */
        try {
            // $request->validate([
            //     'produk_judul' => 'required',
            //     'produk_cluster' => 'required',
            //     'produk_sumber' => 'required',
            //     'produk_tema_id' => 'required',
            //     'produk_tahun' => 'required',
            //     'produk_jenis_id' => 'required',
            //     'produk_tglterbit' => 'required|date',
            //     'produk_diundangkan' => 'required|date',
            //     'produk_tajuk' => 'required',
            //     'produk_tempatterbit' => 'required',
            //     'produk_pemrakarsa' => 'required',
            //     'produk_nomor' => 'required',
            //     'produk_ttd' => 'required',
            //     'produk_bahasa' => 'required',
            //     'produk_singkatan' => 'required',
            //     'produk_lokasi' => 'required',
            //     'produk_subjek' => 'required',
            //     'produk_bidanghukum' => 'required',
            //     'produk_terkait' => 'required',
            //     'produk_statusberlaku' => 'required',
            //     'produk_keyword' => 'required',
            // 'produk_diubah' => 'required',
            // 'produk_mengubah' => 'required',
            // 'produk_dicabut' => 'required',
            // 'produk_mencabut' => 'required',
            // 'produk_dokumen' => 'required|file',
            // 'produk_abstraks' => 'required|file',
            // 'produk_terjemah' => 'required|file',
            // ]);


            $produk_cluster =  $request->get('produk_cluster');
            $produk_tema_id =  $request->get('produk_tema_id');

            /**
             * Menyimpan data peraturan ke dalam database. Data yang disimpan adalah data yang diinputkan oleh user kecuali produk_cluster dan produk_tema_id.
             */
            $produk = t_produk::create($request->except(['produk_cluster', 'produk_tema_id']));

            /**
             * Menyimpan data produk_cluster ke dalam database.
             */
            foreach ($produk_cluster as $value) {
                t_produk_cluster::create([
                    'produk_id' => $produk->produk_id,
                    'cluster_id' => $value
                ]);
            }

            /**
             * Menyimpan data produk_tema ke dalam database.
             */
            foreach ($produk_tema_id as $value) {
                t_produk_tema::create([
                    'produk_id' => $produk->produk_id,
                    'tema_id' => $value
                ]);
            }

            /**
             * Menyimpan file produk_dokumen, produk_abstrak, dan produk_mencabut ke dalam folder dokumen jika user meninputkan file.
             */
            if ($request->hasFile('produk_dokumen')) {
                $request->file('produk_dokumen')->move('dokumen/', $request->file('produk_dokumen')->getClientOriginalName());
                $produk->produk_dokumen = $request->file('produk_dokumen')->getClientOriginalName();
                $produk->save();
            }
            if ($request->hasFile('produk_abstrak')) {
                $request->file('produk_abstrak')->move('dokumen/', $request->file('produk_abstrak')->getClientOriginalName());
                $produk->produk_abstrak = $request->file('produk_abstrak')->getClientOriginalName();
                $produk->save();
            }
            if ($request->hasFile('produk_mencabut')) {
                $request->file('produk_mencabut')->move('dokumen/', $request->file('produk_mencabut')->getClientOriginalName());
                $produk->produk_mencabut = $request->file('produk_mencabut')->getClientOriginalName();
                $produk->save();
            }

            /**
             * Jika data berhasil disimpan, maka user akan diarahkan kembali ke halaman peraturan dengan pesan sukses.
             */
            return redirect()->route('peraturan')
                ->with('success', 'Item Created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {

            /**
             * Jika terjadi kesalahan, maka user akan diarahkan kembali ke halaman pembuatan peraturan dengan pesan error.
             */
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Throwable $th) {

            /**
             * Jika terjadi kesalahan, maka user akan diarahkan kembali ke halaman pembuatan peraturan dengan pesan error.
             */
            return redirect()->route('peraturan')
                ->with('error', 'Item Created failed.');
        }
    }

    /**
     * fungsi yang digunakan untuk menampilkan form edit peraturan
     */
    public function edit($id)
    {
        /**
         * Mengambil data peraturan berdasarkan id yang diinputkan oleh user. Data yang diambil adalah data peraturan yang memiliki id yang sama dengan id yang diinputkan oleh user. Data yang diambil juga berelasi dengan tabel cluster, tema, verifikasi_peraturan_latest dan user.
         */
        $produk = t_produk::where('produk_id', $id)->with('verifikasiPeraturanLatest.user')->with(['clusters','temas'])->first();
        $jenis = r_jenis::where('jenis_id', 1)->first();
        $clusters = r_cluster::all();
        $produks = t_produk::all();
        $temas = r_tema::all();
        $lampiran = t_lampiran::where('lampiran_produk_id', $produk->produk_id)->orderBy('lampiran_id', 'desc')->first();
        return view('peraturan.edit', [
            'produk' => $produk,
            'clusters' => $clusters,
            'temas' => $temas,
            'jenis' => $jenis,
            'produks' => $produks,
            'lampiran' => $lampiran,
        ]);
    }

    /**
     * fungsi yang digunakan untuk menyimpan data peraturan yang telah diubah
     */
    public function update($id, Request $request)
    {
        /**
         * Menggunakan try catch untuk mengidentifikasi kesalahan. Jika terjadi kesalahan, maka akan diarahkan kembali ke halaman edit peraturan dengan pesan error. Jika tidak terjadi kesalahan, maka data peraturan akan diperbarui.
         */
        try {

            /**
             * Mengambil data peraturan berdasarkan id yang diinputkan oleh user. Data yang diambil adalah data peraturan yang memiliki id yang sama dengan id yang diinputkan oleh user.
             */
            $produk = t_produk::find($id);
            // $request->validate([
            //     'produk_judul' => 'required',
            //     'produk_cluster' => 'required',
            //     'produk_sumber' => 'required',
            //     'produk_tema_id' => 'required',
            //     'produk_tahun' => 'required',
            //     'produk_jenis_id' => 'required',
            //     'produk_tglterbit' => 'required|date',
            //     'produk_diundangkan' => 'required|date',
            //     'produk_tajuk' => 'required',
            //     'produk_tempatterbit' => 'required',
            //     'produk_pemrakarsa' => 'required',
            //     'produk_nomor' => 'required',
            //     'produk_ttd' => 'required',
            //     'produk_bahasa' => 'required',
            //     'produk_singkatan' => 'required',
            //     'produk_lokasi' => 'required',
            //     'produk_subjek' => 'required',
            //     'produk_bidanghukum' => 'required',
            //     'produk_terkait' => 'required',
            //     'produk_statusberlaku' => 'required',
            //     'produk_keyword' => 'required',
            // ]);
            // Perbarui data produk kecuali produk_dokumen, produk_abstrak, dan produk_terjemah
            // $produk->produk_cluster = implode(',', $request->input('produk_cluster'));
            // $produk->produk_tema_id = implode(',', $request->input('produk_tema_id'));
            // dd($request->input('produk_cluster'));

            /**
             * Mengupdate data peraturan berdasarkan id yang diinputkan oleh user. Data yang diupdate adalah data peraturan yang memiliki id yang sama dengan id yang diinputkan oleh user. Data yang diupdate adalah data yang diinputkan oleh user kecuali produk_dokumen, produk_abstrak, dan produk_terjemah.
             */
            $produk->update($request->except(['produk_dokumen', 'produk_abstrak', 'produk_terjemah', 'produk_cluster', 'produk_tema_id']));

            // Penanganan file produk_dokumen
            if ($request->hasFile('produk_dokumen')) {
                // Hapus file lama produk_dokumen jika ada
                if (File::exists(public_path('dokumen/' . $produk->produk_dokumen))) {
                    File::delete(public_path('dokumen/' . $produk->produk_dokumen));
                }

                // Pindahkan file baru produk_dokumen ke public/dokumen
                $fileDokumen = $request->file('produk_dokumen');
                $fileNameDokumen = time() . '_' . $fileDokumen->getClientOriginalName();
                $fileDokumen->move(public_path('dokumen'), $fileNameDokumen);

                // Perbarui nama file produk_dokumen di database
                $produk->produk_dokumen = $fileNameDokumen;
            }

            // Penanganan file produk_abstrak
            if ($request->hasFile('produk_abstrak')) {
                // Hapus file lama produk_abstrak jika ada
                if (File::exists(public_path('dokumen/' . $produk->produk_abstrak))) {
                    File::delete(public_path('dokumen/' . $produk->produk_abstrak));
                }

                // Pindahkan file baru produk_abstrak ke public/dokumen
                $fileAbstrak = $request->file('produk_abstrak');
                $fileNameAbstrak = time() . '_' . $fileAbstrak->getClientOriginalName();
                $fileAbstrak->move(public_path('dokumen'), $fileNameAbstrak);

                // Perbarui nama file produk_abstrak di database
                $produk->produk_abstrak = $fileNameAbstrak;
            }

            // Penanganan file produk_terjemah
            if ($request->hasFile('produk_terjemah')) {
                // Hapus file lama produk_terjemah jika ada
                if (File::exists(public_path('dokumen/' . $produk->produk_terjemah))) {
                    File::delete(public_path('dokumen/' . $produk->produk_terjemah));
                }

                // Pindahkan file baru produk_terjemah ke public/dokumen
                $fileTerjemah = $request->file('produk_terjemah');
                $fileNameTerjemah = time() . '_' . $fileTerjemah->getClientOriginalName();
                $fileTerjemah->move(public_path('dokumen'), $fileNameTerjemah);

                // Perbarui nama file produk_terjemah di database
                $produk->produk_terjemah = $fileNameTerjemah;
            }

            // Simpan perubahan
            $produk->save();

            $produk_cluster = $request->get('produk_cluster');

            /**
             * Menghapus data produk_cluster berdasarkan produk_id yang diinputkan oleh user.
             */
            t_produk_cluster::where('produk_id', $id)->delete();

            /**
             * Menyimpan data produk_cluster ke dalam database.
             */
            foreach ($produk_cluster as $value) {
                t_produk_cluster::create([
                    'produk_id' => $id,
                    'cluster_id' => $value
                ]);
            }

            $produk_tema_id = $request->get('produk_tema_id');

            /**
             * Menghapus data produk_tema berdasarkan produk_id yang diinputkan oleh user.
             */
            t_produk_tema::where('produk_id', $id)->delete();

            /**
             * Menyimpan data produk_tema ke dalam database.
             */
            foreach ($produk_tema_id as $value) {
                t_produk_tema::create([
                    'produk_id' => $id,
                    'tema_id' => $value
                ]);
            }

            /**
             * Menyimpan file lampiran ke dalam folder
             */
            if ($request->hasFile('lampiran_nama')) {
                $request->file('lampiran_nama')->move('dokumen/', $request->file('lampiran_nama')->getClientOriginalName());
                $create_lampiran = [
                    'lampiran_produk_id' => $produk->produk_id,
                    'lampiran_nama' => $request->file('lampiran_nama')->getClientOriginalName(),
                ];
                t_lampiran::create($create_lampiran);

                // $lampiran = t_lampiran::where('lampiran_nama', $request->file('lampiran_nama')->getClientOriginalName())->first();
                // if(!$lampiran) {

                // } else {
                //     $request->file('lampiran_nama')->move('lampiran/', $request->file('lampiran_nama')->getClientOriginalName());
                //     // jika datanya mau diupdate
                //     // $lampiran->lampiran_nama = $request->file('lampiran_nama')->getClientOriginalName();
                //     // $lampiran->save();

                //     // jika datanya mau diinsert aja
                //     $create_lampiran = [
                //         'lampiran_produk_id' => $produk->produk_id,
                //         'lampiran_nama' => $request->file('lampiran_nama')->getClientOriginalName(),
                //     ];
                //     t_lampiran::create($create_lampiran);
                // }
            }

            /**
             * Jika data berhasil diperbarui, maka user akan diarahkan kembali ke halaman peraturan dengan pesan sukses.
             */
            return redirect()->route('peraturan')->with('success', 'Data berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {

            /**
             * Jika terjadi kesalahan, maka user akan diarahkan kembali ke halaman edit peraturan dengan pesan error.
             */
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Throwable $th) {

            /**
             * Jika terjadi kesalahan, maka user akan diarahkan kembali ke halaman edit peraturan dengan pesan error.
             */
            return redirect()->route('peraturan')->with('error', 'Data gagal diperbarui.');
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
     * fungsi yang digunakan untuk menghapus data peraturan
     */
    public function destroy($id)
    {
        try {

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
            $lampirans = t_lampiran::where('lampiran_produk_id', $produk->produk_id)->get();
            foreach ($lampirans as $lampiran) {
                if (File::exists(public_path('dokumen/' . $lampiran->lampiran_nama))) {
                    File::delete(public_path('dokumen/' . $lampiran->lampiran_nama));
                }
                $lampiran->delete();
            }

            // Delete the produk record
            t_produk_cluster::where('produk_id', $produk->produk_id)->delete();
            t_produk_tema::where('produk_id', $produk->produk_id)->delete();
            $produk->delete();

            /**
             * Jika data berhasil dihapus, maka user akan diarahkan kembali ke halaman peraturan dengan pesan sukses.
             */
            return redirect()->route('peraturan')->with('success', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {

            /**
             * Jika terjadi kesalahan, maka user akan diarahkan kembali ke halaman peraturan dengan pesan error.
             */
            return redirect()->route('peraturan')->with('error', 'Data gagal dihapus.');
        }
    }

    /**
     * fungsi yang digunakan untuk menampilkan detail peraturan
     */
    public function detailPeraturan($id)
    {
        /**
         * Mengambil data peraturan berdasarkan id yang diinputkan oleh user. Data yang diambil adalah data peraturan yang memiliki id yang sama dengan id yang diinputkan oleh user. Data yang diambil juga berelasi dengan tabel cluster dan tema
         */
        $produk = t_produk::where('produk_id', $id)->with(['clusters', 'temas'])->first();
        $jenis = r_jenis::where('jenis_id', 1)->first();
        $clusters = r_cluster::all();
        $produks = t_produk::all();
        $temas = r_tema::all();
        $lampiran = t_lampiran::where('lampiran_produk_id', $produk->produk_id)->orderBy('lampiran_id', 'desc')->first();
        return view('peraturan.detail', [
            'produk' => $produk,
            'clusters' => $clusters,
            'temas' => $temas,
            'jenis' => $jenis,
            'produks' => $produks,
            'lampiran' => $lampiran,
        ]);
    }

    /**
     * fungsi yang digunakan untuk menampilkan halaman verifikasi peraturan
     */
    public function viewVerifikasi()
    {

        /**
         * variabel ini digunakan untuk menyimpan data t_produk 
         */
        $produks = [];

        /**
         * Jika user yang login memiliki role operator, maka data yang diambil adalah data peraturan yang memiliki produk_jenis_id 1 (peraturan) dan status verifikasi adalah 1. Data diurutkan berdasarkan produk_id secara descending dan di paginasi sebanyak 10 data. Data yang diambil juga berelasi dengan model t_verifikasi_peraturan sebagai pivot table.
         */
        if (Gate::allows('operator')) {
            $produks = t_produk::where('produk_jenis_id', '1')->orderBy('produk_id', 'desc')
                ->whereHas('verifikasiPeraturanLatest', function ($query) {
                    $query->where('status', '1');
                })
                ->with('verifikasiPeraturanLatest')
                ->paginate(10);
        }

        /**
         * Jika user yang login memiliki role verifikator, maka data yang diambil adalah data peraturan yang memiliki produk_jenis_id 1 (peraturan) dan status verifikasi adalah 1 dan aksi verifikasi adalah 1. Data diurutkan berdasarkan produk_id secara descending dan di paginasi sebanyak 10 data. Data yang diambil juga berelasi dengan model t_verifikasi_peraturan sebagai pivot table.
         */
        if (Gate::allows('verifikator')) {
            $produks = t_produk::where('produk_jenis_id', '1')->orderBy('produk_id', 'desc')
                ->whereHas('verifikasiPeraturanLatest', function ($query) {
                    $query->where('status', '1')->where('aksi', '1');
                })
                ->with('verifikasiPeraturanLatest')
                ->paginate(10);
        }

        /**
         * Jika user yang login memiliki role biro hukum, maka data yang diambil adalah data peraturan yang memiliki produk_jenis_id 1 (peraturan) dan status verifikasi adalah 1 dan aksi verifikasi adalah 3. Data diurutkan berdasarkan produk_id secara descending dan di paginasi sebanyak 10 data. Data yang diambil juga berelasi dengan model t_verifikasi_peraturan sebagai pivot table.
         */
        if (Gate::allows('birohukum')) {
            $produks = t_produk::where('produk_jenis_id', '1')->orderBy('produk_id', 'desc')
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
}
