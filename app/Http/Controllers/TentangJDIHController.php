<?php

namespace App\Http\Controllers;

use App\Models\t_tentang;
use App\Models\t_verifikasi_tentang_jdih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TentangJDIHController extends Controller
{
    public function index(Request $request)
    {
        $tentang = t_tentang::where('tentang_id', 1)->with('verifikasiTentangJDIHLatest')->first();
        // return response()->json($tentang);
        return view('tentang.index', [
            'tentang' => $tentang
        ]);
    }

    public function create()
    {
        return view('tentang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tentang_misi' => 'required',
            'tentang_visi' => 'required',
            'tentang_landasan' => 'required',
            'tentang_struktur' => 'required',
            'tentang_sop' => 'required',
        ]);
        $tentang = t_tentang::create($request->all());
        return redirect()->route('tentang')
            ->with('success', 'Item Created successfully.');
    }

    public function update($id, Request $request)
    {
        $verifikasi_id = $request->get('verifikasi_id');
        $tentang_id = $request->get('tentang_id');
        $auth = Auth::user();

        $verifikasi = [];

        DB::beginTransaction();
        try {
            $tentang = t_tentang::find(1);
            $tentang->tentang_misi = $request->tentang_misi;
            $tentang->tentang_visi = $request->tentang_visi;
            $tentang->tentang_landasan = $request->tentang_landasan;
            $tentang->tentang_struktur = $request->tentang_struktur;
            $tentang->tentang_sop = $request->tentang_sop;
            $tentang->save();

            if ($verifikasi_id != null) {
                $verifikasi = t_verifikasi_tentang_jdih::find($verifikasi_id);
                $verifikasi->update([
                    'status' => '0',
                ]);
                $verifikasi = t_verifikasi_tentang_jdih::create([
                    'user_id' => $auth->user_id,
                    'tentang_id' => $tentang_id,
                    'status' => '1',
                    'aksi' => '0',
                    'catatan' => '',
                ]);
            } else {
                $verifikasi = t_verifikasi_tentang_jdih::create([
                    'user_id' => $auth->user_id,
                    'tentang_id' => $tentang_id,
                    'status' => '1',
                    'aksi' => '0',
                    'catatan' => '',
                ]);
            }

            DB::commit();

            if ($verifikasi) {
                return redirect()->route('tentang')
                    ->with('success', 'Item Created successfully.');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
