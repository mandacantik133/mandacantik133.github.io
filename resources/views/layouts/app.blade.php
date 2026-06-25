<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK Star of the Month - Cinépolis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: #f5f6fa;
            display: flex;
            min-height: 100vh;
        }

        /* ============================================================
           SIDEBAR KIRI - NAVY
           ============================================================ */
        .sidebar-left {
            width: 240px;
            min-height: 100vh;
            background: #0a1628;
            padding: 24px 0 30px;
            flex-shrink: 0;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 999;
        }

        .sidebar-left .brand {
            text-align: center;
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            margin-bottom: 16px;
        }

        .sidebar-left .brand .logo-icon {
            width: 56px;
            height: 56px;
            background: #f7c948;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 26px;
            color: #0a1628;
            font-weight: 900;
        }

        .sidebar-left .brand h3 {
            color: #ffffff;
            font-size: 18px;
            font-weight: 800;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .sidebar-left .brand h3 span {
            color: #f7c948;
        }

        .sidebar-left .brand small {
            color: rgba(255,255,255,0.35);
            font-size: 11px;
            font-weight: 400;
            display: block;
            margin-top: 2px;
            letter-spacing: 0.5px;
        }

        .sidebar-left .nav-link {
            color: rgba(255,255,255,0.45);
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 14px;
            border-left: 3px solid transparent;
            transition: 0.3s;
        }

        .sidebar-left .nav-link:hover {
            color: #ffffff;
            background: rgba(255,255,255,0.04);
            border-left-color: #f7c948;
        }

        .sidebar-left .nav-link.active {
            color: #ffffff;
            background: rgba(255,255,255,0.06);
            border-left-color: #f7c948;
        }

        .sidebar-left .nav-link i {
            width: 20px;
            color: rgba(255,255,255,0.25);
            font-size: 16px;
            text-align: center;
        }

        .sidebar-left .nav-link.active i {
            color: #f7c948;
        }

        .sidebar-left .period-badge {
            text-align: center;
            padding: 16px 20px;
            margin: 20px 16px 0;
            background: rgba(255,255,255,0.04);
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.06);
        }

        .sidebar-left .period-badge p {
            color: rgba(255,255,255,0.4);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0;
        }

        .sidebar-left .period-badge .period {
            color: #f7c948;
            font-size: 18px;
            font-weight: 700;
            margin: 4px 0 0;
        }

        /* ============================================================
           MAIN CONTENT
           ============================================================ */
        .main-content {
            margin-left: 240px;
            flex: 1;
            padding: 28px 32px;
            background: #f5f6fa;
            min-height: 100vh;
        }

        /* ============================================================
           RESPONSIVE
           ============================================================ */
        @media (max-width: 992px) {
            .sidebar-left {
                width: 200px;
            }
            .main-content {
                margin-left: 200px;
                padding: 20px;
            }
            .sidebar-left .nav-link {
                font-size: 13px;
                padding: 10px 18px;
            }
            .sidebar-left .brand h3 {
                font-size: 16px;
            }
        }

        @media (max-width: 768px) {
            .sidebar-left {
                width: 100%;
                min-height: auto;
                position: relative;
                padding: 12px 16px;
                display: flex;
                flex-wrap: wrap;
                gap: 4px;
                border-bottom: 1px solid rgba(255,255,255,0.06);
            }

            .sidebar-left .brand {
                display: none;
            }

            .sidebar-left .nav-link {
                padding: 6px 12px;
                font-size: 11px;
                border-left: none;
                border-bottom: 2px solid transparent;
                gap: 6px;
            }

            .sidebar-left .nav-link.active {
                border-bottom-color: #f7c948;
                border-left: none;
            }

            .sidebar-left .period-badge {
                display: none;
            }

            .main-content {
                margin-left: 0;
                padding: 16px;
            }
        }

        @media (max-width: 480px) {
            .sidebar-left .nav-link {
                font-size: 10px;
                padding: 4px 8px;
            }
            .sidebar-left .nav-link i {
                font-size: 12px;
            }
            .main-content {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <!-- ============================================================
    SIDEBAR KIRI
    ============================================================ -->
    <div class="sidebar-left">
        <div class="brand">
            <div class="logo-icon">
                <i class="fas fa-star"></i>
            </div>
            <h3>Cinépolis <span>★</span></h3>
            <small>SPK Star of the Month</small>
        </div>

        <nav class="nav flex-column">
            <a class="nav-link {{ request()->is('/') || request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
                <i class="fas fa-chart-pie"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->is('karyawan*') ? 'active' : '' }}" href="{{ url('/karyawan') }}">
                <i class="fas fa-users"></i> Karyawan
            </a>
            <a class="nav-link {{ request()->is('kriteria*') ? 'active' : '' }}" href="{{ url('/kriteria') }}">
                <i class="fas fa-sliders-h"></i> Kriteria
            </a>
            <a class="nav-link {{ request()->is('penilaian*') ? 'active' : '' }}" href="{{ url('/penilaian') }}">
                <i class="fas fa-pen-square"></i> Input Nilai
            </a>
            <a class="nav-link {{ request()->is('hasil*') ? 'active' : '' }}" href="{{ url('/hasil') }}">
                <i class="fas fa-chart-bar"></i> Hasil SAW
            </a>
            <a class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}" href="{{ url('/laporan') }}">
                <i class="fas fa-file-alt"></i> Laporan
            </a>
            @if(auth()->user() && auth()->user()->role == 'admin')
                <a class="nav-link" href="#">
                    <i class="fas fa-cog"></i> Admin
                </a>
            @endif
        </nav>

        <div class="period-badge">
            <p>Period</p>
            <div class="period">{{ date('F Y') }}</div>
        </div>
    </div>

    <!-- ============================================================
    MAIN CONTENT
    ============================================================ -->
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- ============================================================
    SCRIPTS
    ============================================================ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>
</html>