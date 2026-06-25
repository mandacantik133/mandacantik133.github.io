<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use App\Models\Kriteria;
use App\Models\AuditLog;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $totalKaryawan = Karyawan::count();
        $totalKriteria = Kriteria::count();
        
        // Statistik login per role
        $loginStats = AuditLog::where('action', 'LOGIN')
            ->select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->get();
        
        // Aktivitas terbaru
        $recentActivities = AuditLog::orderBy('created_at', 'desc')->limit(10)->get();
        
        return view('admin.dashboard', compact(
            'totalUsers', 'activeUsers', 'totalKaryawan', 
            'totalKriteria', 'loginStats', 'recentActivities'
        ));
    }
}