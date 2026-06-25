<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username', 'email', 'password', 'role', 'nama_lengkap', 
        'foto', 'is_active', 'last_login_at', 'last_login_ip'
    ];

    protected $hidden = [
        'password', 'remember_token',
    
    ];
    protected $casts = [
    'is_active' => 'boolean',
];

    // Cek role
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isHRD()
    {
        return $this->role === 'hrd';
    }

    public function isManager()
    {
        return $this->role === 'manager';
    }

    // Relasi ke audit log
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}