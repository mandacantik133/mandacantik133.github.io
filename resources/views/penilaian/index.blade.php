@extends('layouts.app')

@section('title', 'Input Penilaian')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-pen-square"></i> Input Nilai Karyawan</h5>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <i class="fas fa-calendar"></i> Periode: {{ date('F Y') }}
            <br><small>Total Karyawan: {{ $karyawans->count() }} | Total Kriteria: {{ $kriterias->count() }}</small>
        </div>

        <form action="{{ route('penilaian.store') }}" method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th style="min-width:120px;">Nama Karyawan</th>
                            <th>Divisi</th>
                            @foreach($kriterias as $kriteria)
                                <th style="min-width:100px;">
                                    {{ $kriteria->nama_kriteria }}<br>
                                    <small>(Bobot: {{ $kriteria->bobot }}%)</small>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($karyawans as $karyawan)
                        <tr>
                            <td><strong>{{ $karyawan->nama }}</strong></td>
                            <td>{{ $karyawan->divisi }}</td>
                            @foreach($kriterias as $kriteria)
                                <td>
                                    <input type="number" 
                                           name="nilai[{{ $karyawan->id }}][{{ $kriteria->id }}]" 
                                           class="form-control form-control-sm" 
                                           min="0" 
                                           max="100" 
                                           placeholder="0-100"
                                           value="{{ $nilaiExisting[$karyawan->id][$kriteria->id]->nilai ?? '' }}"
                                           required>
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-success btn-lg">
                <i class="fas fa-save"></i> Simpan Penilaian & Hitung SAW
            </button>
            <a href="{{ route('hasil.index') }}" class="btn btn-info btn-lg">
                <i class="fas fa-chart-bar"></i> Lihat Hasil
            </a>
        </form>
    </div>
</div>
@endsection