@extends('layouts.app')

@section('title', 'Hasil SAW')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="fas fa-chart-bar"></i> Hasil Perhitungan SAW</h2>
    <div>
        <a href="{{ route('hasil.cetak') }}" class="btn btn-info">
            <i class="fas fa-print"></i> Cetak PDF
        </a>
        <a href="{{ route('penilaian') }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Nilai
        </a>
    </div>
</div>

<div class="alert alert-info">
    Periode: <strong>{{ date('F Y', strtotime($periode)) }}</strong>
    <br><small>Total Karyawan: {{ count($results) }} | Total Kriteria: {{ $kriterias->count() }}</small>
</div>

<div class="card">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0"><i class="fas fa-trophy"></i> Ranking Karyawan</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Rank</th>
                        <th>Nama Karyawan</th>
                        <th>Divisi</th>
                        <th>Total Skor</th>
                        <th>Predikat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $index => $result)
                    <tr class="{{ $index == 0 ? 'table-warning' : '' }}">
                        <td>
                            @if($index == 0)
                                <span class="badge bg-warning text-dark" style="font-size:14px;">
                                    <i class="fas fa-crown"></i> #1
                                </span>
                            @else
                                <span class="badge bg-secondary">#{{ $index + 1 }}</span>
                            @endif
                        </td>
                        <td><strong>{{ $result['karyawan']->nama }}</strong></td>
                        <td>{{ $result['karyawan']->divisi }}</td>
                        <td><strong class="text-success">{{ $result['total_skor'] }}</strong></td>
                        <td>
                            @if($index == 0)
                                <span class="badge bg-warning text-dark">🏆 STAR OF THE MONTH</span>
                            @elseif($index <= 2)
                                <span class="badge bg-info">🏅 Runner Up</span>
                            @elseif($index <= 5)
                                <span class="badge bg-primary">⭐ Top 5</span>
                            @else
                                <span class="badge bg-secondary">Peserta</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data penilaian</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Detail Pemenang -->
@if(count($results) > 0)
<div class="card mt-4">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="fas fa-calculator"></i> Detail Perhitungan SAW</h5>
    </div>
    <div class="card-body">
        <h5 class="text-center mb-3">
            🏆 <strong>{{ $results[0]['karyawan']->nama }}</strong> - Star of the Month
            <br><small>Total Skor: {{ $results[0]['total_skor'] }}</small>
        </h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Kriteria</th>
                        <th>Nilai Mentah</th>
                        <th>Max Kriteria</th>
                        <th>Normalisasi</th>
                        <th>Bobot</th>
                        <th>Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results[0]['normalisasi'] as $detail)
                    <tr>
                        <td><strong>{{ $detail['kriteria'] }}</strong></td>
                        <td>{{ $detail['nilai_mentah'] }}</td>
                        <td>{{ $detail['max_kriteria'] }}</td>
                        <td>{{ $detail['normalisasi'] }}</td>
                        <td>{{ $detail['bobot'] }}%</td>
                        <td>{{ $detail['nilai_akhir'] }}</td>
                    </tr>
                    @endforeach
                    <tr class="table-success">
                        <td colspan="5" align="right"><strong>TOTAL SKOR</strong></td>
                        <td><strong>{{ $results[0]['total_skor'] }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="alert alert-secondary mt-2">
            <strong>Rumus SAW:</strong> 
            Normalisasi = Nilai / Max Kriteria <br>
            Nilai Akhir = Normalisasi × (Bobot / Total Bobot) <br>
            Total Skor = Σ Nilai Akhir × 100
        </div>
    </div>
</div>
@endif
@endsection