<?php
namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::all(); // Ambil dari database
        return view('karyawan.index', compact('karyawans'));
    }
    
    public function create()
    {
        return view('karyawan.form');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:karyawans,nik',
            'nama' => 'required|string|max:100',
            'divisi' => 'required|string|max:50'
        ]);
        
        Karyawan::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'divisi' => $request->divisi
        ]);
        
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan!');
    }
    
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.form', compact('karyawan'));
    }
    
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        
        $request->validate([
            'nik' => 'required|unique:karyawans,nik,' . $id,
            'nama' => 'required|string|max:100',
            'divisi' => 'required|string|max:50'
        ]);
        
        $karyawan->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'divisi' => $request->divisi
        ]);
        
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diupdate!');
    }
    
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        
        // Hapus juga data penilaian terkait
        $karyawan->penilaian()->delete();
        $karyawan->delete();
        
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus!');
    }
}