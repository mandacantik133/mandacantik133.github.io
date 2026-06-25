<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $fillable = ['karyawan_id', 'kriteria_id', 'nilai', 'periode'];
    
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
    
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}