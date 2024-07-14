<?php

namespace App\Http\Controllers;

use App\Models\r_cluster;
use App\Models\r_jenis;
use App\Models\r_tema;
use App\Models\t_lampiran;
use App\Models\t_produk;
use App\Models\t_verifikasi_peraturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class Verifikasi extends Controller
{
    public function sendVerifikasi(Request $request)
    {
        $verifikasi_id = $request->get('verifikasi_id');
        $produk_id = $request->get('produk_id');
        $auth = Auth::user();

        $verifikasi = [];

        DB::beginTransaction();
        try {
            if ($verifikasi_id != null) {
                $verifikasi = t_verifikasi_peraturan::find($verifikasi_id);
                $verifikasi->update([
                    'status' => '0',
                ]);

                $verifikasi = t_verifikasi_peraturan::create([
                    'user_id' => $auth->user_id,
                    'produk_id' => $produk_id,
                    'status' => '1',
                    'aksi' => '1',
                    'catatan' => '',
                ]);
            } else {
                $verifikasi = t_verifikasi_peraturan::create([
                    'user_id' => $auth->user_id,
                    'produk_id' => $produk_id,
                    'status' => '1',
                    'aksi' => '1',
                    'catatan' => '',
                ]);
            }

            DB::commit();

            if ($verifikasi) {
                return redirect()->back()->with('success', 'Data berhasil dikirim.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Data gagal dikirim.');
        }
    }

    public function tarikVerifikasi(Request $request)
    {
        $verifikasi_id = $request->get('verifikasi_id');
        $produk_id = $request->get('produk_id');
        $auth = Auth::user();

        DB::beginTransaction();
        try {
            $verifikasi = [];
            if ($verifikasi_id != null) {
                $verifikasi = t_verifikasi_peraturan::find($verifikasi_id);
                $verifikasi->update([
                    'status' => '0',
                ]);

                $verifikasi = t_verifikasi_peraturan::create([
                    'user_id' => $auth->user_id,
                    'produk_id' => $produk_id,
                    'status' => '1',
                    'aksi' => '6',
                    'catatan' => '',
                ]);
            } else {
                $verifikasi = t_verifikasi_peraturan::create([
                    'user_id' => $auth->user_id,
                    'produk_id' => $produk_id,
                    'status' => '1',
                    'aksi' => '6',
                    'catatan' => '',
                ]);
            }

            DB::commit();

            if ($verifikasi) {
                return redirect()->back()->with('success', 'Data berhasil ditarik.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Data gagal ditarik.');
        }
    }

    public function viewVerifikasi()
    {
        $peraturans = [];

        if (Gate::allows('operator')) {
            $peraturans = t_produk::orderBy('produk_id', 'desc')
                ->whereHas('verifikasiPeraturanLatest', function ($query) {
                    $query->where('status', '1');
                })
                ->with('verifikasiPeraturanLatest')
                ->paginate(10);
        }

        if (Gate::allows('verifikator')) {
            $peraturans = t_produk::orderBy('produk_id', 'desc')
                ->whereHas('verifikasiPeraturanLatest', function ($query) {
                    $query->where('status', '1')->where('aksi', '1');
                })
                ->with('verifikasiPeraturanLatest')
                ->paginate(10);
        }

        if (Gate::allows('birohukum')) {
            $peraturans = t_produk::orderBy('produk_id', 'desc')
                ->whereHas('verifikasiPeraturanLatest', function ($query) {
                    $query->where('status', '1')->where('aksi', '3');
                })
                ->with('verifikasiPeraturanLatest')
                ->paginate(10);
        }
        return view('verifikasi.index', [
            'peraturans' => $peraturans
        ]);
    }

    public function verifikasi($id)
    {
        $peraturan = [];
        $jenis = r_jenis::where('jenis_id', 1)->first();
        $clusters = r_cluster::all();
        $temas = r_tema::all();
        $produks = t_produk::all();
        $lampiran = t_lampiran::where('lampiran_produk_id', $id)->orderBy('lampiran_id', 'desc')->first();

        if (Gate::allows('verifikator')) {
            $peraturan = t_produk::orderBy('produk_id', 'desc')
                ->whereHas('verifikasiPeraturanLatest', function ($query) {
                    $query->where('status', '1')->where('aksi', '1');
                })
                ->with(['verifikasiPeraturanLatest', 'temas', 'clusters'])
                ->where('produk_id', $id)
                ->first();
            // return response()->json($peraturan);
            if ($peraturan->verifikasiPeraturanLatest->status == 1 && $peraturan->verifikasiPeraturanLatest->aksi == 1) {
                return view('verifikasi.verifikasi', [
                    'peraturan' => $peraturan,
                    'clusters' => $clusters,
                    'temas' => $temas,
                    'jenis' => $jenis,
                    'produks' => $produks,
                    'lampiran' => $lampiran,
                ]);
            }
        }

        if (Gate::allows('birohukum')) {
            $peraturan = t_produk::orderBy('produk_id', 'desc')
                ->whereHas('verifikasiPeraturanLatest', function ($query) {
                    $query->where('status', '1')->where('aksi', '3');
                })
                ->with(['verifikasiPeraturanLatest', 'temas', 'clusters'])
                ->where('produk_id', $id)
                ->first();
            if ($peraturan->verifikasiPeraturanLatest->status == 1 && $peraturan->verifikasiPeraturanLatest->aksi == 3) {
                return view('verifikasi.verifikasi', [
                    'peraturan' => $peraturan,
                    'clusters' => $clusters,
                    'temas' => $temas,
                    'jenis' => $jenis,
                    'produks' => $produks,
                    'lampiran' => $lampiran,
                ]);
            }
        }

        return redirect()->back()->with(
            'error',
            'Peraturan tidak dapat diverifikasi'
        );
    }

    public function storeVerifikasi(Request $request)
    {
        $aksi = $request->get('aksi');
        $produk_id = $request->get('produk_id');
        $verifikasi_id = $request->get('verifikasi_id');
        $catatan = $request->get('catatan') ?? '';
        $auth = Auth::user();

        DB::beginTransaction();
        try {
            if (Gate::allows('verifikator')) {
                if ($aksi == 1) {
                    $aksi = 3;
                } else {
                    $aksi = 2;
                }
            }

            if (Gate::allows('birohukum')) {
                if ($aksi == 1) {
                    $aksi = 5;
                } else {
                    $aksi = 4;
                }
            }

            $verifikasi = t_verifikasi_peraturan::find($verifikasi_id);
            $verifikasi->update([
                'status' => '0'
            ]);

            $verifikasi = t_verifikasi_peraturan::create([
                'user_id' => $auth->user_id,
                'produk_id' => $produk_id,
                'status' => '1',
                'aksi' => $aksi,
                'catatan' => $catatan
            ]);

            DB::commit();

            return redirect()->route($request->get('page'))->with(
                'success',
                'Peraturan berhasil diverifikasi'
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with(
                'error',
                'Peraturan gagal diverifikasi'
            );
        }
    }
}
