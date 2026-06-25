@extends('layouts.app')

@section('title', 'Cetak Laporan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="fas fa-print"></i> Laporan Hasil SAW</h2>
    <button onclick="window.print()" class="btn btn-primary">
        <i class="fas fa-print"></i> Cetak / PDF
    </button>
</div>

<div class="card" id="printArea">
    <div class="card-body">
        <div class="text-center mb-4">
            <h3 style="color: #0a1628;">LAPORAN STAR OF THE MONTH</h3>
            <h5>Periode: {{ date('F Y', strtotime($periode)) }}</h5>
            <p>Metode Simple Additive Weighting (SAW)</p>
            <hr>
        </div>
        
        @if(count($results) > 0)
            <div class="alert alert-warning text-center">
                <h4>🏆 Pemenang: <strong>{{ $results[0]['karyawan']->nama }}</strong></h4>
                <p>Total Skor: {{ $results[0]['total_skor'] }}</p>
            </div>
        @endif
        
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Ranking</th>
                    <th>NIK</th>
                    <th>Nama Karyawan</th>
                    <th>Divisi</th>
                    <th>Total Skor SAW</th>
                    <th>Predikat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $index => $result)
                <tr class="{{ $index == 0 ? 'table-warning' : '' }}">
                    <td>
                        @if($index == 0)
                            <i class="fas fa-crown text-warning"></i> #1
                        @else
                            #{{ $index + 1 }}
                        @endif
                    </td>
                    <td>{{ $result['karyawan']->nik }}</td>
                    <td><strong>{{ $result['karyawan']->nama }}</strong></td>
                    <td>{{ $result['karyawan']->divisi }}</td>
                    <td><strong>{{ $result['total_skor'] }}</strong></td>
                    <td>
                        @if($index == 0)
                            ⭐ STAR OF THE MONTH
                        @elseif($index <= 2)
                            🏅 RUNNER UP
                        @elseif($index <= 5)
                            ⭐ TOP 5
                        @else
                            PESERTA
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="mt-4">
            <p class="text-muted">Dicetak pada: {{ date('d F Y H:i:s') }}</p>
        </div>
        
        <div class="text-center mt-4 pt-3" style="border-top: 1px solid #e9ecef;">
            <p style="color: #0a1628; font-size: 14px; font-weight: 700;">
                Cinépolis <i class="fas fa-star" style="color: #f7c948;"></i>
            </p>
            <p style="color: #adb5bd; font-size: 11px;">Hiburan Berkualitas untuk Semua</p>
            <p style="color: #ced4da; font-size: 10px;">© 2026 Cinépolis Indonesia | All Rights Reserved</p>
        </div>
    </div>
</div>

<style media="print">
    .btn, .navbar, .d-flex .btn {
        display: none !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    .container {
        max-width: 100% !important;
        padding: 0 !important;
    }
    #printArea {
        margin: 0 !important;
        padding: 0 !important;
    }
</style>
@endsection