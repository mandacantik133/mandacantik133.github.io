<?php
namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Support\Facades\DB;

class HasilController extends Controller
{
    public function index()
    {
        $periode = date('Y-m-01');
        
        // Ambil data dari database
        $karyawans = Karyawan::all();
        $kriterias = Kriteria::all();
        $totalBobot = $kriterias->sum('bobot');
        
        // Hitung max value tiap kriteria
        $maxValues = [];
        foreach ($kriterias as $kriteria) {
            $max = Penilaian::where('kriteria_id', $kriteria->id)
                ->where('periode', $periode)
                ->max('nilai');
            $maxValues[$kriteria->id] = $max ?: 1;
        }
        
        // Hitung skor SAW
        $results = [];
        foreach ($karyawans as $karyawan) {
            $totalSkor = 0;
            $normalisasiData = [];
            
            foreach ($kriterias as $kriteria) {
                $nilai = Penilaian::where('karyawan_id', $karyawan->id)
                    ->where('kriteria_id', $kriteria->id)
                    ->where('periode', $periode)
                    ->value('nilai');
                
                if ($nilai) {
                    $normalisasi = $nilai / $maxValues[$kriteria->id];
                    $bobotNormal = $kriteria->bobot / $totalBobot;
                    $nilaiAkhir = $normalisasi * $bobotNormal;
                    $totalSkor += $nilaiAkhir;
                    
                    $normalisasiData[] = [
                        'kriteria' => $kriteria->nama_kriteria,
                        'nilai_mentah' => $nilai,
                        'max_kriteria' => $maxValues[$kriteria->id],
                        'normalisasi' => round($normalisasi, 4),
                        'bobot' => $kriteria->bobot,
                        'nilai_akhir' => round($nilaiAkhir, 4)
                    ];
                } else {
                    $normalisasiData[] = [
                        'kriteria' => $kriteria->nama_kriteria,
                        'nilai_mentah' => 0,
                        'max_kriteria' => $maxValues[$kriteria->id],
                        'normalisasi' => 0,
                        'bobot' => $kriteria->bobot,
                        'nilai_akhir' => 0
                    ];
                }
            }
            
            $results[] = [
                'karyawan' => $karyawan,
                'total_skor' => round($totalSkor * 100, 2),
                'normalisasi' => $normalisasiData
            ];
        }
        
        usort($results, function($a, $b) {
            return $b['total_skor'] <=> $a['total_skor'];
        });
        
        return view('hasil.index', compact('results', 'periode', 'kriterias'));
    }
    
    public function cetak()
    {
        $periode = date('Y-m-01');
        
        $karyawans = Karyawan::all();
        $kriterias = Kriteria::all();
        $totalBobot = $kriterias->sum('bobot');
        
        $maxValues = [];
        foreach ($kriterias as $kriteria) {
            $max = Penilaian::where('kriteria_id', $kriteria->id)
                ->where('periode', $periode)
                ->max('nilai');
            $maxValues[$kriteria->id] = $max ?: 1;
        }
        
        $results = [];
        foreach ($karyawans as $karyawan) {
            $totalSkor = 0;
            
            foreach ($kriterias as $kriteria) {
                $nilai = Penilaian::where('karyawan_id', $karyawan->id)
                    ->where('kriteria_id', $kriteria->id)
                    ->where('periode', $periode)
                    ->value('nilai');
                
                if ($nilai) {
                    $normalisasi = $nilai / $maxValues[$kriteria->id];
                    $bobotNormal = $kriteria->bobot / $totalBobot;
                    $totalSkor += $normalisasi * $bobotNormal;
                }
            }
            
            $results[] = [
                'karyawan' => $karyawan,
                'total_skor' => round($totalSkor * 100, 2)
            ];
        }
        
        usort($results, function($a, $b) {
            return $b['total_skor'] <=> $a['total_skor'];
        });
        
        return view('hasil.cetak', compact('results', 'periode'));
    }
}