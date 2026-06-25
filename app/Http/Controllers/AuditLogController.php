<?php
namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = AuditLog::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        // Filter berdasarkan role
        if ($request->filled('role')) {
            $logs = AuditLog::where('role', $request->role)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }
        
        // Filter berdasarkan action
        if ($request->filled('action')) {
            $logs = AuditLog::where('action', $request->action)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }
        
        // Filter tanggal
        if ($request->filled('start_date')) {
            $logs = AuditLog::whereDate('created_at', '>=', $request->start_date)
                ->whereDate('created_at', '<=', $request->end_date ?? date('Y-m-d'))
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }
        
        $actions = AuditLog::distinct()->pluck('action');
        $roles = ['admin', 'hrd', 'manager'];
        
        return view('admin.audit_logs.index', compact('logs', 'actions', 'roles'));
    }
    
    public function show(AuditLog $auditLog)
    {
        return view('admin.audit_logs.show', compact('auditLog'));
    }
}