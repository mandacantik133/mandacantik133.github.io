@extends('layouts.app')

@section('title', 'Data Kriteria')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="fas fa-sliders-h"></i> Data Kriteria</h2>
    <a href="{{ route('kriteria.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Kriteria
    </a>
</div>

<!-- ===== PERIODE ===== -->
<div class="mb-3">
    <small style="color: #adb5bd;">
        <i class="fas fa-calendar-alt" style="color: #0a1628;"></i>
        Period: <strong>{{ $periode ?? date('F Y') }}</strong>
    </small>
</div>

<div class="alert alert-info">
    <i class="fas fa-info-circle"></i> 
    Total Bobot: <strong>{{ $kriterias->sum('bobot') }}%</strong> 
    @if($kriterias->sum('bobot') != 100)
        <span class="text-danger">(Harus 100% untuk perhitungan akurat!)</span>
    @else
        <span class="text-success">✓ Sudah 100%</span>
    @endif
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot (%)</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kriterias as $index => $kriteria)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $kriteria->nama_kriteria }}</strong></td>
                        <td>{{ $kriteria->bobot }}%</td>
                        <td>
                            <span class="badge {{ $kriteria->jenis == 'benefit' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($kriteria->jenis) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data kriteria</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection