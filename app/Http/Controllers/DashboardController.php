<?php
namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKaryawan = Karyawan::count();
        $totalKriteria = Kriteria::count();
        $periode = date('Y-m-01');

        // Hitung ranking
        $karyawans = Karyawan::all();
        $kriterias = Kriteria::all();
        $totalBobot = $kriterias->sum('bobot');

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

        $winner = count($results) > 0 ? $results[0] : null;

        return view('dashboard', compact('totalKaryawan', 'totalKriteria', 'winner'));
    }
}