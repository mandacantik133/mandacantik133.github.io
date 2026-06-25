<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $periode = date('Y-m-01');
        $karyawans = Karyawan::all();
        $kriterias = Kriteria::all();
        $totalBobot = $kriterias->sum('bobot');

        $results = [];
        foreach ($karyawans as $karyawan) {
            $totalSkor = 0;
            $detailNilai = [];
            foreach ($kriterias as $kriteria) {
                $nilai = Penilaian::where('karyawan_id', $karyawan->id)
                    ->where('kriteria_id', $kriteria->id)
                    ->where('periode', $periode)
                    ->value('nilai');
                
                $detailNilai[$kriteria->nama_kriteria] = $nilai ?? 0;
                
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
                'skor' => round($totalSkor * 100, 2),
                'detail' => $detailNilai
            ];
        }

        usort($results, function($a, $b) {
            return $b['skor'] <=> $a['skor'];
        });

        $winner = count($results) > 0 ? $results[0] : null;

        return view('laporan.index', compact('results', 'periode', 'kriterias', 'winner'));
    }

    public function cetak()
    {
        $periode = date('Y-m-01');
        $karyawans = Karyawan::all();
        $kriterias = Kriteria::all();
        $totalBobot = $kriterias->sum('bobot');

        $results = [];
        foreach ($karyawans as $karyawan) {
            $totalSkor = 0;
            $detailNilai = [];
            foreach ($kriterias as $kriteria) {
                $nilai = Penilaian::where('karyawan_id', $karyawan->id)
                    ->where('kriteria_id', $kriteria->id)
                    ->where('periode', $periode)
                    ->value('nilai');
                
                $detailNilai[$kriteria->nama_kriteria] = $nilai ?? 0;
                
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
                'skor' => round($totalSkor * 100, 2),
                'detail' => $detailNilai
            ];
        }

        usort($results, function($a, $b) {
            return $b['skor'] <=> $a['skor'];
        });

        return view('laporan.cetak', compact('results', 'periode', 'kriterias'));
    }
}