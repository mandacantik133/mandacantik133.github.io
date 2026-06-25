@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    /* ============================================================
       GLOBAL STYLE
       ============================================================ */
    .dashboard-wrapper {
        background: #f5f6fa;
        min-height: 100vh;
        padding: 0;
    }

    /* ============================================================
       REKOMENDASI PEMENANG CARD
       ============================================================ */
    .winner-card {
        background: linear-gradient(135deg, #0a1628, #1a2a5c);
        border-radius: 16px;
        padding: 28px 32px;
        color: #ffffff;
        position: relative;
        overflow: hidden;
        margin-bottom: 24px;
    }

    .winner-card::before {
        content: '⭐';
        position: absolute;
        right: 30px;
        top: 20px;
        font-size: 60px;
        opacity: 0.08;
    }

    .winner-card .winner-label {
        color: #f7c948;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 4px;
    }

    .winner-card .winner-label i {
        margin-right: 6px;
    }

    .winner-card .winner-name {
        font-size: 26px;
        font-weight: 800;
        margin: 0;
    }

    .winner-card .winner-dept {
        color: rgba(255,255,255,0.6);
        font-size: 15px;
        margin: 4px 0 12px;
    }

    .winner-card .winner-dept i {
        margin-right: 6px;
        color: #f7c948;
    }

    .winner-card .winner-reason {
        color: rgba(255,255,255,0.8);
        font-size: 13px;
        margin: 0 0 16px;
        padding: 10px 16px;
        background: rgba(255,255,255,0.06);
        border-radius: 8px;
        border-left: 3px solid #f7c948;
    }

    .winner-card .winner-reason i {
        color: #f7c948;
        margin-right: 6px;
    }

    .winner-card .btn-group-custom {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-gold {
        background: #f7c948;
        color: #0a1628;
        border: none;
        padding: 8px 22px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        transition: 0.3s;
    }

    .btn-gold:hover {
        background: #f5c842;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(247,201,72,0.3);
        color: #0a1628;
    }

    .btn-gold i {
        margin-right: 6px;
    }

    .btn-outline-gold {
        background: transparent;
        color: #f7c948;
        border: 2px solid #f7c948;
        padding: 8px 22px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        transition: 0.3s;
    }

    .btn-outline-gold:hover {
        background: #f7c948;
        color: #0a1628;
    }

    .btn-outline-gold i {
        margin-right: 6px;
    }

    /* ============================================================
       STATUS CARDS
       ============================================================ */
    .status-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 16px 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        margin-bottom: 16px;
        border-left: 4px solid #0a1628;
        height: 100%;
    }

    .status-card .label {
        color: #6c757d;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
        margin: 0;
    }

    .status-card .label i {
        margin-right: 4px;
        color: #adb5bd;
    }

    .status-card .value {
        font-size: 24px;
        font-weight: 800;
        color: #0a1628;
        margin: 2px 0 0;
    }

    .status-card .sub {
        color: #adb5bd;
        font-size: 12px;
        margin: 0;
    }

    .status-card .sub .text-success {
        color: #28a745 !important;
    }

    .status-card .sub .text-warning {
        color: #f7c948 !important;
    }

    .status-card.border-gold {
        border-left-color: #f7c948;
    }

    .status-card.border-green {
        border-left-color: #28a745;
    }

    /* ============================================================
       TABLE
       ============================================================ */
    .card-custom {
        background: #ffffff;
        border-radius: 12px;
        border: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .card-custom .card-header {
        background: #0a1628;
        color: #ffffff;
        padding: 14px 20px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-custom .card-header i {
        color: #f7c948;
        font-size: 16px;
    }

    .card-custom .card-body {
        padding: 0;
    }

    .table-custom {
        font-size: 13px;
        margin-bottom: 0;
    }

    .table-custom thead {
        background: #0a1628;
        color: #ffffff;
    }

    .table-custom thead th {
        padding: 10px 14px;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border: none;
    }

    .table-custom tbody td {
        padding: 10px 14px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
        color: #212529;
    }

    .table-custom tbody tr:hover {
        background: #f8f9fa;
    }

    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }

    .rank-badge {
        font-weight: 700;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 12px;
        display: inline-block;
        min-width: 30px;
        text-align: center;
    }

    .rank-badge.gold {
        background: #f7c948;
        color: #0a1628;
    }

    .rank-badge.silver {
        background: #e9ecef;
        color: #6c757d;
    }

    .rank-badge.bronze {
        background: #f8d7b5;
        color: #8b6b4a;
    }

    .rank-badge.navy {
        background: #0a1628;
        color: #ffffff;
    }

    .btn-detail {
        background: transparent;
        color: #0a1628;
        border: 1px solid #e9ecef;
        padding: 4px 16px;
        border-radius: 6px;
        font-size: 12px;
        transition: 0.3s;
    }

    .btn-detail:hover {
        background: #0a1628;
        color: #ffffff;
    }

    /* ============================================================
       GRAFIK
       ============================================================ */
    .chart-box {
        background: #ffffff;
        border-radius: 12px;
        padding: 16px 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        margin-bottom: 16px;
        height: 100%;
    }

    .chart-box .chart-title {
        font-size: 13px;
        font-weight: 600;
        color: #0a1628;
        margin-bottom: 12px;
    }

    .chart-box .chart-title i {
        color: #f7c948;
        margin-right: 6px;
    }

    .chart-container-simple {
        display: flex;
        align-items: flex-end;
        justify-content: space-around;
        height: 130px;
        padding: 10px 0 0;
        gap: 8px;
    }

    .chart-bar-simple {
        flex: 1;
        border-radius: 4px 4px 0 0;
        min-height: 10px;
        max-width: 40px;
        position: relative;
        transition: 0.3s;
    }

    .chart-bar-simple:hover {
        opacity: 0.8;
        transform: scaleY(1.05);
    }

    .chart-bar-simple .bar-label {
        position: absolute;
        bottom: -22px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 9px;
        color: #6c757d;
        font-weight: 500;
        white-space: nowrap;
    }

    .chart-bar-simple .bar-value {
        position: absolute;
        top: -18px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 10px;
        font-weight: 600;
        color: #0a1628;
    }

    .chart-bar-simple.color-1 { background: #0a1628; }
    .chart-bar-simple.color-2 { background: #1a2a5c; }
    .chart-bar-simple.color-3 { background: #2d4373; }
    .chart-bar-simple.color-4 { background: #f7c948; }
    .chart-bar-simple.color-5 { background: #0a1628; }
    .chart-bar-simple.color-6 { background: #1a2a5c; }
    .chart-bar-simple.color-7 { background: #2d4373; }

    /* ============================================================
       RESPONSIVE
       ============================================================ */
    @media (max-width: 768px) {
        .winner-card {
            padding: 20px;
        }

        .winner-card .winner-name {
            font-size: 20px;
        }

        .winner-card .btn-group-custom {
            flex-direction: column;
        }

        .winner-card .btn-group-custom .btn {
            width: 100%;
            text-align: center;
        }

        .status-card .value {
            font-size: 20px;
        }

        .table-custom {
            font-size: 11px;
        }

        .table-custom thead th,
        .table-custom tbody td {
            padding: 6px 8px;
        }

        .chart-container-simple {
            height: 100px;
        }

        .chart-bar-simple .bar-value {
            font-size: 8px;
            top: -14px;
        }

        .chart-bar-simple .bar-label {
            font-size: 7px;
            bottom: -18px;
        }
    }

    @media (max-width: 576px) {
        .winner-card .winner-name {
            font-size: 17px;
        }

        .winner-card .winner-reason {
            font-size: 12px;
        }

        .status-card .value {
            font-size: 17px;
        }

        .status-card .label {
            font-size: 10px;
        }

        .table-custom {
            font-size: 10px;
        }

        .table-custom thead th,
        .table-custom tbody td {
            padding: 4px 6px;
        }

        .rank-badge {
            font-size: 10px;
            padding: 2px 8px;
            min-width: 24px;
        }
    }
</style>

<div class="dashboard-wrapper">

    <!-- ============================================================
    PERIOD
    ============================================================ -->
    <div class="mb-3">
        <small style="color: #adb5bd;">
            <i class="fas fa-calendar-alt" style="color: #0a1628;"></i>
            Period: <strong>{{ date('F Y') }}</strong>
        </small>
    </div>

    <!-- ============================================================
    USER LOGIN INFO
    ============================================================ -->
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap" 
                 style="background: #ffffff; border-radius: 12px; padding: 12px 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); border-left: 4px solid #f7c948;">
                <div>
                    <i class="fas fa-user-circle" style="font-size: 28px; color: #0a1628;"></i>
                    <span style="font-weight: 600; color: #0a1628; font-size: 15px; margin-left: 10px;">
                        {{ auth()->user()->nama_lengkap ?? auth()->user()->username }}
                    </span>
                    <span class="badge" style="background: rgba(247,201,72,0.15); color: #f7c948; font-weight: 600; padding: 4px 12px; margin-left: 8px; border-radius: 20px; font-size: 10px; text-transform: uppercase;">
                        {{ auth()->user()->role }}
                    </span>
                    <span style="color: #adb5bd; font-size: 13px; margin-left: 12px;">
                        <i class="fas fa-envelope"></i> {{ auth()->user()->email }}
                    </span>
                </div>
                <form action="{{ url('/logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm" style="border-radius: 8px; padding: 6px 18px; font-size: 13px; font-weight: 500;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- ============================================================
    REKOMENDASI PEMENANG
    ============================================================ -->
    <div class="winner-card">
        <div class="winner-label">
            <i class="fas fa-crown"></i> REKOMENDASI PEMENANG BULAN INI
        </div>
        <div class="winner-label" style="font-size: 11px; color: rgba(255,255,255,0.4); margin-top: -2px;">
            {{ strtoupper(date('F Y')) }}
        </div>

        @if(isset($winner) && $winner)
            <div class="winner-name">{{ $winner['karyawan']->nama }}</div>
            <div class="winner-dept">
                <i class="fas fa-building"></i> {{ $winner['karyawan']->divisi }}
            </div>
            <div class="winner-reason">
                <i class="fas fa-star"></i>
                Rekomendasi Utama:
                @php
                    $periode = date('Y-m-01');
                    $kriterias = \App\Models\Kriteria::all();
                    $bestCriteria = '';
                    $bestValue = 0;
                    foreach ($kriterias as $k) {
                        $nilai = \App\Models\Penilaian::where('karyawan_id', $winner['karyawan']->id)
                            ->where('kriteria_id', $k->id)
                            ->where('periode', $periode)
                            ->value('nilai');
                        if ($nilai && $nilai > $bestValue) {
                            $bestValue = $nilai;
                            $bestCriteria = $k->nama_kriteria;
                        }
                    }
                @endphp
                @if($bestCriteria)
                    {{ $bestCriteria }} {{ $bestValue }}%,
                @endif
                Absensi 100%,
                Feedback Positif Tamu.
            </div>
            <div class="btn-group-custom">
                <button class="btn-gold" onclick="alert('🏆 {{ $winner['karyawan']->nama }} terpilih sebagai Star of the Month!')">
                    <i class="fas fa-key"></i> Kunci Pemenang
                </button>
                <button class="btn-outline-gold" onclick="window.location.href='{{ url('/hasil/cetak') }}'">
                    <i class="fas fa-file-pdf"></i> Cetak Sertifikat PDF
                </button>
            </div>
        @else
            <div class="winner-name">Belum Ada Pemenang</div>
            <div class="winner-dept">Silakan input penilaian terlebih dahulu</div>
            <div class="winner-reason">
                <i class="fas fa-info-circle"></i>
                Belum ada data penilaian untuk periode ini.
            </div>
            <div class="btn-group-custom">
                <button class="btn-gold" onclick="window.location.href='{{ url('/penilaian') }}'">
                    <i class="fas fa-plus-circle"></i> Mulai Penilaian
                </button>
            </div>
        @endif
    </div>

    <!-- ============================================================
    RINGKASAN STATUS
    ============================================================ -->
    <div class="row g-3 mb-3">
        <div class="col-md-4 col-6">
            <div class="status-card">
                <p class="label"><i class="fas fa-users"></i> Total Crew</p>
                <p class="value">{{ $totalKaryawan ?? 0 }}</p>
                <p class="sub">Karyawan</p>
            </div>
        </div>
        <div class="col-md-4 col-6">
            <div class="status-card border-gold">
                <p class="label"><i class="fas fa-check-circle"></i> Crew Dinilai</p>
                <p class="value">
                    @php
                        $periode = date('Y-m-01');
                        $dinilai = \App\Models\Penilaian::where('periode', $periode)
                            ->distinct('karyawan_id')
                            ->count('karyawan_id');
                    @endphp
                    {{ $dinilai }} / {{ $totalKaryawan ?? 0 }}
                </p>
                <p class="sub">
                    @if($totalKaryawan > 0 && $dinilai == $totalKaryawan)
                        <span class="text-success">✓ Selesai</span>
                    @elseif($dinilai > 0)
                        <span class="text-warning">⏳ Proses</span>
                    @else
                        <span class="text-muted">Belum Dinilai</span>
                    @endif
                </p>
            </div>
        </div>
        <div class="col-md-4 col-6">
            <div class="status-card border-green">
                <p class="label"><i class="fas fa-list"></i> Kriteria</p>
                <p class="value">{{ $totalKriteria ?? 0 }}</p>
                <p class="sub">
                    Bobot: {{ $totalKriteria > 0 ? \App\Models\Kriteria::sum('bobot') : 0 }}%
                </p>
            </div>
        </div>
    </div>

    <!-- ============================================================
    HASIL PERANGKINGAN
    ============================================================ -->
    <div class="card-custom">
        <div class="card-header">
            <i class="fas fa-trophy"></i> HASIL PERANGKINGAN (TOP 5 CREWS)
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th style="width:80px;">Peringkat</th>
                            <th>Nama Karyawan</th>
                            <th>Departemen</th>
                            <th style="width:120px;">Skor Akhir</th>
                            <th style="width:90px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $periode = date('Y-m-01');
                            $karyawans = \App\Models\Karyawan::all();
                            $kriterias = \App\Models\Kriteria::all();
                            $totalBobot = $kriterias->sum('bobot');
                            $rankResults = [];

                            foreach ($karyawans as $k) {
                                $totalSkor = 0;
                                foreach ($kriterias as $kr) {
                                    $nilai = \App\Models\Penilaian::where('karyawan_id', $k->id)
                                        ->where('kriteria_id', $kr->id)
                                        ->where('periode', $periode)
                                        ->value('nilai');
                                    if ($nilai) {
                                        $max = \App\Models\Penilaian::where('kriteria_id', $kr->id)
                                            ->where('periode', $periode)
                                            ->max('nilai') ?: 1;
                                        $normalisasi = $nilai / $max;
                                        $bobotNormal = $kr->bobot / $totalBobot;
                                        $totalSkor += $normalisasi * $bobotNormal;
                                    }
                                }
                                $rankResults[] = [
                                    'karyawan' => $k,
                                    'skor' => round($totalSkor * 100, 2)
                                ];
                            }
                            usort($rankResults, function($a, $b) {
                                return $b['skor'] <=> $a['skor'];
                            });
                            $top5 = array_slice($rankResults, 0, 5);
                        @endphp

                        @forelse($top5 as $index => $result)
                        <tr class="{{ $index == 0 ? 'table-warning' : '' }}">
                            <td>
                                @if($index == 0)
                                    <span class="rank-badge gold"><i class="fas fa-star"></i> 1</span>
                                @elseif($index == 1)
                                    <span class="rank-badge silver">2</span>
                                @elseif($index == 2)
                                    <span class="rank-badge bronze">3</span>
                                @else
                                    <span class="rank-badge navy">{{ $index + 1 }}</span>
                                @endif
                            </td>
                            <td><strong>{{ $result['karyawan']->nama }}</strong></td>
                            <td>{{ $result['karyawan']->divisi }}</td>
                            <td><strong>{{ number_format($result['skor'] / 100, 3) }}</strong></td>
                            <td>
                                <button class="btn-detail" onclick="alert('Detail {{ $result['karyawan']->nama }}:\nSkor: {{ $result['skor'] }}\nDivisi: {{ $result['karyawan']->divisi }}')">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <i class="fas fa-info-circle text-muted"></i>
                                <br>Belum ada data penilaian
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ============================================================
    GRAFIK
    ============================================================ -->
    <div class="row g-3">
        <div class="col-md-6">
            <div class="chart-box">
                <div class="chart-title"><i class="fas fa-chart-bar"></i> Grafik Performa Departemen</div>
                <div class="chart-container-simple">
                    @php
                        $deptScores = [];
                        foreach ($rankResults as $r) {
                            $dept = $r['karyawan']->divisi;
                            if (!isset($deptScores[$dept])) {
                                $deptScores[$dept] = 0;
                            }
                            $deptScores[$dept] += $r['skor'];
                        }
                        arsort($deptScores);
                        $deptScores = array_slice($deptScores, 0, 6);
                        $maxDept = !empty($deptScores) ? max($deptScores) : 1;
                        $colors = ['color-1','color-2','color-3','color-4','color-5','color-6','color-7'];
                    @endphp
                    @forelse($deptScores as $dept => $score)
                        @php
                            $height = round(($score / $maxDept) * 100);
                            $colorIdx = $loop->index % count($colors);
                        @endphp
                        <div class="chart-bar-simple {{ $colors[$colorIdx] }}" style="height: {{ max(20, $height) }}px;">
                            <span class="bar-value">{{ round($score, 1) }}</span>
                            <span class="bar-label">{{ substr($dept, 0, 7) }}</span>
                        </div>
                    @empty
                        <div style="width:100%; text-align:center; color:#adb5bd; font-size:13px; padding:20px 0;">
                            <i class="fas fa-chart-bar"></i>
                            <br>Belum ada data
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="chart-box">
                <div class="chart-title"><i class="fas fa-user-check"></i> Grafik Kehadiran Total</div>
                <div class="chart-container-simple">
                    @php
                        $hadirData = [];
                        $karyawanAll = \App\Models\Karyawan::all();
                        foreach ($karyawanAll as $k) {
                            $hadir = \App\Models\Penilaian::where('karyawan_id', $k->id)
                                ->where('periode', $periode)
                                ->whereHas('kriteria', function($q) {
                                    $q->where('nama_kriteria', 'LIKE', '%Kehadiran%');
                                })
                                ->value('nilai');
                            if ($hadir) {
                                $hadirData[] = $hadir;
                            }
                        }
                        rsort($hadirData);
                        $hadirData = array_slice($hadirData, 0, 6);
                        $maxHadir = !empty($hadirData) ? max($hadirData) : 1;
                        $colors = ['color-1','color-2','color-3','color-4','color-5','color-6','color-7'];
                    @endphp
                    @forelse($hadirData as $index => $score)
                        @php
                            $height = round(($score / $maxHadir) * 100);
                            $colorIdx = $index % count($colors);
                        @endphp
                        <div class="chart-bar-simple {{ $colors[$colorIdx] }}" style="height: {{ max(20, $height) }}px;">
                            <span class="bar-value">{{ $score }}%</span>
                            <span class="bar-label">Crew {{ $index + 1 }}</span>
                        </div>
                    @empty
                        <div style="width:100%; text-align:center; color:#adb5bd; font-size:13px; padding:20px 0;">
                            <i class="fas fa-user-check"></i>
                            <br>Belum ada data kehadiran
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================
    FOOTER
    ============================================================ -->
    <div class="text-center mt-4 pt-3" style="border-top: 1px solid #e9ecef;">
        <p style="color: #0a1628; font-size: 14px; font-weight: 700; margin: 0;">
            Cinépolis <i class="fas fa-star" style="color: #f7c948;"></i>
        </p>
        <p style="color: #adb5bd; font-size: 11px; margin: 4px 0;">
            Hiburan Berkualitas untuk Semua
        </p>
        <p style="color: #ced4da; font-size: 10px; margin: 0;">
            © 2026 Cinépolis Indonesia | All Rights Reserved
        </p>
    </div>

</div>
@endsection