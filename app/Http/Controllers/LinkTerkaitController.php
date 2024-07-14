<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\t_linkterkait;

class LinkTerkaitController extends Controller
{
    public function index()
    {
        $linkterkaits = t_linkterkait::with('verifikasiLinkTerkaitLatest')->orderBy('link_id', 'desc')->paginate(5);

        return view('linkterkait.index', compact('linkterkaits'));
    }

    public function create()
    {
        return view('linkterkait.create');
    }

    public function store(Request $request){
        $request->validate([
            'link_url'=> 'required|max:60',
            'link_instansi'=> 'required|max:60',
        ]);
        
        $linkterkait = t_linkterkait::create($request->all());
        if($request->hasFile('link_logo')){
            $request->file('link_logo')->move('assets/', $request->file('link_logo')->getClientOriginalName());
            $linkterkait->link_logo = $request->file('link_logo')->getClientOriginalName();
            $linkterkait->save();
        }
        return redirect('/linkterkait')  
            ->with('success','Item created successfully.');
    }

    public function edit($id)
    {
        $linkterkait = t_linkterkait::where('link_id', $id)->with('verifikasiLinkTerkaitLatest')->first();
        return view('linkterkait.edit',[
            'linkterkait' => $linkterkait
        ]);
    }

    public function update(Request $request, $id)
    {
        $linkterkait = t_linkterkait::find($id);
        $linkterkait->link_instansi = $request->link_instansi;
        $linkterkait->link_url = $request->link_url;
        if($request->hasFile('link_logo')){
            $request->file('link_logo')->move('assets/', $request->file('link_logo')->getClientOriginalName());
            $linkterkait->link_logo = $request->file('link_logo')->getClientOriginalName();
            $linkterkait->save();
        }
        $linkterkait->save();
        return redirect('/linkterkait')  
            ->with('success','Item updated successfully.');
    }

    public function destroy($id)
    {
        $linkterkait = t_linkterkait::findOrFail($id);
        $linkterkait->delete();

        return redirect('/linkterkait')
            ->with('success', 'Item deleted successfully.');
    }
    /**
     * menampilkan detail link terkait
     */
    public function detail($id)
    {
        /**
         * Mengambil data link terkait berdasarkan id yang diinputkan oleh user. Data yang diambil juga berelasi dengan model temas.
         */
        $linkterkait = t_linkterkait::where('link_id', $id)->with('verifikasiLinkTerkaitLatest')->first();
        return view('linkterkait.detail', [
            'linkterkait' => $linkterkait,
        ]);  
    }
}
