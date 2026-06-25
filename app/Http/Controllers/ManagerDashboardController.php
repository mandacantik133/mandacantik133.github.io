<?php
namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Penilaian;
use Illuminate\Support\Facades\DB;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        $periode = date('Y-m-01');
        
        // Hasil SAW untuk periode ini
        $kriterias = \App\Models\Kriteria::all();
        $totalBobot = $kriterias->sum('bobot');
        
        $karyawans = Karyawan::all();
        $results = [];
        
        foreach ($karyawans as $karyawan) {
            $totalSkor = 0;
            foreach ($kriterias as $kriteria) {
                $nilai = Penilaian::where('karyawan_id', $karyawan->id)
                    ->where('kriteria_id', $kriteria->id)
                    ->where('periode', $periode)
                    ->value('nilai');
                
                if ($nilai) {
                    $max = Penilaian::where('kriteria_id', $kriteria->id)
                        ->where('periode', $periode)
                        ->max('nilai') ?: 1;
                    $normalisasi = $nilai / $max;
                    $bobotNormal = $kriteria->bobot / $totalBobot;
                    $totalSkor += $normalisasi * $bobotNormal;
                }
            }
            $results[] = [
                'karyawan' => $karyawan,
                'skor' => round($totalSkor * 100, 2)
            ];
        }
        
        usort($results, function($a, $b) {
            return $b['skor'] <=> $a['skor'];
        });
        
        $top3 = array_slice($results, 0, 3);
        
        return view('manager.dashboard', compact('top3', 'periode'));
    }
}