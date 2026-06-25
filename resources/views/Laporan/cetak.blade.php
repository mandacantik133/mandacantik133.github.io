<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penilaian - {{ date('F Y', strtotime($periode)) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { font-family: 'Montserrat', sans-serif; padding: 40px; background: #ffffff; }
        .print-header { text-align: center; border-bottom: 3px solid #f7c948; padding-bottom: 16px; margin-bottom: 24px; }
        .print-header h1 { color: #0a1628; font-weight: 800; font-size: 28px; margin: 0; }
        .print-header h1 i { color: #f7c948; }
        .print-header p { color: #6c757d; font-size: 14px; margin: 4px 0 0; }
        .winner-box { background: #0a1628; color: #ffffff; padding: 16px 24px; border-radius: 8px; margin-bottom: 20px; }
        .winner-box .name { font-size: 20px; font-weight: 700; }
        .winner-box .name i { color: #f7c948; }
        .winner-box .dept { color: rgba(255,255,255,0.6); font-size: 14px; }
        .winner-box .score { color: #f7c948; font-size: 18px; font-weight: 700; }
        .table-print { font-size: 12px; width: 100%; border-collapse: collapse; }
        .table-print thead { background: #0a1628; color: #ffffff; }
        .table-print thead th { padding: 8px 10px; font-weight: 600; font-size: 11px; text-transform: uppercase; text-align: center; border: 1px solid #0a1628; }
        .table-print tbody td { padding: 8px 10px; border: 1px solid #e9ecef; text-align: center; }
        .table-print tbody td:first-child { text-align: left; font-weight: 600; }
        .table-print tbody tr:nth-child(even) { background: #f8f9fa; }
        .table-print tbody tr:first-child { background: #fff8e1; }
        .rank-badge { font-weight: 700; padding: 2px 10px; border-radius: 20px; font-size: 11px; display: inline-block; }
        .rank-badge.gold { background: #f7c948; color: #0a1628; }
        .rank-badge.silver { background: #e9ecef; color: #6c757d; }
        .rank-badge.bronze { background: #f8d7b5; color: #8b6b4a; }
        .rank-badge.navy { background: #0a1628; color: #ffffff; }
        .footer-print { margin-top: 30px; padding-top: 16px; border-top: 1px solid #e9ecef; text-align: center; }
        .footer-print .brand { color: #0a1628; font-size: 14px; font-weight: 700; }
        .footer-print .brand i { color: #f7c948; }
        .footer-print .copyright { color: #adb5bd; font-size: 10px; margin: 0; }
        @media print {
            body { padding: 20px; }
            .no-print { display: none !important; }
            .winner-box { background: #0a1628 !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            .table-print thead { background: #0a1628 !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            .rank-badge { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }
    </style>
</head>
<body>

    <div class="print-header">
        <h1><i class="fas fa-star"></i> Cinépolis</h1>
        <p style="font-size: 16px; font-weight: 600; color: #0a1628;">SPK Star of the Month</p>
        <p>Periode: <strong>{{ date('F Y', strtotime($periode)) }}</strong></p>
    </div>

    @if(count($results) > 0)
        <div class="winner-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="name">
                        <i class="fas fa-crown"></i> {{ $results[0]['karyawan']->nama }}
                    </div>
                    <div class="dept">
                        <i class="fas fa-building"></i> {{ $results[0]['karyawan']->divisi }}
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <div class="score">⭐ Skor: {{ $results[0]['skor'] }}</div>
                    <small style="color: rgba(255,255,255,0.4);">Star of the Month</small>
                </div>
            </div>
        </div>
    @endif

    <table class="table-print">
        <thead>
            <tr>
                <th style="width:50px;">Rank</th>
                <th style="text-align:left;">Nama Karyawan</th>
                <th>Divisi</th>
                @foreach($kriterias as $kriteria)
                    <th>{{ $kriteria->nama_kriteria }}</th>
                @endforeach
                <th style="width:90px;">Total Skor</th>
            </tr>
        </thead>
        <tbody>
            @forelse($results as $index => $result)
            <tr>
                <td>
                    @if($index == 0)
                        <span class="rank-badge gold">⭐1</span>
                    @elseif($index == 1)
                        <span class="rank-badge silver">2</span>
                    @elseif($index == 2)
                        <span class="rank-badge bronze">3</span>
                    @else
                        <span class="rank-badge navy">{{ $index + 1 }}</span>
                    @endif
                </td>
                <td style="text-align:left;"><strong>{{ $result['karyawan']->nama }}</strong></td>
                <td>{{ $result['karyawan']->divisi }}</td>
                @foreach($kriterias as $kriteria)
                    <td>{{ $result['detail'][$kriteria->nama_kriteria] ?? 0 }}</td>
                @endforeach
                <td><strong>{{ $result['skor'] }}</strong></td>
            </tr>
            @empty
            <tr>
                <td colspan="{{ count($kriterias) + 4 }}" style="text-align:center; padding:30px;">
                    Belum ada data penilaian
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer-print">
        <div class="brand">
            Cinépolis <i class="fas fa-star"></i>
        </div>
        <div class="copyright">Hiburan Berkualitas untuk Semua</div>
        <div class="copyright">© 2026 Cinépolis Indonesia | All Rights Reserved</div>
        <div style="color: #ced4da; font-size: 10px; margin-top: 4px;">
            Dicetak: {{ date('d F Y H:i:s') }}
        </div>
    </div>

    <div class="text-center mt-4 no-print">
        <button class="btn btn-primary" onclick="window.print()">
            <i class="fas fa-print"></i> Cetak PDF
        </button>
        <a href="{{ url('/laporan') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

</body>
</html>