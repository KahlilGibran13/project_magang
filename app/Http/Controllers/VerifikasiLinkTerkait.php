<?php

namespace App\Http\Controllers;

use App\Models\t_linkterkait;
use App\Models\t_verifikasi_linkterkait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class VerifikasiLinkTerkait extends Controller
{
    // Fungsi yang digunakan untuk mengirim data verifikasi
    public function send(Request $request)
    {
        $verifikasi_id = $request->get('verifikasi_id');
        $link_id = $request->get('link_id');
        $auth = Auth::user();

        $verifikasi = [];

        DB::beginTransaction();
        try {
            if ($verifikasi_id != null) {
                $verifikasi = t_verifikasi_linkterkait::find($verifikasi_id);
                $verifikasi->update([
                    'status' => '0',
                ]);

                $verifikasi = t_verifikasi_linkterkait::create([
                    'user_id' => $auth->user_id,
                    'link_id' => $link_id,
                    'status' => '1',
                    'aksi' => '1',
                    'catatan' => '',
                ]);
            } else {
                $verifikasi = t_verifikasi_linkterkait::create([
                    'user_id' => $auth->user_id,
                    'link_id' => $link_id,
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
        $link_id = $request->get('link_id');
        $auth = Auth::user();

        DB::beginTransaction();
        try {
            $verifikasi = [];
            if ($verifikasi_id != null) {
                $verifikasi = t_verifikasi_linkterkait::find($verifikasi_id);
                $verifikasi->update([
                    'status' => '0',
                ]);

                $verifikasi = t_verifikasi_linkterkait::create([
                    'user_id' => $auth->user_id,
                    'link_id' => $link_id,
                    'status' => '1',
                    'aksi' => '6',
                    'catatan' => '',
                ]);
            } else {
                $verifikasi = t_verifikasi_linkterkait::create([
                    'user_id' => $auth->user_id,
                    'link_id' => $link_id,
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

    // Fungsi yang digunakan untuk menampilkan data verifikasi
    public function viewVerifikasi()
    {
        $linkterkaits = [];

        if (Gate::allows('operator')) {
            $linkterkaits = t_linkterkait::whereHas('verifikasiLinkTerkaitLatest', function ($query) {
                $query->where('status', '1');
            })
                ->with('verifikasiLinkTerkaitLatest')
                ->paginate(5);
        }

        if (Gate::allows('verifikator')) {
            $linkterkaits = t_linkterkait::whereHas('verifikasiLinkTerkaitLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '1');
            })
                ->with('verifikasiLinkTerkaitLatest')
                ->paginate(5);
        }

        if (Gate::allows('birohukum')) {
            $linkterkaits = t_linkterkait::whereHas('verifikasiLinkTerkaitLatest', function ($query) {
                $query->where('status', '1')->where('aksi', '3');
            })
                ->with('verifikasiLinkTerkaitLatest')
                ->paginate(5);
        }
        // return response()->json($linkterkaits);
        return view('linkterkait.verifikasi.index', [
            'linkterkaits' => $linkterkaits
        ]);
    }

    // Fungsi yang digunakan untuk menampilkan halaman verifikasi berdasarkan id
    public function verifikasi($id)
    {
        $linkterkait = t_linkterkait::where('link_id', $id)->with('verifikasiLinkTerkaitLatest')->first();
        return view('linkterkait.verifikasi.verifikasi',[
            'linkterkait' => $linkterkait
        ]);
    }

    // Fungsi yang digunakan untuk menyimpan data verifikasi
    public function storeVerifikasi(Request $request)
    {
        $aksi = $request->get('aksi');
        $link_id = $request->get('link_id');
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

            $verifikasi = t_verifikasi_linkterkait::find($verifikasi_id);
            $verifikasi->update([
                'status' => '0'
            ]);

            $verifikasi = t_verifikasi_linkterkait::create([
                'user_id' => $auth->user_id,
                'link_id' => $link_id,
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
