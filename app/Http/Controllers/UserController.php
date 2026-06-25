<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    
    public function create()
    {
        return view('admin.users.form');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
            'nama_lengkap' => 'required'
        ]);
        
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'nama_lengkap' => $request->nama_lengkap,
            'is_active' => $request->has('is_active')
        ]);
        
        AuditLog::create([
            'user_id' => auth()->id(),
            'username' => auth()->user()->username,
            'role' => auth()->user()->role,
            'action' => 'CREATE_USER',
            'table_name' => 'users',
            'record_id' => $user->id,
            'new_data' => json_encode($user->toArray()),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        
        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
    }
    
    public function edit(User $user)
    {
        return view('admin.users.form', compact('user'));
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
            'nama_lengkap' => 'required'
        ]);
        
        $oldData = $user->toArray();
        
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'nama_lengkap' => $request->nama_lengkap,
            'is_active' => $request->has('is_active')
        ]);
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }
        
        AuditLog::create([
            'user_id' => auth()->id(),
            'username' => auth()->user()->username,
            'role' => auth()->user()->role,
            'action' => 'UPDATE_USER',
            'table_name' => 'users',
            'record_id' => $user->id,
            'old_data' => json_encode($oldData),
            'new_data' => json_encode($user->toArray()),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        
        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate');
    }
    
    public function destroy(User $user)
    {
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri!');
        }
        
        $oldData = $user->toArray();
        $user->delete();
        
        AuditLog::create([
            'user_id' => auth()->id(),
            'username' => auth()->user()->username,
            'role' => auth()->user()->role,
            'action' => 'DELETE_USER',
            'table_name' => 'users',
            'record_id' => $user->id,
            'old_data' => json_encode($oldData),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
        
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus');
    }
}