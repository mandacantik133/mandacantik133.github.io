<?php
namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Support\Facades\DB;

class HRDDashboardController extends Controller
{
    public function index()
    {
        $totalKaryawan = Karyawan::count();
        $totalKriteria = Kriteria::count();
        $periode = date('Y-m-01');
        
        // Jumlah karyawan yang sudah dinilai bulan ini
        $sudahDinilai = Penilaian::where('periode', $periode)
            ->distinct('karyawan_id')
            ->count('karyawan_id');
        
        // Pemenang sementara
        $winner = Penilaian::select('karyawan_id', DB::raw('SUM(nilai) as total'))
            ->where('periode', $periode)
            ->groupBy('karyawan_id')
            ->with('karyawan')
            ->orderBy('total', 'desc')
            ->first();
        
        return view('hrd.dashboard', compact('totalKaryawan', 'totalKriteria', 'sudahDinilai', 'winner', 'periode'));
    }
}