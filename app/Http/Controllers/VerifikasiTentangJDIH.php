<?php

namespace App\Http\Controllers;

use App\Models\t_tentang;
use App\Models\t_verifikasi_tentang_jdih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class VerifikasiTentangJDIH extends Controller
{
    // Fungsi yang digunakan untuk mengirim data verifikasi
    public function send(Request $request)
    {
        $verifikasi_id = $request->get('verifikasi_id');
        $tentang_id = $request->get('tentang_id');
        $auth = Auth::user();

        $verifikasi = [];

        DB::beginTransaction();
        try {
            if ($verifikasi_id != null) {
                $verifikasi = t_verifikasi_tentang_jdih::find($verifikasi_id);
                $verifikasi->update([
                    'status' => '0',
                ]);

                $verifikasi = t_verifikasi_tentang_jdih::create([
                    'user_id' => $auth->user_id,
                    'tentang_id' => $tentang_id,
                    'status' => '1',
                    'aksi' => '1',
                    'catatan' => '',
                ]);
            } else {
                $verifikasi = t_verifikasi_tentang_jdih::create([
                    'user_id' => $auth->user_id,
                    'tentang_id' => $tentang_id,
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
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    // Fungsi yang digunakan untuk menarik data verifikasi
    public function tarik(Request $request)
    {
        $verifikasi_id = $request->get('verifikasi_id');
        $tentang_id = $request->get('tentang_id');
        $auth = Auth::user();

        DB::beginTransaction();
        try {
            $verifikasi = [];
            if ($verifikasi_id != null) {
                $verifikasi = t_verifikasi_tentang_jdih::find($verifikasi_id);
                $verifikasi->update([
                    'status' => '0',
                ]);

                $verifikasi = t_verifikasi_tentang_jdih::create([
                    'user_id' => $auth->user_id,
                    'tentang_id' => $tentang_id,
                    'status' => '1',
                    'aksi' => '6',
                    'catatan' => '',
                ]);
            } else {
                $verifikasi = t_verifikasi_tentang_jdih::create([
                    'user_id' => $auth->user_id,
                    'tentang_id' => $tentang_id,
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

    // Fungsi yang digunakan untuk menampilkan halaman verifikasi
    public function viewVerifikasi()
    {
        $tentang = [];

        if (Gate::allows('operator')) {
            $tentang = t_tentang::whereHas('verifikasiTentangJDIHLatest', function ($query) {
                $query->where('status', '1');
            })
                ->with('verifikasiTentangJDIHLatest')
                ->first();
        }

        if (Gate::allows('verifikator')) {
            $tentang = t_tentang::whereHas('verifikasiTentangJDIHLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '1');
            })
                ->with('verifikasiTentangJDIHLatest')
                ->first();
        }

        if (Gate::allows('birohukum')) {
            $tentang = t_tentang::whereHas('verifikasiTentangJDIHLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '3');
            })
                ->with('verifikasiTentangJDIHLatest')
                ->first();
        }
        // return response()->json($tentang);
        return view('tentang.verifikasi.index', [
            'tentang' => $tentang
        ]);
    }

    // Fungsi yang digunakan untuk menyimpan data verifikasi
    public function storeVerifikasi(Request $request)
    {
        $aksi = $request->get('aksi');
        $tentang_id = $request->get('tentang_id');
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

            $verifikasi = t_verifikasi_tentang_jdih::find($verifikasi_id);
            $verifikasi->update([
                'status' => '0'
            ]);

            $verifikasi = t_verifikasi_tentang_jdih::create([
                'user_id' => $auth->user_id,
                'tentang_id' => $tentang_id,
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
            dd($th);
            return redirect()->back()->with(
                'error',
                'Peraturan gagal diverifikasi'
            );
        }
    }
}
