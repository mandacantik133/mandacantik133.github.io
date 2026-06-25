@extends('layouts.app')

@section('title', isset($kriteria) ? 'Edit Kriteria' : 'Tambah Kriteria')

@section('content')
<div class="mb-3">
    <small style="color: #adb5bd;">
        <i class="fas fa-calendar-alt" style="color: #0a1628;"></i>
        Period: <strong>{{ $periode ?? date('F Y') }}</strong>
    </small>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">{{ isset($kriteria) ? 'Edit' : 'Tambah' }} Kriteria</h5>
    </div>
    <div class="card-body">
        <form action="{{ isset($kriteria) ? route('kriteria.update', $kriteria->id) : route('kriteria.store') }}" method="POST">
            @csrf
            @if(isset($kriteria))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Nama Kriteria</label>
                <input type="text" name="nama_kriteria" class="form-control" 
                       value="{{ isset($kriteria) ? $kriteria->nama_kriteria : old('nama_kriteria') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Bobot (%)</label>
                <input type="number" step="0.01" name="bobot" class="form-control" 
                       value="{{ isset($kriteria) ? $kriteria->bobot : old('bobot') }}" required>
                <small class="text-muted">Bobot dalam persen (0-100)</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kriteria</label>
                <select name="jenis" class="form-control" required>
                    <option value="benefit" {{ isset($kriteria) && $kriteria->jenis == 'benefit' ? 'selected' : '' }}>
                        Benefit (Semakin tinggi semakin baik)
                    </option>
                    <option value="cost" {{ isset($kriteria) && $kriteria->jenis == 'cost' ? 'selected' : '' }}>
                        Cost (Semakin rendah semakin baik)
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection