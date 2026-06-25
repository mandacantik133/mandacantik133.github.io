@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4"><i class="fas fa-chart-line"></i> Dashboard SPK Star of the Month</h2>
    
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Karyawan</h5>
                    <h2>{{ $totalKaryawan ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Kriteria</h5>
                    <h2>{{ $totalKriteria ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>Periode Aktif</h5>
                    <h2>{{ $periode ?? date('F Y') }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-warning">
            <h5 class="mb-0">⭐ Star of the Month</h5>
        </div>
        <div class="card-body text-center">
            @if(isset($winner) && $winner)
                <h3>🏆 {{ $winner->karyawan->nama }}</h3>
                <p>Divisi: {{ $winner->karyawan->divisi }}</p>
                <h4>Total Skor: {{ $winner->total }}</h4>
            @else
                <p>Belum ada penilaian untuk bulan ini</p>
                <a href="/penilaian" class="btn btn-primary">Input Penilaian</a>
            @endif
        </div>
    </div>
</div>
@endsection