<?php
namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::all();
        $periode = date('F Y'); // <-- TAMBAHKAN INI
        return view('kriteria.index', compact('kriterias', 'periode'));
    }
    
    public function create()
    {
        $periode = date('F Y');
        return view('kriteria.form', compact('periode'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required|string|max:100',
            'bobot' => 'required|numeric|min:0|max:100',
            'jenis' => 'required|in:benefit,cost'
        ]);
        
        Kriteria::create($request->all());
        
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan!');
    }
    
    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $periode = date('F Y');
        return view('kriteria.form', compact('kriteria', 'periode'));
    }
    
    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::findOrFail($id);
        
        $request->validate([
            'nama_kriteria' => 'required|string|max:100',
            'bobot' => 'required|numeric|min:0|max:100',
            'jenis' => 'required|in:benefit,cost'
        ]);
        
        $kriteria->update($request->all());
        
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diupdate!');
    }
    
    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        
        // Hapus juga data penilaian terkait
        $kriteria->penilaian()->delete();
        $kriteria->delete();
        
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus!');
    }
}