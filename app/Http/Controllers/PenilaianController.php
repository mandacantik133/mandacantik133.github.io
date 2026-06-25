<?php
namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::all(); // Ambil dari database
        $kriterias = Kriteria::all(); // Ambil dari database
        $periode = date('Y-m-01');
        
        $nilaiExisting = Penilaian::where('periode', $periode)
            ->get()
            ->groupBy('karyawan_id');
        
        return view('penilaian.index', compact('karyawans', 'kriterias', 'nilaiExisting', 'periode'));
    }
    
    public function store(Request $request)
    {
        $periode = date('Y-m-01');
        
        // Hapus data lama
        Penilaian::where('periode', $periode)->delete();
        
        // Simpan data baru
        foreach ($request->nilai as $karyawanId => $kriteriaValues) {
            foreach ($kriteriaValues as $kriteriaId => $nilai) {
                if ($nilai !== null && $nilai !== '') {
                    Penilaian::create([
                        'karyawan_id' => $karyawanId,
                        'kriteria_id' => $kriteriaId,
                        'nilai' => $nilai,
                        'periode' => $periode
                    ]);
                }
            }
        }
        
        return redirect()->route('hasil.index')->with('success', 'Penilaian berhasil disimpan!');
    }
}