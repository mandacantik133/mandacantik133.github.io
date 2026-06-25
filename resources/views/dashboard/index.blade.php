@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-chart-line"></i> Dashboard SPK Star of the Month</h2>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card card-stats bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Total Karyawan</h5>
                        <h2>{{ $totalKaryawan }}</h2>
                    </div>
                    <i class="fas fa-users fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card card-stats bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Total Kriteria</h5>
                        <h2>{{ $totalKriteria }}</h2>
                    </div>
                    <i class="fas fa-sliders-h fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card card-stats bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Periode Aktif</h5>
                        <h5>{{ $periode }}</h5>
                    </div>
                    <i class="fas fa-calendar-alt fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="fas fa-trophy"></i> Pemenang Star of the Month</h5>
    </div>
    <div class="card-body text-center">
        @if($winner)
            <div class="py-4">
                <i class="fas fa-crown fa-5x text-warning mb-3"></i>
                <h2 class="text-success">{{ $winner->karyawan->nama }}</h2>
                <p class="lead">Divisi: {{ $winner->karyawan->divisi }}</p>
                <h4>Total Skor: {{ $winner->total }}</h4>
                <div class="mt-3">
                    <span class="badge bg-success">Star of the Month {{ $periode }}</span>
                </div>
            </div>
        @else
            <div class="py-4">
                <i class="fas fa-star fa-4x text-muted mb-3"></i>
                <p class="lead">Belum ada penilaian untuk periode {{ $periode }}</p>
                <a href="{{ route('penilaian') }}" class="btn btn-primary">Input Penilaian Sekarang</a>
            </div>
        @endif
    </div>
</div>
@endsection