@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-file-alt"></i> Laporan Penilaian</h5>
        <div>
            <a href="{{ url('/laporan/cetak') }}" class="btn btn-light btn-sm">
                <i class="fas fa-print"></i> Cetak PDF
            </a>
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-light btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <i class="fas fa-calendar-alt"></i> Periode: <strong>{{ date('F Y', strtotime($periode)) }}</strong>
            <span class="badge bg-primary ms-2"><i class="fas fa-users"></i> {{ count($results) }} Karyawan</span>
        </div>

        @if($winner)
        <div class="alert alert-warning">
            <h5><i class="fas fa-crown text-warning"></i> Star of the Month: <strong>{{ $winner['karyawan']->nama }}</strong></h5>
            <p>Divisi: {{ $winner['karyawan']->divisi }} | Skor: {{ $winner['skor'] }}</p>
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Rank</th>
                        <th>Nama Karyawan</th>
                        <th>Divisi</th>
                        @foreach($kriterias as $kriteria)
                            <th>{{ $kriteria->nama_kriteria }}</th>
                        @endforeach
                        <th>Total Skor</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $index => $result)
                    <tr class="{{ $index == 0 ? 'table-warning' : '' }}">
                        <td>
                            @if($index == 0)
                                <span class="badge bg-warning text-dark">⭐ 1</span>
                            @elseif($index == 1)
                                <span class="badge bg-secondary">2</span>
                            @elseif($index == 2)
                                <span class="badge bg-danger">3</span>
                            @else
                                <span class="badge bg-dark">{{ $index + 1 }}</span>
                            @endif
                        </td>
                        <td><strong>{{ $result['karyawan']->nama }}</strong></td>
                        <td>{{ $result['karyawan']->divisi }}</td>
                        @foreach($kriterias as $kriteria)
                            <td>{{ $result['detail'][$kriteria->nama_kriteria] ?? 0 }}</td>
                        @endforeach
                        <td><strong>{{ $result['skor'] }}</strong></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ count($kriterias) + 4 }}" class="text-center">
                            Belum ada data penilaian
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3 text-muted small">
            <i class="fas fa-print"></i> Dicetak: {{ date('d F Y H:i:s') }}
        </div>
    </div>
</div>
@endsection