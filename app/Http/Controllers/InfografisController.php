<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\t_infografis;

class InfografisController extends Controller
{
    public function index()
    {
        $infografis = t_infografis::with('verifikasiInfografisLatest')->orderBy('infografis_id', 'desc')->paginate(5);
        return view('infografis.index', compact('infografis'));
    }

    public function create()
    {
        return view('infografis.create',[
            // 'role'=>Role::all()
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'infografis_nama'=> 'required|max:60',
        ]);
        
        $infografis = t_infografis::create($request->all());
        if($request->hasFile('infografis_gambar')){
            $request->file('infografis_gambar')->move('assets/', $request->file('infografis_gambar')->getClientOriginalName());
            $infografis->infografis_gambar = $request->file('infografis_gambar')->getClientOriginalName();
            $infografis->save();
        }
        return redirect('/infografis')  
            ->with('success','Item Created successfully.');
    }

    public function edit($id)
    {
        $infografis = t_infografis::where('infografis_id', $id)->with('verifikasiInfografisLatest')->first();
        return view('infografis.edit',[
            'infografis' => $infografis
        ]);
    }

    public function update(Request $request, $id)
    {
        $infografis = t_infografis::find($id);
        $infografis->infografis_nama = $request->infografis_nama;
        if($request->hasFile('infografis_gambar')){
            $request->file('infografis_gambar')->move('assets/', $request->file('infografis_gambar')->getClientOriginalName());
            $infografis->infografis_gambar = $request->file('infografis_gambar')->getClientOriginalName();
            $infografis->save();
        }
        $infografis->save();
        return redirect('/infografis')  
            ->with('success','Item Created successfully.');
    }

    public function destroy($id)
    {
        $infografis = t_infografis::findOrFail($id);
        $infografis->delete();

        return redirect('/infografis')
            ->with('success', 'Item deleted successfully.');
    }

    /**
     * menampilkan detail intografis
     */
    public function detail($id)
    {
        /**
         * Mengambil data intografis berdasarkan id yang diinputkan oleh user. Data yang diambil juga berelasi dengan model temas.
         */
        $infografis = t_infografis::where('infografis_id', $id)->with('verifikasiInfografisLatest')->first();
        return view('infografis.detail', [
            'infografis' => $infografis,
        ]);  
    }
}

